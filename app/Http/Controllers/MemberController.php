<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Services\EmailService;
use Illuminate\Testing\Fluent\Concerns\Has;

class MemberController extends Controller
{

    public function checkMemberExist(Request $request)
    {
        if (Member::where('email', $request->email)->exists()) {
            echo 1; // email exists
        } elseif (Member::where('mobile_number', $request->mobile_number)->exists()) {
            echo 2; // mobile number exists
        }else{
            echo 0;
        }
    }

    public function initial_registor(Request $request, EmailService $emailService)
    {
        $data =[
            'full_name' => $request->full_name,
            'email' => $request->email,
            'mobile_number' => $request->mobile_number,
            'password' => $request->password,
            'profile_created_for' => $request->profile_created_for,
            'gender' => $request->gender,
            'registration_date' => now(),
            'profile_id' => 'NA',
            'profile_completed' => '15%'
        ];

        $data = array_filter($data, fn($value) => !is_null($value));
        //dd($data);
        $member = Member::create($data);
      //  dd($member->toArray());
        $profile_id = 10000 + $member->id;
        $member->update(['profile_id' => 'HIM' . $profile_id]);
        Auth::guard('member')->login($member);
        $emailService->sendRegisterEmail($member);
        return redirect()->route('home')->with('success', 'Registration successful!');
    }

    public function login(Request $request)
    {
        $login = $request->username;
        $password = $request->password;

        $member = Member::where('email', $login)
            ->orWhere('mobile_number', $login)
            ->orWhere('profile_id', $login)
            ->first();
        if ($member && $password) {
            Auth::guard('member')->login($member);
            $request->session()->regenerate();
            // $test = session()->regenerate();
            // dd($test);
            return response()->json(['success'=>true,'message' => 'Logged In successfully','redirect'=>route('profile')]);
        }

        return response()->json([
            'message' => 'Invalid username or password.'
        ], 401);
    }

    public function logout()
    {
        Auth::guard('member')->logout();
        return redirect()->route('login');
    }

    public function memberDashboard()
    {
        dd(session());
    }

    public function updatePassword(Request $request)
    {
        $id = Auth::guard('member')->id();
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }
        $member = Member::findOrFail($id);
        if ($request->current_password !== $member->password) {
            return response()->json([
                'errors' => ['current_password' => ['Current password is incorrect']]
            ], 422);
        }
        $member->password = $request->new_password;
        $member->save();
        return response()->json([
            'success' => true,
            'message' => 'Password updated successfully!'
        ]);
    }

}