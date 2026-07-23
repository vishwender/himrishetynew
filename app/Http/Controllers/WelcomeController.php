<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use App\Models\ProfileCreatedFor;
use App\Models\SuccessStory;
use App\Models\MaritalStatus;
use App\Models\Member;
use App\Models\Page;
use App\Models\MembershipPlan;

class WelcomeController extends Controller
{
    public function index()
    {
        $data["maleProfile"] = Member::where('gender','Male')->where('is_trusted','trusted')->where('active','Yes')->orderby('id','desc')->first();
        $data["femaleProfile"] = Member::where('gender','Female')->where('member_type','Verified')->where('active','Yes')->orderby('id','desc')->first();
        $data['totalprofiles'] = Member::count();
        return view('welcome',compact('data'));
    }

    public function about()
    {
        $aboutUs = Page::where('id', 1)->value('about_us');
        return view('about',compact('aboutUs'));
    }

    public function success_stories()
    {
        $stories =  SuccessStory::where('status',1)->get();
        return view('success-stories',compact('stories'));
    }

    public function contact()
    {
        return view('contact');
    }

    public function privacy_policy()
    {
        $data = Page::where('id', 1)->value('privacy_policy');
        return view('privacy-policy',compact('data'));
    }

    public function refund_policy()
    {
        $data = Page::where('id', 1)->value('refund_policy');
        return view('refund_policy',compact('data'));
    }

    public function terms_and_conditions()
    {
        $data = Page::where('id', 1)->value('terms_and_conditions');
        return view('terms-and-conditions',compact('data'));
    }

    public function child_safety()
    {
        return view('child_safety');
    }

    public function pricing()
    {
        $pricings = MembershipPlan:: WhereNot('id',0)->get();
        return view('pricing',compact('pricings'));
    }
}
