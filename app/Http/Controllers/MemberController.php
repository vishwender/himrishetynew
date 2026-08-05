<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

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
        } else {
            echo 0;
        }
    }

    public function initial_registor(Request $request, EmailService $emailService)
    {
        $data = [
            'full_name' => $request->full_name,
            'email' => $request->email,
            'mobile_number' => $request->mobile_number,
            'password' => $request->password,
            'profile_created_for' => $request->profile_created_for,
            'gender' => $request->gender,
            'birth_date_time' => $request->birth_date,
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
        $request->session()->regenerate();
        //$emailService->sendRegisterEmail($member);
        return response()->json(['success' => true, 'redirect' => 'complete-profile', 'message' => 'Registration successful!']);
        //return redirect()->route('home')->with('success', 'Registration successful!');
    }

    public function completeProfile(Request $request)
    {
        // Show page
        if ($request->isMethod('get')) {
            return view('dashboard.profile.complete-profile');
        }
        // Update profile
        $member = Auth::guard('member')->user();
        $id = Auth::guard('member')->id();

        if (!$member) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 401);
        }
        // Allowed fields
        $allowedFields = [
            'birth_date_time',
            'height',
            'cast',
            'religion',
            'marital_status',
            'no_of_child',
            'city_living_in',
            'state_living_in',
            'country_living_in',
            'birth_place',
            'manglik',
            'cast',
            'horoscope_needed',
            'gotra',
            'education',
            'employed_in',
            'organization_name',
            'job_location',
            'occupation',
            'annual_income',
            'profile_completed',
        ];
        $data = $request->only($allowedFields);
        if ($request->filled('time_of_birth')) {
            // Get existing date
            $date = Carbon::parse($member->birth_date_time)->format('Y-m-d');
            // Combine with new time
            $member->birth_date_time = $date . ' ' . $request->time_of_birth;
        }

        //upload profile photo if exists in request/

        if ($request->hasFile('photo')) {

            $request->validate([
                'photo' => 'image|mimes:jpg,jpeg,png,webp|max:5120',
            ]);

            $file = $request->file('photo');
            $filename = time() . '_' . $member->id . '.' . $file->getClientOriginalExtension();
            $destination = public_path('images/profile_photos');
            // Delete old photo
            if (
                !empty($member->photo) &&
                file_exists($destination . '/' . $member->photo)
            ) {
                unlink($destination . '/' . $member->photo);
            }
            // Save new photo
            $file->move($destination, $filename);
            $data['photo'] = $filename;
            $data['photo_approved'] = 'No';
        }
        $member->update($data);
        return response()->json([
            'success' => true,
            'message' => 'Profile updated successfully.'
        ]);
    }

    public function memberDashboard()
    {
        dd(session());
    }

    public function changePassword()
    {
        return view('dashboard.profile.change-password');
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
