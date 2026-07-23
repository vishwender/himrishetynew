<?php
namespace App\Http\Controllers\MemberAuth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetLinks;
use Illuminate\Http\Request;
use Password;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetLinks;

    public function broker()
    {
        return Password::broker('members');
    }

    public function showLinkRequestForm()
    {
        return view('member.auth.passwords.email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        $response = $this->broker()->sendResetLink(
            $this->credentials($request)
        );

        return $response == Password::RESET_LINK_SENT
            ? back()->with('status', trans($response))
            : back()->withErrors(['email' => trans($response)]);
    }

    protected function validateEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
    }

    protected function credentials(Request $request)
    {
        return $request->only('email');
    }
}