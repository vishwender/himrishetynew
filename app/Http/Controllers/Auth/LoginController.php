<?php

namespace App\Http\Controllers\Auth;

use App\Models\Member;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function showLoginForm()
    {
        $captcha = $this->genetateCaptcha();
        return view('auth.login', compact('captcha'));
    }

    public function login(Request $request)
    {
        $login    = $request->username;
        $password = $request->password;
        $captcha = $request->captcha;

        // Find member
        $member = Member::where('email', $login)
            ->orWhere('mobile_number', $login)
            ->orWhere('profile_id', $login)
            ->first();

        // Check member exists and password matches
        if (!$member || $member->password !== $password) {

            session(['captcha' => rand(100000, 999999)]);

            return response()->json([
                'message' => 'Invalid username or password.'
            ], 401);
        }

        // Validate captcha
        if ($captcha != session('captcha')) {

            // Generate a new captcha
            session(['captcha' => rand(100000, 999999)]);

            return response()->json([
                'success' => false,
                'message' => 'Invalid captcha.',
                'captcha' => $this->genetateCaptcha()
            ], 422);
        }

        // Login user
        Auth::guard('member')->login($member);

        $request->session()->regenerate();

        // Generate new captcha for next login attempt
        session(['captcha' => rand(100000, 999999)]);

        return response()->json([
            'success'  => true,
            'message'  => 'Logged in successfully.',
            'redirect' => route('home')
        ]);
    }

    public function logout()
    {
        Auth::guard('member')->logout();
        return redirect()->route('login');
    }

    private function genetateCaptcha()
    {
        $captcha = rand(100000, 999999);
        session(['captcha' => $captcha]);
        return $captcha;
    }
}
