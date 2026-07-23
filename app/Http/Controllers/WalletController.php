<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use App\Models\MemberWallet;
use DB;
use Auth;
use Exception;

class WalletController extends Controller
{
    public function index()
    {
        $wallet = MemberWallet::where('member_id', Auth::guard('member')->id())->latest('created_at')->first();
        return view('wallet.index', compact('wallet'));
    }

    public function createOrder(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:10',
        ]);

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $order = $api->order->create([
            'receipt'  => 'wallet_' . uniqid(),
            'amount'   => $request->amount * 100, 
            'currency' => 'INR',
        ]);
        session([
            'razorpay_order_id' => $order['id'],
            'order_amount'      => $request->amount
        ]);

        return response()->json([
            'order_id'   => $order['id'],
            'razor_key'  => env('RAZORPAY_KEY'),
            'amount'     => $request->amount * 100,
            'currency'   => 'INR',
        ]);
    }

    public function paymentCallback(Request $request)
    {
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $userId = Auth::guard('member')->id();

        try {
            $attributes = [
                'razorpay_order_id'   => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature'  => $request->razorpay_signature,
            ];

            $api->utility->verifyPaymentSignature($attributes);
            $amount = session('order_amount'); 

            DB::table('payments')->insert([
                'member_id'    => $userId,
                'payment_date' => now(),
                'payment_id'   => $request->razorpay_payment_id,
                'amount'       => $amount,
                'remarks'      => 'Razorpay',
            ]);

            $wallet = MemberWallet::where('member_id', $userId)
                ->latest('id')  
                ->first();

            if ($wallet) {
                $wallet->wallet_balance = $wallet->wallet_balance + $amount;
                $wallet->save();
            } else {
                $wallet = MemberWallet::create([
                    'member_id'      => $userId,
                    'wallet_balance' => $amount
                ]);
            }

            session(['wallet_balance' => $wallet->wallet_balance]);

            return response()->json([
                'status'  => 'success',
                'message' => 'Wallet recharged successfully!',
                'balance' => $wallet->wallet_balance
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Payment failed: ' . $e->getMessage()
            ], 500);
        }
    }

}
