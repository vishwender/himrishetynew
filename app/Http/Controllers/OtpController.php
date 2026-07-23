<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\NimbusSmsService;
use Illuminate\Support\Facades\Session;
use App\Models\Member; // your Member model

class OtpController extends Controller
{
    public function sendOtp(Request $request, NimbusSmsService $smsService)
    {
        $member = Member::where('mobile_number', $request->phone)->first();

        if (!$member) {
            return response()->json(['message' => 'Mobile number not registered'], 404);
        }

        $otp = rand(1000, 9999);

        Session::put('otp', $otp);
        Session::put('otp_mobile', $request->phone);
        Session::put('otp_expires', now()->addMinutes(5));
        $smsService->sendOtp($request->phone, $otp);
        return response()->json(['message' => 'OTP sent successfully']);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:4',
            'password' => 'required',
        ]);

        if (now()->greaterThan(Session::get('otp_expires'))) {
            return response()->json(['message' => 'OTP expired'], 422);
        }

        if (Session::get('otp') == $request->otp) {
            $opt_mobile = session::get('otp_mobile');
            $member = Member::where('mobile_number', $opt_mobile )->first();
            if(!empty($member)){
                $member->password = $request->password;
                $member->update();
            }
            return response()->json(['message' => 'Password updated. Please login..']);
        }

        return response()->json(['message' => 'Invalid OTP'], 422);
    }

    public function update_password(Request $request){
        $opt_mobile = session::get('otp_mobile');
        $member = Member::where('mobile_number', $opt_mobile )->first();
        if(!empty($member)){
            $member->password = $request->password;
            $member->update();
            return response()->json(['message' => 'Password updated. Please login']);
        }
    }

    public function login_otp(Request $request, NimbusSmsService $messageService)
    {
        $request->validate([
            'phone' => 'required|numeric|digits:10',
        ]);

        $member = Member::where('mobile_number', $request->phone)->first();

        if (!$member) {
            return response()->json(['status' => 'error', 'message' => 'Member not found.']);
        }

        $otp = random_int(1000, 9999);
        session([
            'login_otp' => $otp,
            'otp_mobile' => $request->phone,
            'otp_expires_at' => now()->addMinutes(10), 
        ]);

        $messageService->send_login_otp($request->phone, $otp);

        return response()->json(['status' => 'success', 'message' => 'OTP sent successfully.', 'otp' => $otp]);
    }

    public function verifyLoginOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric',
        ]);

        if (now()->greaterThan(session('otp_expires_at'))) {
            return response()->json(['status' => 'error', 'message' => 'OTP expired.']);
        }

        if (session('login_otp') == $request->otp) {
            $member = Member::where('mobile_number', session('otp_mobile'))->first();
            if ($member) {
                auth('member')->login($member);
                return response()->json(['status' => 'success', 'message' => 'Login successful.', 'member' => $member]);
            }
        } else {
            return response()->json(['status' => 'error', 'message' => 'Invalid OTP.','data' => session('login_otp'),'otp' => $request->otp]);
        }
    }
}
