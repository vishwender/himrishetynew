<?php

namespace App\Services;

use Auth;
use Illuminate\Support\Facades\Http;
use App\Models\User;

class NimbusSmsService
{
    public function sendOtp($mobile, $otp)
    {
        $messageText = "" . $otp . " is the OTP to reset your Password for your himrishtey account";
        $url = "http://nimbusit.biz/api/SmsApi/SendMultipleApi";

        $response = Http::get($url, [
            'UserID'    => env('NIMBUS_USERNAME', 'himrishteybiz'),
            'Password'  => env('NIMBUS_PASSWORD', 'vqbj8362VQ'),
            'SenderID'  => env('NIMBUS_SENDER', 'HIMRMB'),
            'Phno'      => $mobile,
            'Msg'       => $messageText,
            'EntityID'  => env('NIMBUS_ENTITY', '1701164189692214854'),
            'TemplateID' => env('NIMBUS_TEMPLATE', '1707166036739168867'),
        ]);
        return $response->body();
    }

    public function sendInterest($email)
    {
        $messageText = "Dear user, You have got interest from a new " . $email['from_profile_id'] . ",Please check your account : HIMRMB";
        $url = "http://nimbusit.biz/api/SmsApi/SendMultipleApi";

        $response = Http::get($url, [
            'UserID'    => env('NIMBUS_USERNAME', 'himrishteybiz'),
            'Password'  => env('NIMBUS_PASSWORD', 'vqbj8362VQ'),
            'SenderID'  => env('NIMBUS_SENDER', 'HIMRMB'),
            'Phno'      => $email['to_phone'],
            'Msg'       => $messageText,
            'EntityID'  => env('NIMBUS_ENTITY', '1701164189692214854'),
            'TemplateID' => env('NIMBUS_TEMPLATE', '1707166254978193907'),
        ]);
        return $response->body();
    }

    public function send_login_otp($mobile, $otp)
    {
        $messageText = "" . $otp . "  is the OTP to login your himrishtey account.";
        $url = "http://nimbusit.biz/api/SmsApi/SendMultipleApi";

        $response = Http::get($url, [
            'UserID'    => env('NIMBUS_USERNAME', 'himrishteybiz'),
            'Password'  => env('NIMBUS_PASSWORD', 'vqbj8362VQ'),
            'SenderID'  => env('NIMBUS_SENDER', 'HIMRMB'),
            'Phno'      => $mobile,
            'Msg'       => $messageText,
            'EntityID'  => env('NIMBUS_ENTITY', '1701164189692214854'),
            'TemplateID' => env('NIMBUS_TEMPLATE', '1707166088646916717'),
        ]);
        return $response->body();
    }

    public function callback_request_msg($name, $display_name)
    {
        $messageText =
            "A call request from id " .
            $name .
            " regarding membership. Call back immediately " .
            $display_name .
            ".HIMRMB";

        $user = User::where(
            'display_name',
            'Call Back Request'
        )->first();

        if (!$user) {
            return [
                'status' => 'error',
                'message' => 'Call Back Request user not found.'
            ];
        }

        if (empty($user->phone)) {
            return [
                'status' => 'error',
                'message' => 'Callback mobile number not found.'
            ];
        }

        $url = "http://nimbusit.biz/api/SmsApi/SendMultipleApi";

        try {

            $response = Http::get($url, [
                'UserID' => env(
                    'NIMBUS_USERNAME',
                    'himrishteybiz'
                ),

                'Password' => env(
                    'NIMBUS_PASSWORD',
                    'vqbj8362VQ'
                ),

                'SenderID' => env(
                    'NIMBUS_SENDER',
                    'HIMRMB'
                ),

                'Phno' => $user->phone,

                'Msg' => $messageText,

                'EntityID' => env(
                    'NIMBUS_ENTITY',
                    '1701164189692214854'
                ),

                'TemplateID' => '1707166254945835455',
            ]);

            return [
                'status' => 'success',
                'message' => 'SMS sent successfully.',
                'response' => $response->body()
            ];
        } catch (\Exception $e) {

            return [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
        }
    }
}
