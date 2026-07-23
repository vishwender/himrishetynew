<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/clear-cache', function () {
    Artisan::call('optimize:clear');   // clears config, route, view, and cache
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('cache:clear');

    return "Application cache cleared!";
});
Route::get('/test-auth', function () {
    dd(config('auth.guards.member'), config('auth.providers.members_provider'));
});
Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index'])->name('welcome');
Route::get('/about-us', [App\Http\Controllers\WelcomeController::class, 'about'])->name('about-us');
Route::get('/success-stories', [App\Http\Controllers\WelcomeController::class, 'success_stories'])->name('success-stories');
Route::get('/contact-us', [App\Http\Controllers\WelcomeController::class, 'contact'])->name('contact-us');
Route::get('/privacy-policy', [App\Http\Controllers\WelcomeController::class, 'privacy_policy'])->name('privacy-policy');
Route::get('/refund-policy', [App\Http\Controllers\WelcomeController::class, 'refund_policy'])->name('refund-policy');
Route::get('/terms-and-conditions', [App\Http\Controllers\WelcomeController::class, 'terms_and_conditions'])->name('terms-and-conditions');
Route::get('/child-safety-standard', [App\Http\Controllers\WelcomeController::class, 'child_safety'])->name('child-safety-standard');
Route::get('/pricing', [App\Http\Controllers\WelcomeController::class, 'pricing'])->name('pricing');

Route::post('initial-register', [App\Http\Controllers\MemberController::class, 'initial_registor'])->name('initial-register');
Route::post('checkMemberExist', [App\Http\Controllers\MemberController::class, 'checkMemberExist'])->name('checkMemberExist');
Route::post('member-login', [App\Http\Controllers\MemberController::class, 'login'])->name('member-login');
Route::post('member-logout', [App\Http\Controllers\MemberController::class, 'logout'])->name('member-logout')->middleware('auth:member');
Route::post('/send-otp', [App\Http\Controllers\OtpController::class, 'sendOtp'])->name('send-otp');
Route::post('/verify-otp', [App\Http\Controllers\OtpController::class, 'verifyOtp'])->name('verify-otp');
Route::post('/login-with-otp', [App\Http\Controllers\OtpController::class, 'login_otp'])->name('login-with-otp');
Route::post('/verify-login-otp', [App\Http\Controllers\OtpController::class, 'verifyLoginOtp'])->name('verify-login-otp');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home') ->middleware('auth:member');

