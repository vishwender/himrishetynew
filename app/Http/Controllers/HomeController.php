<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use DB;

use App\Models\Member;
use App\Models\MembershipPlan;
use App\Models\Shortlist;
use App\Models\ProfileViewed;
use App\Models\SentInterest;
use App\Models\Height;
use App\Models\Religion;
use App\Models\ProfileLike;
use App\Models\ViewedContact;
use App\Models\Cast;
use App\Models\SuccessStory;
use App\Models\MaritalStatus;
use App\Models\MemberWallet;
use Illuminate\Support\Facades\File;

use App\Services\EmailService;
use App\Services\NimbusSmsService;
use App\Services\PushNotificationService;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:member');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $member = Auth::guard('member')->user();
        $id = $member->id;

        $data['plan'] = MembershipPlan::where('id', $member->plan_id)->first();
        $data['shortlisted'] = Shortlist::where('member_id', $id)->count();
        $data['iLikes'] = ProfileLike::where('user_id', $id)->count();
        $data['iviewed'] = ProfileViewed::where('viewed_profile_id', $id)->count();
        $data['interestSent'] = SentInterest::where('member_id', $id)->count();
        $data['contact'] = ProfileViewed::where('member_id', $id)->count();

        /* recent profiles */
        $today   = Carbon::today()->format('Y-m-d');
        $loggedInUser = Member::find($id);
        if (!$loggedInUser) {
            return [];
        }
        $gender = $loggedInUser->gender;
        $recents = Member::where('gender', '!=', $gender)
            ->where('id', '!=', $id)
            ->where('profile_hide', '!=', 'yes')
            ->where('active', 'Yes')
            ->orderBy('activation_number', 'desc')
            ->limit(30)
            ->get();

        $users = [];

        foreach ($recents as $key => $recent) {
            $birthDate = Carbon::parse($recent->birth_date_time);
            $diff = $birthDate->diff(Carbon::parse($today));
            $users[$key]['age_years']  = $diff->y;
            $users[$key]['age_months'] = $diff->m;
            if (!empty($recent->photo) && $recent->photo_approved === "Yes") {
                $users[$key]['photo'] = "https://himrishtey.com/photos/photo/" . $recent->photo;
            } elseif ($recent->gender === "Male") {
                $users[$key]['photo'] = "https://himrishtey.com/img/boy.jpg";
            } elseif ($recent->gender === "Female") {
                $users[$key]['photo'] = "https://himrishtey.com/img/girl.jpg";
            }
            if ($recent->member_type === 'Verified') {
                $users[$key]['member_type'] = "https://himrishtey.com/img/verified.png";
                $users[$key]['mem_type']    = "Yes";
            } else {
                $users[$key]['member_type'] = "normal";
            }
            if ($recent->is_trusted === 'Trusted') {
                $users[$key]['is_trusted'] = "https://himrishtey.com/img/trusted.png";
            } else {
                $users[$key]['is_trusted'] = "No";
            }
            $users[$key] = array_merge($recent->toArray(), $users[$key]);
        }
        $data['recents'] = $users;

        /********** Verified Users **************/
        $verified = Member::where('gender', '!=', $gender)
            ->where('id', '!=', $id)
            ->where('profile_hide', '!=', 'yes')
            ->where('member_type', 'Verified')
            ->where('active', 'Yes')
            ->orderBy('activation_number', 'desc')
            ->limit(30)
            ->get();

        $data['verifiedUsers'] = [];
        foreach ($verified as $key => $recent) {
            $birthDate = Carbon::parse($recent->birth_date_time);
            $diff = $birthDate->diff(Carbon::parse($today));
            $data['verifiedUsers'][$key]['age_years']  = $diff->y;
            $data['verifiedUsers'][$key]['age_months'] = $diff->m;
            if (!empty($recent->photo) && $recent->photo_approved === "Yes") {
                $data['verifiedUsers'][$key]['photo'] = "https://himrishtey.com/photos/photo/" . $recent->photo;
            } elseif ($recent->gender === "Male") {
                $data['verifiedUsers'][$key]['photo'] = "https://himrishtey.com/img/boy.jpg";
            } elseif ($recent->gender === "Female") {
                $data['verifiedUsers'][$key]['photo'] = "https://himrishtey.com/img/girl.jpg";
            }
            if ($recent->member_type === 'Verified') {
                $data['verifiedUsers'][$key]['member_type'] = "https://himrishtey.com/img/verified.png";
                $data['verifiedUsers'][$key]['mem_type']    = "Yes";
            } else {
                $data['verifiedUsers'][$key]['member_type'] = "normal";
            }
            if ($recent->is_trusted === 'Trusted') {
                $data['verifiedUsers'][$key]['is_trusted'] = "https://himrishtey.com/img/trusted.png";
            } else {
                $data['verifiedUsers'][$key]['is_trusted'] = "No";
            }
            $data['verifiedUsers'][$key] = array_merge($recent->toArray(), $data['verifiedUsers'][$key]);
        }

        /********** Who viewewd *********/
        $recents = Member::select('members.*', 'profile_viewed.viewed_profile_id')
            ->join('profile_viewed', 'members.id', '=', 'profile_viewed.member_id')
            ->where('profile_viewed.viewed_profile_id', $id)
            ->where('members.active', 'Yes')
            ->where('members.profile_hide', '!=', 'yes')
            ->orderBy('profile_viewed.id', 'desc')
            ->limit(30)
            ->get();

        $data['viewed'] = [];

        foreach ($recents as $key => $recent) {
            $birthDate = Carbon::parse($recent->birth_date_time);
            $diff = $birthDate->diff($today);
            $data['viewed'][$key]['id']                = $recent->id;
            $data['viewed'][$key]['profile_id']        = $recent->profile_id;
            $data['viewed'][$key]['full_name']         = $recent->full_name;
            $data['viewed'][$key]['age_years']         = $diff->y;
            $data['viewed'][$key]['age_months']        = $diff->m;
            $data['viewed'][$key]['birth_date_time']   = $birthDate->format('d-m-Y h:i:s A');
            $data['viewed'][$key]['religion']          = $recent->religion;
            $data['viewed'][$key]['cast']              = $recent->cast;
            $data['viewed'][$key]['height']            = $recent->height;
            $data['viewed'][$key]['mother_tongue']     = $recent->mother_tongue;
            $data['viewed'][$key]['annual_income']     = $recent->annual_income;
            $data['viewed'][$key]['gender']            = $recent->gender;
            $data['viewed'][$key]['activation_number'] = $recent->activation_number;
            if (!empty($recent->photo) && $recent->photo_approved === "Yes") {
                $data['viewed'][$key]['photo'] = "https://himrishtey.com/photos/photo/" . $recent->photo;
            } elseif ($recent->gender === "Male") {
                $data['viewed'][$key]['photo'] = "https://himrishtey.com/img/boy.jpg";
            } elseif ($recent->gender === "Female") {
                $data['viewed'][$key]['photo'] = "https://himrishtey.com/img/girl.jpg";
            }
            if ($recent->member_type === 'Verified') {
                $data['viewed'][$key]['member_type'] = "https://himrishtey.com/img/verified.png";
                $data['viewed'][$key]['mem_type']    = "Yes";
            } else {
                $data['viewed'][$key]['member_type'] = "normal";
            }
            if ($recent->is_trusted === 'Trusted') {
                $data['viewed'][$key]['is_trusted'] = "https://himrishtey.com/img/trusted.png";
            } else {
                $data['viewed'][$key]['is_trusted'] = "No";
            }
            $data['viewed'][$key] = array_merge($recent->toArray(), $data['viewed'][$key]);
        }

        /****** shortlisted profiles **************/
        $results = Member::whereIn('id', function ($query) use ($id) {
            $query->select('profile_id')
                ->from('short_listed')
                ->where('member_id', $id);
        })
            ->where('active', 'Yes')
            ->where('profile_hide', '!=', 'yes')
            ->orderBy('activation_number', 'desc')
            ->get();

        $data['shortlist'] = [];

        foreach ($results as $key => $recent) {
            $birthDate = Carbon::parse($recent->birth_date_time);
            $diff = $birthDate->diff($today);

            $data['shortlist'][$key]['age_years']  = $diff->y;
            $data['shortlist'][$key]['age_months'] = $diff->m;
            if (!empty($recent->photo) && $recent->photo_approved === "Yes") {
                $data['shortlist'][$key]['photo'] = "https://himrishtey.com/photos/photo/" . $recent->photo;
            } elseif ($recent->gender === "Male") {
                $data['shortlist'][$key]['photo'] = "https://himrishtey.com/img/boy.jpg";
            } elseif ($recent->gender === "Female") {
                $data['shortlist'][$key]['photo'] = "https://himrishtey.com/img/girl.jpg";
            }
            if ($recent->member_type === 'Verified') {
                $data['shortlist'][$key]['member_type'] = "https://himrishtey.com/img/verified.png";
                $data['shortlist'][$key]['mem_type']    = "Yes";
            } else {
                $data['shortlist'][$key]['member_type'] = "normal";
            }
            if ($recent->is_trusted === 'Trusted') {
                $data['shortlist'][$key]['is_trusted'] = "https://himrishtey.com/img/trusted.png";
            } else {
                $data['shortlist'][$key]['is_trusted'] = "No";
            }
            $data['shortlist'][$key] = array_merge($recent->toArray(), $data['shortlist'][$key]);
        }

        /* Matching profiles */
        $partner_country    = explode(',', $member->partner_country ?? '');
        $partner_religion   = explode(',', $member->partner_religion ?? '');
        $partner_education  = explode(',', $member->partner_education ?? '');
        $partner_mothertongue = explode(',', $member->partner_mothertongue ?? '');

        if ($member->partner_cast === 'Any') {
            $partner_cast = Member::where('cast', '!=', '')->distinct()->pluck('cast')->toArray();
        } else {
            $partner_cast = explode(',', $member->partner_cast ?? '');
        }

        $today = Carbon::today();

        $data['matching_profiles'] = Member::where('gender', '!=', $member->gender)
            ->where('id', '!=', $id)
            ->where('birth_date_time', 'not like', '%00:30:00%')
            ->get()
            ->filter(function ($profile) use (
                $member,
                $today,
                $partner_country,
                $partner_religion,
                $partner_cast,
                $partner_education,
                $partner_mothertongue
            ) {

                $age = Carbon::parse($profile->birth_date_time)->diffInYears($today);
                return $age >= $member->partner_age_from &&
                    $age <= $member->partner_age_to &&
                    $profile->height >= $member->partner_height_from &&
                    $profile->height <= $member->partner_height_to &&
                    in_array($profile->religion, $partner_religion) &&
                    in_array($profile->country_living_in, $partner_country) &&
                    in_array($profile->cast, $partner_cast) &&
                    in_array($profile->education, $partner_education) &&
                    in_array($profile->mother_tongue, $partner_mothertongue);
            });
        dd($data['matching_profiles']);
        return view('dashboard/home', compact(['member', 'data']));
    }

    public function quick_search(Request $request)
    {
        $member = Auth::guard('member')->user();
        $id = $member->id;
        $data['religions'] = Religion::all();
        $data['casts'] = Cast::all();
        $data['mstatus'] = MaritalStatus::all();
        $memberGender = $member->gender;
        $today        = Carbon::now();
        $data['searchedMembers'] = [];
        $partnerAgeFrom  = null;
        $partnerAgeTo    = null;
        $partnerCasts    = null;
        $partnerReligions = null;
        $maritalStatus    = null;
        if ($request->query()) {
            $partnerAgeFrom     = $request->input('partner_age_from');
            $partnerAgeTo       = $request->input('partner_age_to');
            $partnerCasts       = (array) $request->input('partner_cast', []);
            $partnerReligions   = (array) $request->input('partner_religion', []);
            $maritalStatus      = $request->input('marital_status');

            $data['members'] = Member::where('gender', '!=', $memberGender)
                ->where('id', '!=', $id)
                ->where('active', 'yes')
                ->when(!empty($maritalStatus), function ($q) use ($maritalStatus) {
                    $q->where('marital_status', $maritalStatus);
                })
                ->when(!empty($partnerReligions), function ($q) use ($partnerReligions) {
                    $q->whereIn('religion', $partnerReligions);
                })
                ->when(!empty($partnerCasts), function ($q) use ($partnerCasts) {
                    $q->whereIn('cast', $partnerCasts);
                })
                ->orderBy('activation_number', 'desc')
                ->get()
                ->filter(function ($m) use ($partnerAgeFrom, $partnerAgeTo) {
                    if ($partnerAgeFrom && $partnerAgeTo) {
                        return $m->age >= $partnerAgeFrom && $m->age <= $partnerAgeTo;
                    } elseif ($partnerAgeFrom) {
                        return $m->age >= $partnerAgeFrom;
                    } elseif ($partnerAgeTo) {
                        return $m->age <= $partnerAgeTo;
                    }
                    return true; // no age filter applied
                });

            foreach ($data['members'] as $key => $recent) {
                $birthDate = Carbon::parse($recent->birth_date_time);
                $diff = $birthDate->diff($today);

                $data['searchedMembers'][$key]['age_years']  = $diff->y;
                $data['searchedMembers'][$key]['age_months'] = $diff->m;

                if (!empty($recent->photo) && $recent->photo_approved === "Yes") {
                    $data['searchedMembers'][$key]['photo'] = "https://himrishtey.com/photos/photo/" . $recent->photo;
                } elseif ($recent->gender === "Male") {
                    $data['searchedMembers'][$key]['photo'] = "https://himrishtey.com/img/boy.jpg";
                } elseif ($recent->gender === "Female") {
                    $data['searchedMembers'][$key]['photo'] = "https://himrishtey.com/img/girl.jpg";
                }

                if ($recent->member_type === 'Verified') {
                    $data['searchedMembers'][$key]['member_type'] = "https://himrishtey.com/img/verified.png";
                    $data['searchedMembers'][$key]['mem_type']    = "Yes";
                } else {
                    $data['searchedMembers'][$key]['member_type'] = "normal";
                }

                if ($recent->is_trusted === 'Trusted') {
                    $data['searchedMembers'][$key]['is_trusted'] = "https://himrishtey.com/img/trusted.png";
                } else {
                    $data['searchedMembers'][$key]['is_trusted'] = "No";
                }

                $data['searchedMembers'][$key] = array_merge($recent->toArray(), $data['searchedMembers'][$key]);
            }
        }

        return view('dashboard.quick_search', compact(
            'member',
            'data',
            'partnerAgeFrom',
            'partnerAgeTo',
            'partnerReligions',
            'partnerCasts',
            'maritalStatus'
        ));
    }


    public function search_by_profile_id(Request $request)
    {
        $member = Auth::guard('member')->user();
        $id     = $member->id;
        $gender = $member->gender;
        $today  = Carbon::now();
        $profile = null;
        $profile_id = null;
        if ($request->filled('profile_id')) {
            $profile_id = $request->input('profile_id');

            $profile = Member::where('gender', '!=', $gender)
                ->where('id', '!=', $id)
                ->where('profile_id', $profile_id)
                ->where('profile_hide', '!=', 'yes')
                ->where('active', 'Yes')
                ->first();
            if ($profile) {
                // Calculate age
                $birthDate = Carbon::parse($profile->birth_date_time);
                $diff = $birthDate->diff($today);
                $profile['age_years']  = $diff->y;
                $profile['age_months'] = $diff->m;

                // Photo
                if (!empty($profile->photo) && $profile->photo_approved === "Yes") {
                    $profile['photo'] = "https://himrishtey.com/photos/photo/" . $profile->photo;
                } elseif ($profile->gender === "Male") {
                    $profile['photo'] = "https://himrishtey.com/img/boy.jpg";
                } elseif ($profile->gender === "Female") {
                    $profile['photo'] = "https://himrishtey.com/img/girl.jpg";
                }

                // Member type
                if ($profile->member_type === 'Verified') {
                    $profile['member_type'] = "https://himrishtey.com/img/verified.png";
                    $profile['mem_type']    = "Yes";
                } else {
                    $profile['member_type'] = "normal";
                }

                // Trusted
                if ($profile->is_trusted === 'Trusted') {
                    $profile['is_trusted'] = "https://himrishtey.com/img/trusted.png";
                } else {
                    $profile['is_trusted'] = "No";
                }
            }
        }

        return view('dashboard.search_profile', compact(['profile', 'profile_id']));
    }

    public function interest_box()
    {
        $data['received_pending_interests'] = $this->received_pending_interest();
        $data['received_accepted_interests'] = $this->received_accepted_interest();
        $data['received_rejected_interests'] = $this->received_rejected_interest();
        $data['sent_pending_interests'] = $this->sent_pending_interest();
        $data['sent_accepted_interests'] = $this->sent_accepted_interest();
        $data['sent_rejected_interests'] = $this->sent_rejected_interest();
        return view('dashboard.interest_box', compact('data'));
    }

    public function received_pending_interest()
    {
        $user_id = Auth::guard('member')->user()->id;
        $results = DB::table('members')
            ->join('sent_interests', 'members.id', '=', 'sent_interests.member_id')
            ->select(
                'members.*',
                'sent_interests.member_id',
                DB::raw("DATE_FORMAT(members.birth_date_time, '%d-%m-%Y %I:%i:%S %p') as birthdatetime")
            )
            ->where('sent_interests.profile_id', $user_id)
            ->where('members.profile_hide', '!=', 'yes')
            ->where('members.active', 'Yes')
            ->where('sent_interests.status', 0)
            ->orderBy('sent_interests.id', 'desc')
            ->get();

        foreach ($results as $key => $result) {
            if (!empty($result->photo) && $result->photo_approved === "Yes") {
                $results[$key]->photo = 'https://himrishtey.com/photos/photo/' . $result->photo;
            } elseif ($result->gender === "Male") {
                $results[$key]->photo = "https://himrishtey.com/img/boy.jpg";
            } elseif ($result->gender === "Female") {
                $results[$key]->photo = "https://himrishtey.com/img/girl.jpg";
            }
            if (!empty($result->birth_date_time)) {
                $birthDate = Carbon::parse($result->birth_date_time);
                $ageDiff   = $birthDate->diff(Carbon::today());

                $results[$key]->age_years  = $ageDiff->y;
                $results[$key]->age_months = $ageDiff->m;
            } else {
                $results[$key]->age_years = null;
                $results[$key]->age_months = null;
            }
            if ($result->member_type === 'Verified') {
                $results[$key]->member_type = "https://himrishtey.com/img/verified.png";
                $results[$key]->mem_type    = "Yes";
            } else {
                $results[$key]->member_type = 'normal';
            }
            if ($result->is_trusted === 'Trusted') {
                $results[$key]->is_trusted = "https://himrishtey.com/img/trusted.png";
            }
        }

        return $results;
    }

    public function received_accepted_interest()
    {
        $user_id = Auth::guard('member')->user()->id;
        $results = DB::table('members')
            ->join('sent_interests', 'members.id', '=', 'sent_interests.member_id')
            ->select(
                'members.*',
                'sent_interests.member_id',
                DB::raw("DATE_FORMAT(members.birth_date_time, '%d-%m-%Y %I:%i:%S %p') as birthdatetime")
            )
            ->where('sent_interests.profile_id', $user_id)
            ->where('members.profile_hide', '!=', 'yes')
            ->where('members.active', 'Yes')
            ->where('sent_interests.status', 1)
            ->orderBy('sent_interests.id', 'desc')
            ->get();

        foreach ($results as $key => $result) {
            if (!empty($result->photo) && $result->photo_approved === "Yes") {
                $results[$key]->photo = 'https://himrishtey.com/photos/photo/' . $result->photo;
            } elseif ($result->gender === "Male") {
                $results[$key]->photo = "https://himrishtey.com/img/boy.jpg";
            } elseif ($result->gender === "Female") {
                $results[$key]->photo = "https://himrishtey.com/img/girl.jpg";
            }
            if (!empty($result->birth_date_time)) {
                $birthDate = Carbon::parse($result->birth_date_time);
                $ageDiff   = $birthDate->diff(Carbon::today());

                $results[$key]->age_years  = $ageDiff->y;
                $results[$key]->age_months = $ageDiff->m;
            } else {
                $results[$key]->age_years  = null;
                $results[$key]->age_months = null;
            }
            if ($result->member_type === 'Verified') {
                $results[$key]->member_type = "https://himrishtey.com/img/verified.png";
                $results[$key]->mem_type    = "Yes";
            } else {
                $results[$key]->member_type = 'normal';
            }
            if ($result->is_trusted === 'Trusted') {
                $results[$key]->is_trusted = "https://himrishtey.com/img/trusted.png";
            }
        }

        return $results;
    }

    public function received_rejected_interest()
    {
        $user_id = Auth::guard('member')->user()->id;
        $results = DB::table('members')
            ->join('sent_interests', 'members.id', '=', 'sent_interests.member_id')
            ->select(
                'members.*',
                'sent_interests.member_id',
                DB::raw("DATE_FORMAT(members.birth_date_time, '%d-%m-%Y %I:%i:%S %p') as birthdatetime")
            )
            ->where('sent_interests.profile_id', $user_id)
            ->where('members.profile_hide', '!=', 'yes')
            ->where('members.active', 'Yes')
            ->where('sent_interests.status', 2) // ✅ rejected only
            ->orderBy('sent_interests.id', 'desc')
            ->get();

        foreach ($results as $key => $result) {
            if (!empty($result->photo) && $result->photo_approved === "Yes") {
                $results[$key]->photo = 'https://himrishtey.com/photos/photo/' . $result->photo;
            } elseif ($result->gender === "Male") {
                $results[$key]->photo = "https://himrishtey.com/img/boy.jpg";
            } elseif ($result->gender === "Female") {
                $results[$key]->photo = "https://himrishtey.com/img/girl.jpg";
            }
            if (!empty($result->birth_date_time)) {
                $birthDate = Carbon::parse($result->birth_date_time);
                $ageDiff   = $birthDate->diff(Carbon::today());

                $results[$key]->age_years  = $ageDiff->y;
                $results[$key]->age_months = $ageDiff->m;
            } else {
                $results[$key]->age_years  = null;
                $results[$key]->age_months = null;
            }
            if ($result->member_type === 'Verified') {
                $results[$key]->member_type = "https://himrishtey.com/img/verified.png";
                $results[$key]->mem_type    = "Yes";
            } else {
                $results[$key]->member_type = 'normal';
            }
            if ($result->is_trusted === 'Trusted') {
                $results[$key]->is_trusted = "https://himrishtey.com/img/trusted.png";
            }
        }

        return $results;
    }

    public function sent_pending_interest()
    {
        $user_id = Auth::guard('member')->user()->id;
        $results = DB::table('members')
            ->join('sent_interests', 'members.id', '=', 'sent_interests.profile_id')
            ->select(
                'members.*',
                'sent_interests.member_id',
                DB::raw("DATE_FORMAT(members.birth_date_time, '%d-%m-%Y %I:%i:%S %p') as birthdatetime")
            )
            ->where('sent_interests.member_id', $user_id)
            ->where('members.profile_hide', '!=', 'yes')
            ->where('members.active', 'Yes')
            ->where('sent_interests.status', 0) // ✅ pending sent requests
            ->orderBy('sent_interests.id', 'desc')
            ->get();

        foreach ($results as $key => $result) {
            if (!empty($result->photo) && $result->photo_approved === "Yes") {
                $results[$key]->photo = 'https://himrishtey.com/photos/photo/' . $result->photo;
            } elseif ($result->gender === "Male") {
                $results[$key]->photo = "https://himrishtey.com/img/boy.jpg";
            } elseif ($result->gender === "Female") {
                $results[$key]->photo = "https://himrishtey.com/img/girl.jpg";
            }
            if (!empty($result->birth_date_time)) {
                $birthDate = Carbon::parse($result->birth_date_time);
                $ageDiff   = $birthDate->diff(Carbon::today());

                $results[$key]->age_years  = $ageDiff->y;
                $results[$key]->age_months = $ageDiff->m;
            } else {
                $results[$key]->age_years = null;
                $results[$key]->age_months = null;
            }
            if ($result->member_type === 'Verified') {
                $results[$key]->member_type = "https://himrishtey.com/img/verified.png";
                $results[$key]->mem_type    = "Yes";
            } else {
                $results[$key]->member_type = 'normal';
            }
            if ($result->is_trusted === 'Trusted') {
                $results[$key]->is_trusted = "https://himrishtey.com/img/trusted.png";
            }
        }

        return $results;
    }

    public function sent_accepted_interest()
    {
        $user_id = Auth::guard('member')->user()->id;
        $results = DB::table('members')
            ->join('sent_interests', 'members.id', '=', 'sent_interests.profile_id')
            ->select(
                'members.*',
                'sent_interests.member_id',
                DB::raw("DATE_FORMAT(members.birth_date_time, '%d-%m-%Y %I:%i:%S %p') as birthdatetime")
            )
            ->where('sent_interests.member_id', $user_id)
            ->where('members.profile_hide', '!=', 'yes')
            ->where('members.active', 'Yes')
            ->where('sent_interests.status', 1) // ✅ pending sent requests
            ->orderBy('sent_interests.id', 'desc')
            ->get();

        foreach ($results as $key => $result) {
            if (!empty($result->photo) && $result->photo_approved === "Yes") {
                $results[$key]->photo = 'https://himrishtey.com/photos/photo/' . $result->photo;
            } elseif ($result->gender === "Male") {
                $results[$key]->photo = "https://himrishtey.com/img/boy.jpg";
            } elseif ($result->gender === "Female") {
                $results[$key]->photo = "https://himrishtey.com/img/girl.jpg";
            }
            if (!empty($result->birth_date_time)) {
                $birthDate = Carbon::parse($result->birth_date_time);
                $ageDiff   = $birthDate->diff(Carbon::today());

                $results[$key]->age_years  = $ageDiff->y;
                $results[$key]->age_months = $ageDiff->m;
            } else {
                $results[$key]->age_years = null;
                $results[$key]->age_months = null;
            }
            if ($result->member_type === 'Verified') {
                $results[$key]->member_type = "https://himrishtey.com/img/verified.png";
                $results[$key]->mem_type    = "Yes";
            } else {
                $results[$key]->member_type = 'normal';
            }
            if ($result->is_trusted === 'Trusted') {
                $results[$key]->is_trusted = "https://himrishtey.com/img/trusted.png";
            }
        }

        return $results;
    }

    public function sent_rejected_interest()
    {
        $user_id = Auth::guard('member')->user()->id;
        $results = DB::table('members')
            ->join('sent_interests', 'members.id', '=', 'sent_interests.profile_id')
            ->select(
                'members.*',
                'sent_interests.member_id',
                DB::raw("DATE_FORMAT(members.birth_date_time, '%d-%m-%Y %I:%i:%S %p') as birthdatetime")
            )
            ->where('sent_interests.member_id', $user_id)
            ->where('members.profile_hide', '!=', 'yes')
            ->where('members.active', 'Yes')
            ->where('sent_interests.status', 2) // ✅ pending sent requests
            ->orderBy('sent_interests.id', 'desc')
            ->get();

        foreach ($results as $key => $result) {
            if (!empty($result->photo) && $result->photo_approved === "Yes") {
                $results[$key]->photo = 'https://himrishtey.com/photos/photo/' . $result->photo;
            } elseif ($result->gender === "Male") {
                $results[$key]->photo = "https://himrishtey.com/img/boy.jpg";
            } elseif ($result->gender === "Female") {
                $results[$key]->photo = "https://himrishtey.com/img/girl.jpg";
            }
            if (!empty($result->birth_date_time)) {
                $birthDate = Carbon::parse($result->birth_date_time);
                $ageDiff   = $birthDate->diff(Carbon::today());

                $results[$key]->age_years  = $ageDiff->y;
                $results[$key]->age_months = $ageDiff->m;
            } else {
                $results[$key]->age_years = null;
                $results[$key]->age_months = null;
            }
            if ($result->member_type === 'Verified') {
                $results[$key]->member_type = "https://himrishtey.com/img/verified.png";
                $results[$key]->mem_type    = "Yes";
            } else {
                $results[$key]->member_type = 'normal';
            }
            if ($result->is_trusted === 'Trusted') {
                $results[$key]->is_trusted = "https://himrishtey.com/img/trusted.png";
            }
        }

        return $results;
    }

    public function view_my_profile()
    {
        $profile = Auth::guard('member')->user();
        //dd($profile);
        $profilegallery = $profile->photos()->get();
        if (!empty($profile->photo)) {
            $profile->photo = 'https://himrishtey.com/photos/photo/' . $profile->photo;
        } elseif ($profile->gender === "Male") {
            $profile->photo = "https://himrishtey.com/img/boy.jpg";
        } elseif ($profile->gender === "Female") {
            $profile->photo = "https://himrishtey.com/img/girl.jpg";
        }
        if (!empty($profile->height)) {
            $height = (string) $profile->height;

            if (str_contains($height, '.')) {
                [$feet, $inches] = explode('.', $height);
            } else {
                $feet = $height;
                $inches = 0;
            }

            $profile->formatted_height = $feet . "'" . $inches . '" ft';
        } else {
            $profile->formatted_height = 'N/A';
        }
        $birthDate = Carbon::parse($profile->birth_date_time);
        $ageDiff   = $birthDate->diff(Carbon::today());
        $profile->age_years  = $ageDiff->y;
        $profile->age_months = $ageDiff->m;
        return view('dashboard.view-my-profile', compact('profile', 'profilegallery'));
    }

    public function viewed_contacts()
    {
        $id     = Auth::guard('member')->user()->id;
        $today  = Carbon::today()->format('Y-m-d');

        $results = DB::table('members')
            ->join('viewed_contacts', 'members.id', '=', 'viewed_contacts.profile_id')
            ->select(
                'members.*',
                'viewed_contacts.member_id',
                DB::raw("DATE_FORMAT(members.birth_date_time, '%d-%m-%Y %I:%i:%S %p') as birthdatetime")
            )
            ->where('viewed_contacts.member_id', $id)
            ->where('members.profile_hide', '!=', 'yes')
            ->where('members.active', 'Yes')
            ->orderBy('viewed_contacts.id', 'asc')
            ->get();

        $data['contacts'] = [];

        foreach ($results as $key => $recent) {
            // Age calculation
            $birthDate = Carbon::parse($recent->birth_date_time);
            $diff      = $birthDate->diff(Carbon::today());

            $data['contacts'][$key]['age_years']  = $diff->y;
            $data['contacts'][$key]['age_months'] = $diff->m;

            // Profile photo
            if (!empty($recent->photo) && $recent->photo_approved === "Yes") {
                $data['contacts'][$key]['photo'] = "https://himrishtey.com/photos/photo/" . $recent->photo;
            } elseif ($recent->gender === "Male") {
                $data['contacts'][$key]['photo'] = "https://himrishtey.com/img/boy.jpg";
            } elseif ($recent->gender === "Female") {
                $data['contacts'][$key]['photo'] = "https://himrishtey.com/img/girl.jpg";
            }

            // Member type (verified or not)
            if ($recent->member_type === 'Verified') {
                $data['contacts'][$key]['member_type'] = "https://himrishtey.com/img/verified.png";
                $data['contacts'][$key]['mem_type']    = "Yes";
            } else {
                $data['contacts'][$key]['member_type'] = "normal";
            }

            // Trusted status
            if ($recent->is_trusted === 'Trusted') {
                $data['contacts'][$key]['is_trusted'] = "https://himrishtey.com/img/trusted.png";
            } else {
                $data['contacts'][$key]['is_trusted'] = "No";
            }

            // Merge original record into array (convert stdClass → array)
            $data['contacts'][$key] = array_merge((array) $recent, $data['contacts'][$key]);
        }

        return view('dashboard.viewed_contacts', compact('data'));
    }

    public function view_profile($profileId, EmailService $emailService)
    {
        $data['user_id'] = Auth::guard('member')->user()->id;
        $profilemain = Member::findOrFail($profileId);
        $data['photos'] = $profilemain->photos()->get();
        $data['profile_id'] = $profileId;
        $usr = DB::table('members')
            ->where('id', $data['profile_id'])
            ->where('profile_hide', '!=', 'yes')
            ->where('active', 'Yes')
            ->first();

        if (!$usr) {
            return null;
        }

        // Check sent interest
        $profile = DB::table('sent_interests')
            ->where('member_id', $data['user_id'])
            ->where('profile_id', $data['profile_id'])
            ->first();
        // Shortlisted count
        $short = DB::table('short_listed')
            ->where('member_id', $data['user_id'])
            ->where('profile_id', $data['profile_id'])
            ->count();

        // Profile views count
        $viewed_profile  = DB::table('profile_viewed')->where('member_id', $data['user_id'])->count();
        $viewed_contacts = DB::table('viewed_contacts')->where('member_id', $data['user_id'])->count();

        // Current user
        $pc_user = DB::table('members')->where('id', $data['user_id'])->first();

        // Already viewed contact?
        $viewed_contact = DB::table('viewed_contacts')
            ->where('member_id', $data['user_id'])
            ->where('profile_id', $data['profile_id'])
            ->first();

        $usr->profile_viewed = $viewed_contact ? 'Yes' : 'No';

        // Fix birth_date_time formatting
        if (!empty($usr->birth_date_time)) {
            $datee = $usr->birth_date_time;
            if (strpos($datee, 'AM') || strpos($datee, 'PM')) {
                $date = new DateTime($datee);
                $usr->birth_date_time = $date->format('Y-m-d H:i:s');
            }
        }

        // Check like profile
        $like_profile = DB::table('profile_like')
            ->where('user_id', $data['user_id'])
            ->where('like_profile_id', $data['profile_id'])
            ->where('status', '1')
            ->first();

        $usr->like = $like_profile ? 'Yes' : 'No';

        // Profile created for mapping
        $map = [
            'Self' => 'Self',
            'Relative' => 'Relative',
            'Son' => 'Parents',
            'Daughter' => 'Parents',
            'Brother' => 'Sibilings',
            'Sister' => 'Sibilings',
            'Client (Marriage bureau)' => 'Marriage Bureau'
        ];
        $usr->profile_created_for = $map[$usr->profile_created_for] ?? 'Friend';

        // View count logic
        $vvcnt   = $pc_user->profile_view_count ?? 0;
        $vcontact = $vvcnt + 2 + $viewed_contacts;
        $usrtt   = strval($vcontact);

        // Shorten full name (first + initial)
        $full_name = $usr->full_name;
        $fname = explode(' ', $full_name);
        if (count($fname) > 1) {
            $first = mb_substr($fname[1], 0, 1);
            $usr->full_name = $fname[0] . ' ' . $first;
        } else {
            $usr->full_name = $full_name;
        }

        // Get profile range pricing
        $result = DB::table('member_profile_range')
            ->where('member_id', $data['profile_id'])
            ->whereRaw('? BETWEEN range_from AND range_to', [$vcontact])
            ->first();

        $usr->profile_view_price = $result ? $result->price : '0';
        $usr->interest = $profile ? '1' : '0';
        $usr->shortlisted = $short ? 'Yes' : 'No';
        if (!empty($usr->photo) && $usr->photo_approved === "Yes") {
            $usr->photo = 'https://himrishtey.com/photos/photo/' . $usr->photo;
        } elseif ($usr->gender === "Male") {
            $usr->photo = "https://himrishtey.com/img/boy.jpg";
        } elseif ($usr->gender === "Female") {
            $usr->photo = "https://himrishtey.com/img/girl.jpg";
        }

        if ($usr->member_type === 'Verified') {
            $usr->member_type = "https://himrishtey.com/img/promoted.png";
        } else {
            $usr->member_type = "normal";
        }

        // Trusted status
        if ($usr->is_trusted === 'Trusted') {
            $usr->is_trusted = "https://himrishtey.com/img/trusted.png";
        }

        // Final viewed profile count
        $profile_count = DB::table('members')->where('id', $data['user_id'])->value('profile_view_count');
        $cnt2 = $profile_count ?? 0;
        $cnt  = $viewed_contacts + $cnt2;

        $usr->viewed_profile = (string) $cnt;

        $profile_viewed_check =  ProfileViewed::where('member_id', $data['user_id'])->where('viewed_profile_id', $data['profile_id'])->first();
        if (empty($profile_viewed_check)) {
            $profile_viewed_by_me = new ProfileViewed();
            $profile_viewed_by_me->member_id = $data['user_id'];
            $profile_viewed_by_me->viewed_profile_id = $data['profile_id'];
            $profile_viewed_by_me->save();
            $emailService->viewProfile($profilemain, $usr);
        }
        $wallet = MemberWallet::where('member_id', $data['user_id'])
            ->latest('created_at')
            ->first();

        $interest_action = SentInterest::where('member_id', $data['profile_id'])->where('profile_id', $data['user_id'])->where('status', 0)->first();

        if (!empty($interest_action)) {
            $usr->interest_action = '1';
        } else {
            $interest_action_2 = SentInterest::where('member_id', $data['profile_id'])->where('profile_id', $data['user_id'])->whereIn('status', [1, 2])->first();
            if (!empty($interest_action_2)) {
                $usr->interest_action = '2';
            } else {
                $usr->interest_action = '0';
            }
        }
        $birthDate = Carbon::parse($usr->birth_date_time);
        $diff      = $birthDate->diff(Carbon::today());

        $usr->age_years  = $diff->y;
        $usr->age_months = $diff->m;

        // dd($usr);
        return view('dashboard.view_profile', compact('usr', 'data', 'wallet'));
    }

    public function send_interest(Request $request, EmailService $emailservice, NimbusSmsService $messageService, $id)
    {
        $member = Auth::guard('member')->user();
        $profile = Member::find($id);
        $status = $request->input('status');
        $email = [
            'from_name' => $member->full_name,
            'from_profile_id' => $member->profile_id,
            'to_full_name' => $profile->full_name,
            'to_profile_id' => $profile->profile_id,
            'to_phone'  => $profile->mobile_number,
            "to_email" => $profile->email,
            "status" => $status,
            "token"  => $profile->google_token
        ];
        $plan_id = $member->plan_id;
        $user_id = $member->id;

        $profile_id = $id;
        if ($plan_id == 0 || empty($plan_id)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Please upgrade your membership plan'
            ], 403);
        }
        $checkInterest = SentInterest::where('member_id', $user_id)
            ->where('profile_id', $profile_id)
            ->first();

        $checkedInterest = SentInterest::where('member_id', $profile_id)
            ->where('profile_id', $user_id)
            ->first();
        if (empty($checkInterest)) {
            if (!empty($checkedInterest)) {
                $checkedInterest->status = $status;
                $emailservice->interestEmail($email);
                if ($checkedInterest->save()) {
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Interest status changed successfully'
                    ]);
                }
            } else {
                $newInterest = new SentInterest();
                $newInterest->member_id = $user_id;
                $newInterest->profile_id = $profile_id;
                $newInterest->status = $status;
                $messageService->sendInterest($email);
                $emailservice->interestEmail($email);
                $this->sendFCM($email);
                if ($newInterest->save()) {
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Interest sent successfully'
                    ], 200);
                } else {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Failed to send interest'
                    ], 500);
                }
            }
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Interest already sent'
            ], 409);
        }
    }

    public function referral()
    {

        return view('dashboard.referral');
    }

    public function success_stories()
    {
        $userId = Auth::guard('member')->user()->id;

        $success_stories = SuccessStory::where('user_id', $userId)->get();

        return view('dashboard.success_stories', compact('success_stories'));
    }


    public function stories_store(Request $request)
    {
        $request->validate([
            'groom_name' => 'required|string|max:255',
            'bride_name' => 'required|string|max:255',
            'photo'      => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'detail'     => 'required|string',
        ]);

        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $image = $request->file('photo');
            $imageName = 'story-image-' . time() . '.' . $image->getClientOriginalExtension();
            $originalImagePath = public_path('../../photos/ss/');
            $image->move($originalImagePath, $imageName);
        }

        SuccessStory::create([
            'groom_name' => $request->groom_name,
            'bride_name' => $request->bride_name,
            'photo'      => $imageName,
            'detail'     => $request->detail,
            'user_id'    => Auth::guard('member')->user()->id
        ]);

        return redirect()->back()->with('success', 'Your story has been posted successfully!');
    }
    public function update(Request $request, $id)
    {
        $story = SuccessStory::findOrFail($id);

        $request->validate([
            'groom_name' => 'required|string|max:255',
            'bride_name' => 'required|string|max:255',
            'photo'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'detail'     => 'required|string',
        ]);

        if ($request->hasFile('photo')) {
            if (File::exists(public_path('../../photos/ss/' . $story->photo))) {
                File::delete(public_path('../../photos/ss/' . $story->photo));
            }
            $photoName = time() . '_' . $request->photo->getClientOriginalName();
            $request->photo->move(public_path('../../photos/ss'), $photoName);
            $story->photo = $photoName;
        }

        $story->groom_name = $request->groom_name;
        $story->bride_name = $request->bride_name;
        $story->detail     = $request->detail;
        $story->save();

        return redirect()->back()->with('success', 'Story updated successfully!');
    }

    public function destroy($id)
    {
        $story = SuccessStory::findOrFail($id);

        if (File::exists(public_path('../../photos/ss/' . $story->photo))) {
            File::delete(public_path('../../photos/ss/' . $story->photo));
        }

        $story->delete();

        return redirect()->back()->with('success', 'Story deleted successfully!');
    }

    public function terms_conditions()
    {
        return view('dashboard.terms_and_conditions');
    }
    public function privacy_policy()
    {
        return view('dashboard.privacy_policy');
    }
    public function refund()
    {
        return view('dashboard.refund');
    }
    public function rating()
    {

        return view('dashboard.rateus');
    }

    public function rating_store(Request $request)
    {
        $request->validate([
            'stars' => 'required',
            'feedback' => 'nullable|string|max:1000',
        ]);

        \DB::table('user_rating')->insert([
            'profile_id' => Auth::guard('member')->user()->profile_id,
            'name' => Auth::guard('member')->user()->full_name,
            'email' => Auth::guard('member')->user()->email,
            'rating' => $request->stars,
            'description' => $request->feedback,
            'submitted_on' => now(),
        ]);

        return response()->json(['message' => 'Rating submitted successfully!']);
    }

    public function unlock_contact(Request $request, $profileId)
    {
        $userId = auth()->guard('member')->user()->id;

        $usr = DB::table('members')
            ->where('id', $profileId)
            ->where('profile_hide', '!=', 'yes')
            ->where('active', 'Yes')
            ->first();

        if (!$usr) {
            return response()->json(['status' => 'error', 'message' => 'Profile not found.']);
        }

        $unlockPrice = (int) $request->input('unlock_price', 0);

        $wallet = MemberWallet::where('member_id', $userId)
            ->latest('created_at')
            ->first();

        if (!$wallet || $wallet->wallet_balance < $unlockPrice) {
            return response()->json(['status' => 'error', 'message' => 'Insufficient balance.']);
        }

        $wallet->wallet_balance -= $unlockPrice;
        $wallet->save();

        DB::table('viewed_contacts')->insert([
            'member_id'  => $userId,
            'profile_id' => $profileId,
            'viewed_date' => now(),
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Contact unlocked successfully!',
            'mobile_number'   => $usr->mobile_number,
            'whatsapp_number' => $usr->whatsapp_number,
            'email'           => $usr->email,
            'wallet_balance'  => $wallet->wallet_balance
        ]);
    }

    public function like_profile(Request $request)
    {
        $member = Auth::guard('member')->user();
        $status = $request->input('status');
        $id = $request->input('id');
        $user_id = $member->id;
        $plan_id = $member->plan_id;
        $profile_id = $id;
        if ($plan_id == 0 || empty($plan_id)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Please upgrade your membership plan'
            ], 403);
        }

        $newInterest = new ProfileLike();
        $newInterest->user_id = $user_id;
        $newInterest->like_profile_id = $profile_id;
        $newInterest->status = $status;
        if ($status == 1) {
            $msg = 'Profile liked successfully';
        } else {
            $msg = 'Profile unliked successfully';
        }
        if ($newInterest->save()) {
            return response()->json([
                'status' => 'success',
                'message' => $msg
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to Like Profile'
            ], 500);
        }
    }

    public function shortlist_profile(Request $request, EmailService $emailservice)
    {
        $member = Auth::guard('member')->user();
        $status = $request->input('status');
        $id = $request->input('id');
        $user_id = $member->id;
        $plan_id = $member->plan_id;
        $profile_id = $id;
        $profile = Member::find($id);
        if ($plan_id == 0 || empty($plan_id)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Please upgrade your membership plan'
            ], 403);
        }
        $newInterest = new Shortlist();
        $newInterest->member_id = $user_id;
        $newInterest->profile_id = $profile_id;
        $emailservice->shortlist($profile, $member);
        if ($newInterest->save()) {
            return response()->json([
                'status' => 'success',
                'message' => "Profile Shortlisted"
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to Shortlist Profile'
            ], 500);
        }
    }

    public function sendFCM($data)
    {
        $fcm = new PushNotificationService();
        $deviceToken = $data['token'];

        $response = $fcm->sendNotification(
            $deviceToken,
            "Test Notification",
            "This is a test message",
            ['screen' => 'home']
        );

        return $response;
    }
}
