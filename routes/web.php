<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MyMemberController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\PushSubscriptionController;
use App\Http\Controllers\MemberAuth\ForgotPasswordController;
use App\Http\Controllers\MemberAuth\ResetPasswordController;

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

// Route::get('/clear-cache', function () {
//     Artisan::call('optimize:clear');   // clears config, route, view, and cache
//     Artisan::call('config:clear');
//     Artisan::call('route:clear');
//     Artisan::call('view:clear');
//     Artisan::call('cache:clear');

//     return "Application cache cleared!";
// });


Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('about-us', [WelcomeController::class, 'about'])->name('about-us');
Route::get('success-stories', [WelcomeController::class, 'success_stories'])->name('success-stories');
Route::get('contact-us', [WelcomeController::class, 'contact'])->name('contact-us');
Route::get('privacy-policy', [WelcomeController::class, 'privacy_policy'])->name('privacy-policy');
Route::get('refund-policy', [WelcomeController::class, 'refund_policy'])->name('refund-policy');
Route::get('terms-and-conditions', [WelcomeController::class, 'terms_and_conditions'])->name('terms-and-conditions');
Route::get('child-safety-standard', [WelcomeController::class, 'child_safety'])->name('child-safety-standard');
Route::get('pricing', [WelcomeController::class, 'pricing'])->name('pricing');


Route::post('initial-register', [LoginController::class, 'initial_registor'])->name('initial-register');
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login-form');
Route::post('member-login', [LoginController::class, 'login'])->name('member-login');
Route::post('member-logout', [LoginController::class, 'logout'])->name('member-logout')->middleware('auth:member');
Route::get('google-signup', [LoginController::class, 'google_signup'])->name('google-signup');
Route::get('google-signup-callback', [LoginController::class, 'google_signup_callback'])->name('google-signup-callback');

Route::post('checkMemberExist', [MemberController::class, 'checkMemberExist'])->name('checkMemberExist');
Route::match(['GET', 'POST'], '/complete-profile', [MemberController::class, 'completeProfile'])->name('complete-profile');

Route::post('/send-otp', [OtpController::class, 'sendOtp'])->name('send-otp');
Route::post('/verify-otp', [OtpController::class, 'verifyOtp'])->name('verify-otp');
Route::post('/login-with-otp', [OtpController::class, 'login_otp'])->name('login-with-otp');
Route::post('/verify-login-otp', [OtpController::class, 'verifyLoginOtp'])->name('verify-login-otp');
Route::post('/callback-request', [OtpController::class, 'callbackRequest'])->name('callback.request');
Route::get('/callback-status', [OtpController::class, 'callbackStatus'])->name('callback.status');
Route::post('/verify-account-request', [OtpController::class, 'verify_account_request'])->name('verify_account_request');