Route::middleware('auth:member')->group(function () {
    Route::get('search-home-member', [App\Http\Controllers\MyMemberController::class, 'search_home_member'])->name('search-home-member');
    Route::get('quick-search', [App\Http\Controllers\HomeController::class, 'quick_search'])->name('quick-search');
    Route::post('/unlock-contact/{profileId}', [App\Http\Controllers\HomeController::class, 'unlock_contact'])->name('unlock.contact');
    Route::get('memberships', [App\Http\Controllers\MembershipController::class, 'index'])->name('memberships');
    Route::get('referral', [App\Http\Controllers\HomeController::class, 'referral'])->name('referral');
    Route::get('user-terms-and-conditions', [App\Http\Controllers\HomeController::class, 'terms_conditions'])->name('user-terms-and-conditions');
    Route::get('user-rating', [App\Http\Controllers\HomeController::class, 'rating'])->name('user-rating');
    Route::post('user-rate', [App\Http\Controllers\HomeController::class, 'rating_store'])->name('user-rate');
    Route::get('success_stories', [App\Http\Controllers\HomeController::class, 'success_stories'])->name('success_stories');
    Route::post('stories_store',[App\Http\Controllers\HomeController::class, 'stories_store'])->name('stories_store');
    Route::put('/success-stories/{id}', [App\Http\Controllers\HomeController::class, 'update'])->name('stories_update');
    Route::delete('/success-stories/{id}', [App\Http\Controllers\HomeController::class, 'destroy'])->name('stories_delete');
    Route::post('callback', [App\Http\Controllers\MembershipController::class ,'sendSms'])->name('callback');
    Route::get('plans/{id}', [App\Http\Controllers\MembershipController::class, 'plans'])->name('plans');
    Route::get('profile',[App\Http\Controllers\MyMemberController::class, 'myProfile'])->name('profile');
    Route::get('search-by-profile-id', [App\Http\Controllers\HomeController::class, 'search_by_profile_id'])->name('search-by-profile-id');
    Route::get('interest-box', [App\Http\Controllers\HomeController::class, 'interest_box'])->name('interest-box');
    Route::get('view-my-profile',[App\Http\Controllers\HomeController::class, 'view_my_profile'])->name('view-my-profile');
    Route::get('viewed-contacts', [App\Http\Controllers\HomeController::class, 'viewed_contacts'])->name('viewed-contacts');
    Route::get('view-profile/{id}', [App\Http\Controllers\HomeController::class, 'view_profile'])->name('view-profile');
    Route::post('update-password', [App\Http\Controllers\MemberController::class, 'updatePassword'])->name('update-password');
    Route::get('advance-search', [App\Http\Controllers\MyMemberController::class, 'advance_search'])->name('advance-search');
    Route::get('send-interest/{id}' ,[App\Http\Controllers\HomeController::class, 'send_interest'])->name('send-interest');
    Route::post('like-profile', [App\Http\Controllers\HomeController::class, 'like_profile'])->name('like-profile');
    Route::get('/membership/checkout/{planId}', [App\Http\Controllers\MembershipController::class, 'buyPlan'])->name('membership.checkout');
    Route::post('/membership/verify', [App\Http\Controllers\MembershipController::class, 'verifyPayment'])->name('membership.verify');
    Route::get('recent-profiles', [App\Http\Controllers\ProfileController::class, 'recent_profiles'])->name('recent-profiles');
    Route::get('all-recent-profiles', [App\Http\Controllers\ProfileController::class, 'all_recent_profiles'])->name('all-recent-profiles');
    Route::post('update-profile', [App\Http\Controllers\MyMemberController::class, 'update_profile'])->name('update-profile');
    Route::get('/wallet', [App\Http\Controllers\WalletController::class, 'index'])->name('wallet.index');
    Route::post('/wallet/create-order', [App\Http\Controllers\WalletController::class, 'createOrder'])->name('wallet.createOrder');
    Route::post('/wallet/callback', [App\Http\Controllers\WalletController::class, 'paymentCallback'])->name('wallet.callback');
    Route::get('/stats-profiles', [App\Http\Controllers\ProfileController::class, 'stats_profiles'])->name('stats-profiles');
    Route::get('/all-stats-profiles', [App\Http\Controllers\ProfileController::class, 'all_stats_profiles'])->name('all-stats-profiles');
    Route::post('short-profile', [App\Http\Controllers\HomeController::class, 'shortlist_profile'])->name('short-profile');
    Route::get('user-privacy-policy', [App\Http\Controllers\HomeController::class, 'privacy_policy'])->name('user-privacy-policy');
     Route::get('user-refund', [App\Http\Controllers\HomeController::class, 'refund'])->name('user-refund');
    Route::get('/membership/success', function () {
        return view('dashboard.success');
    })->name('membership.success');
    Route::get('/membership/failed', function () {
        return view('dashboard.failed');
    })->name('membership.failed');
    Route::post('/save-subscription', [App\Http\Controllers\PushSubscriptionController::class, 'store']);
    Route::post('/send-notification', [App\Http\Controllers\PushSubscriptionController::class, 'sendBrowserNotification']);
});

Route::prefix('member')->name('member.')->group(function () {
    Route::get('password/reset', [App\Http\Controllers\MemberAuth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [App\Http\Controllers\MemberAuth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [App\Http\Controllers\MemberAuth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [App\Http\Controllers\MemberAuth\ResetPasswordController::class, 'reset'])->name('password.update');
});

Route::get('/test-notify', function () {
    (new \App\Http\Controllers\PushSubscriptionController)->sendBrowserNotification();
    return 'Notification triggered!';
});
