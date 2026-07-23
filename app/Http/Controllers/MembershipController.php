<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Razorpay\Api\Api;
use App\Models\MembershipType;
use App\Models\User;
use App\Models\MembershipPlan;
use App\Models\Payment;


class MembershipController extends Controller
{
    public function index()
    {
        $data['memberships'] = membershipType::all();
        return view('dashboard.membership',compact('data'));
    }
    public function sendSms(Request $request)
    {
        $user = $request->user_id;
        $member = auth()->guard('member')->user();
        $number = User::where('user_type','5')->pluck('phone');
        $messageText=" A call request from id ".$member->profile_id." regarding membership. Call back immediately ".$member->full_name.".HIMRMB";
        $messageText=urlencode($messageText);
        $url =  "http://nimbusit.biz/api/SmsApi/SendMultipleApi?UserID=himrishteybiz&Password=vqbj8362VQ&SenderID=HIMRMB&Phno=".$number[0]."&Msg=".$messageText."&EntityID=1701164189692214854&TemplateID=1707166254945835455";
        $response = Http::get($url);
        return $response->body();
    }

   public function plans($id)
    {
        $data['membership'] = MembershipType::where('id',$id)->first();
        $data['plans'] = MembershipPlan::where('membership_type', $id)->get();
        return view('dashboard.layouts.modal',compact('data'));
    }

    public function buyPlan($planId)
    {
        $plan = MembershipPlan::findOrFail($planId);

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $orderData = [
            'receipt'         => 'rcpt_' . time(),
            'amount'          => $plan->final_cost * 100, 
            'currency'        => 'INR',
            'payment_capture' => 1
        ];

        $order = $api->order->create($orderData);

        return view('dashboard.checkout', [
            'order_id'   => $order['id'],
            'plan'       => $plan,
            'razor_key'  => env('RAZORPAY_KEY')
        ]);
    }
public function verifyPayment(Request $request)
{
    $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

    try {
        $attributes = [
            'razorpay_order_id'   => $request->razorpay_order_id,
            'razorpay_payment_id' => $request->razorpay_payment_id,
            'razorpay_signature'  => $request->razorpay_signature
        ];

        $api->utility->verifyPaymentSignature($attributes);

        $payment = $api->payment->fetch($request->razorpay_payment_id);
        if ($payment->status !== 'captured') {
            $payment->capture(['amount' => $payment->amount]);
        }

        $user = auth()->guard('member')->user();
        $plan = MembershipPlan::findOrFail($request->plan_id);
        $user->plan_id = $plan->id;
        $user->save();

        DB::table('payments')->insert([
            'payment_date' => now(),
            'member_id'    => $user->id,
            'plan_id'      => $plan->id,
            'payment_id'   => $request->razorpay_payment_id,
            'amount'       => $payment->amount / 100,
            'remarks'      => 'Razorpay',
        ]);

       return redirect()->route('membership.success')->with('success', 'Payment successful! Membership activated.');

    } catch (\Exception $e) {
        return redirect()->route('membership.failed')
                         ->with('error', 'Payment failed: ' . $e->getMessage());
    }
}


}