Route::middleware('auth:member')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('search-home-member', [MyMemberController::class, 'search_home_member'])->name('search-home-member');
    Route::get('search-home-profile', [MyMemberController::class, 'search_home_profile'])->name('search-home-profile');
    Route::get('quick-search', [HomeController::class, 'quick_search'])->name('quick-search');
    Route::get('search-results', [HomeController::class, 'searchResults'])->name('search-results');
    Route::get('search-by-profile-id', [HomeController::class, 'search_by_profile_id'])->name('search-by-profile-id');
    Route::get('api/search-by-profile-id/{profile_id}', [HomeController::class, 'searchByProfileIdApi'])->name('api.search-by-profile-id');
    Route::get('advance-search', [MyMemberController::class, 'advance_search'])->name('advance-search');
    Route::post('/unlock-contact/{profileId}', [HomeController::class, 'unlock_contact'])->name('unlock.contact');
    Route::get('memberships', [MembershipController::class, 'index'])->name('memberships');
    Route::get('referral', [HomeController::class, 'referral'])->name('referral');
    Route::get('members/terms-and-conditions', [PagesController::class, 'terms_conditions'])->name('member.terms-and-conditions');
    Route::get('user-rating', [HomeController::class, 'rating'])->name('user-rating');
    Route::post('user-rate', [HomeController::class, 'rating_store'])->name('user-rate');
    Route::get('success-stories', [HomeController::class, 'success_stories'])->name('member.success-stories');
    Route::post('stories_store', [HomeController::class, 'stories_store'])->name('stories_store');
    Route::put('/success-stories/{id}', [HomeController::class, 'update'])->name('stories_update');
    Route::delete('/success-stories/{id}', [HomeController::class, 'destroy'])->name('stories_delete');
    Route::post('callback', [MembershipController::class, 'sendSms'])->name('callback');
    Route::get('plans/{id}', [MembershipController::class, 'plans'])->name('plans');
    Route::get('profile', [MyMemberController::class, 'myProfile'])->name('profile');
    Route::get('interest-box', [HomeController::class, 'interest_box'])->name('interest-box');
    Route::get('view-my-profile', [HomeController::class, 'view_my_profile'])->name('view-my-profile');
    Route::get('viewed-contacts', [HomeController::class, 'viewed_contacts'])->name('viewed-contacts');
    Route::get('view-profile/{id}', [HomeController::class, 'view_profile'])->name('view-profile');
    Route::get('edit-profile', [MyMemberController::class, 'edit_profile'])->name('edit-profile');
    Route::get('delete-profile', [MyMemberController::class, 'delete_profile'])->name('delete-profile');
    Route::post('/destroy', [MyMemberController::class, 'destroy'])->name('destroy');
    Route::get('change-password', [MemberController::class, 'changePassword'])->name('change-password');
    Route::post('update-password', [MemberController::class, 'updatePassword'])->name('update-password');
    Route::post('send-interest/{id}', [HomeController::class, 'send_interest'])->name('send-interest');
    Route::post('like-profile', [HomeController::class, 'like_profile'])->name('like-profile');
    Route::get('/membership/checkout/{planId}', [MembershipController::class, 'buyPlan'])->name('membership.checkout');
    Route::post('/membership/verify', [MembershipController::class, 'verifyPayment'])->name('membership.verify');
    Route::get('recent-profiles', [ProfileController::class, 'recent_profiles'])->name('recent-profiles');
    Route::get('all-recent-profiles', [ProfileController::class, 'all_recent_profiles'])->name('all-recent-profiles');
    Route::post('update-profile', [MyMemberController::class, 'update_profile'])->name('update-profile');
    Route::get('/wallet', [WalletController::class, 'index'])->name('wallet.index');
    Route::post('/wallet/create-order', [WalletController::class, 'createOrder'])->name('wallet.createOrder');
    Route::post('/wallet/callback', [WalletController::class, 'paymentCallback'])->name('wallet.callback');
    Route::get('/stats-profiles', [ProfileController::class, 'stats_profiles'])->name('stats-profiles');
    Route::get('/all-stats-profiles', [ProfileController::class, 'all_stats_profiles'])->name('all-stats-profiles');
    Route::post('short-profile', [HomeController::class, 'shortlist_profile'])->name('short-profile');
    Route::get('member/privacy-policy', [PagesController::class, 'privacy_policy'])->name('member.privacy-policy');
    Route::get('refund-policy', [PagesController::class, 'refund'])->name('member.refund-policy');
    Route::post('/interest/update-status', [HomeController::class, 'updateInterestStatus'])->name('interest.update.status');
    Route::get('/membership/success', function () {
        return view('dashboard.success');
    })->name('membership.success');
    Route::get('/membership/failed', function () {
        return view('dashboard.failed');
    })->name('membership.failed');
    Route::post('/save-subscription', [PushSubscriptionController::class, 'store']);
    Route::post('/send-notification', [PushSubscriptionController::class, 'sendBrowserNotification']);
    Route::post('/upload-photos', [HomeController::class, 'uploadPhotos'])->name('upload-photos');
    Route::post('/profile/photo', [HomeController::class, 'updatePhoto'])->name('profile.photo.update');
    Route::get('/verify-account', [MyMemberController::class, 'verify_account'])->name('verify-account');
});

Route::prefix('member')->name('member.')->group(function () {
    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
});  

// Route::get('/test-notify', function () {
//     (new \App\Http\Controllers\PushSubscriptionController)->sendBrowserNotification();
//     return 'Notification triggered!';
// });
