@extends('layouts.dashboard')
@section('title', 'Edit Profile - HimRishtey')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/edit-profile.css') }}" />
@endsection

<!-- ========== SIDEBAR DRAWER (from base) ========== -->
@php
$birthDate = $member->birth_date_time
? \Carbon\Carbon::parse($member->birth_date_time)
: null;
@endphp

@section('content')
<!-- ========== MAIN LAYOUT ========== -->
<main class="ep-main" id="main-content">

    <!-- Page Header -->
    <div class="ep-page-header">
        <div>
            <h1 class="ep-page-title">Edit Profile</h1>
            <p class="ep-page-subtitle">Keep your profile complete to get better matches</p>
        </div>
        <!-- Overall completion bar -->
        <div class="ep-overall-completion">
            <span class="ep-completion-label">Profile Completion</span>
            <div class="ep-completion-bar-wrap">
                <div class="ep-completion-bar" style="width: {{ $profilePercent }}%;"></div>
            </div>
            <span class="ep-completion-pct">{{$profilePercent}}%</span>
        </div>
    </div>

    <div class="ep-layout">

        <!-- ===== LEFT SIDEBAR TABS ===== -->
        <aside class="ep-tab-sidebar" role="tablist" aria-label="Profile sections">
            <button class="ep-tab-btn active" data-tab="basic-info" role="tab" aria-selected="false" aria-controls="tab-basic-info">
                <span class="ep-tab-icon"><i data-lucide="badge-info" width="18" height="18"></i></span>
                <span class="ep-tab-label">Basic Info</span>
                <span class="ep-tab-status incomplete" title="Incomplete"><i data-lucide="circle" width="14" height="14"></i></span>
            </button>
            <button class="ep-tab-btn" data-tab="astro" role="tab" aria-selected="true" aria-controls="tab-astro">
                <span class="ep-tab-icon"><i data-lucide="star" width="18" height="18"></i></span>
                <span class="ep-tab-label">Astro & Kundli</span>
                <span class="ep-tab-status complete" title="Complete"><i data-lucide="check-circle" width="14" height="14"></i></span>
            </button>

            <button class="ep-tab-btn" data-tab="education" role="tab" aria-selected="false" aria-controls="tab-education">
                <span class="ep-tab-icon"><i data-lucide="graduation-cap" width="18" height="18"></i></span>
                <span class="ep-tab-label">Education & Career</span>
                <span class="ep-tab-status incomplete" title="Incomplete"><i data-lucide="circle" width="14" height="14"></i></span>
            </button>

            <button class="ep-tab-btn" data-tab="family" role="tab" aria-selected="false" aria-controls="tab-family">
                <span class="ep-tab-icon"><i data-lucide="users" width="18" height="18"></i></span>
                <span class="ep-tab-label">Family</span>
                <span class="ep-tab-status incomplete" title="Incomplete"><i data-lucide="circle" width="14" height="14"></i></span>
            </button>

            <button class="ep-tab-btn" data-tab="lifestyle" role="tab" aria-selected="false" aria-controls="tab-lifestyle">
                <span class="ep-tab-icon"><i data-lucide="heart-pulse" width="18" height="18"></i></span>
                <span class="ep-tab-label">Lifestyle</span>
                <span class="ep-tab-status incomplete" title="Incomplete"><i data-lucide="circle" width="14" height="14"></i></span>
            </button>

            <button class="ep-tab-btn" data-tab="religion" role="tab" aria-selected="false" aria-controls="tab-religion">
                <span class="ep-tab-icon"><i data-lucide="flame" width="18" height="18"></i></span>
                <span class="ep-tab-label">Religion</span>
                <span class="ep-tab-status complete" title="Complete"><i data-lucide="check-circle" width="14" height="14"></i></span>
            </button>

            <button class="ep-tab-btn" data-tab="preferences" role="tab" aria-selected="false" aria-controls="tab-preferences">
                <span class="ep-tab-icon"><i data-lucide="sliders-horizontal" width="18" height="18"></i></span>
                <span class="ep-tab-label">Partner Preferences</span>
                <span class="ep-tab-status incomplete" title="Incomplete"><i data-lucide="circle" width="14" height="14"></i></span>
            </button>

            <button class="ep-tab-btn" data-tab="contact" role="tab" aria-selected="false" aria-controls="tab-contact">
                <span class="ep-tab-icon"><i data-lucide="phone" width="18" height="18"></i></span>
                <span class="ep-tab-label">Contact Info</span>
                <span class="ep-tab-status complete" title="Complete"><i data-lucide="check-circle" width="14" height="14"></i></span>
            </button>

        </aside>

        <!-- ===== MOBILE TAB PILLS ===== -->
        <div class="ep-mobile-tabs" role="tablist" aria-label="Profile sections mobile">
            <button class="ep-mobile-tab active" data-tab="astro"><i data-lucide="star" width="16" height="16"></i> Astro</button>
            <button class="ep-mobile-tab " data-tab="basic-info"><i data-lucide="badge-info" width="16" height="16"></i> Basic Info</button>
            <button class="ep-mobile-tab" data-tab="education"><i data-lucide="graduation-cap" width="16" height="16"></i> Education</button>
            <button class="ep-mobile-tab" data-tab="family"><i data-lucide="users" width="16" height="16"></i> Family</button>
            <button class="ep-mobile-tab" data-tab="lifestyle"><i data-lucide="heart-pulse" width="16" height="16"></i> Lifestyle</button>
            <button class="ep-mobile-tab" data-tab="religion"><i data-lucide="flame" width="16" height="16"></i> Religion</button>
            <button class="ep-mobile-tab" data-tab="preferences"><i data-lucide="sliders-horizontal" width="16" height="16"></i> Preferences</button>
            <button class="ep-mobile-tab" data-tab="contact"><i data-lucide="phone" width="16" height="16"></i> Contact</button>
        </div>

        <!-- ===== TAB CONTENT PANELS ===== -->
        <div class="ep-tab-content">

            <!-- UNSAVED CHANGES TOAST -->
            <div class="ep-unsaved-toast" id="epUnsavedToast" aria-live="polite" hidden>
                <i data-lucide="alert-circle" width="16" height="16"></i>
                You have unsaved changes in this section.
            </div>
            <!-- ===== TAB 1: BASIC INFO ===== -->
            <section class="ep-tab-panel" id="tab-basic-info" role="tabpanel" hidden>
                <div class="ep-section-header">
                    <h2 class="ep-section-title"><i data-lucide="badge-info" width="20" height="20"></i> Basic Info</h2>
                </div>

                <form class="ep-form" id="form-basic-info" data-section="basic-info" novalidate>
                    <div class="ep-field-group ep-full-width">
                        <label class="ep-label" for="about_me">About</label>
                        <textarea class="ep-textarea" id="about_me" name="about_me" rows="3" placeholder="Write a short introduction about yourself...">{{ old( 'about_me',$member->about_me ) }}</textarea>
                    </div>

                    <div class="ep-field-group">
                        <label class="ep-label" for="profile_created_for">Profile Created By</label>

                        <div class="ep-select-wrapper">
                            <select class="ep-select" id="profile_created_for" name="profile_created_for">
                                <option value="Self" @selected(old('profile_created_for', $member->profile_created_for) == 'Self')>Self</option>
                                <option value="Parent" @selected(old('profile_created_for', $member->profile_created_for) == 'Parent')>Parent</option>
                                <option value="Sibling" @selected(old('profile_created_for', $member->profile_created_for) == 'Sibling')>Sibling</option>
                                <option value="Relative" @selected(old('profile_created_for', $member->profile_created_for) == 'Relative')>Relative</option>
                                <option value="Friend" @selected(old('profile_created_for', $member->profile_created_for) == 'Friend')>Friend</option>
                            </select>
                            <i data-lucide="chevron-down" width="16" height="16" class="ep-select-icon"></i>
                        </div>
                    </div>

                    <div class="ep-field-group">
                        <label class="ep-label" for="birth_date">Date of Birth</label>
                        <input class="ep-input" type="date" id="birth_date" name="birth_date" value="{{ old('date_of_birth', $birthDate?->format('Y-m-d')) }}" />
                    </div>

                    <div class="ep-field-group">
                        <label class="ep-label" for="birth_time">Time of Birth</label>
                        <input class="ep-input" type="time" id="birth_time" name="birth_time" value="{{ old('time_of_birth', $birthDate?->format('H:i')) }}" />
                    </div>

                    <div class="ep-field-group">
                        <label class="ep-label" for="height">Height</label>
                        <div class="ep-select-wrapper">
                            <select class="ep-select" id="height" name="height">
                                <option value="4.6" @selected(old('height', $member->height) == '4.6')>4'6"</option>
                                <option value="4.8" @selected(old('height', $member->height) == '4.8')>4'8"</option>
                                <option value="4.10" @selected(old('height', $member->height) == '4.10')>4'10"</option>
                                <option value="5.0" @selected(old('height', $member->height) == '5.0')>5'0"</option>
                                <option value="5.2" @selected(old('height', $member->height) == '5.2')>5'2"</option>
                                <option value="5.4" @selected(old('height', $member->height) == '5.4')>5'4"</option>
                                <option value="5.6" @selected(old('height', $member->height) == '5.6')>5'6"</option>
                                <option value="5.8" @selected(old('height', $member->height) == '5.8')>5'8"</option>
                                <option value="5.10" @selected(old('height', $member->height) == '5.10')>5'10"</option>
                                <option value="6.0" @selected(old('height', $member->height) == '6.0')>6'0"</option>
                                <option value="6.2" @selected(old('height', $member->height) == '6.2')>6'2"</option>
                            </select>
                            <i data-lucide="chevron-down" width="16" height="16" class="ep-select-icon"></i>
                        </div>
                    </div>

                    <div class="ep-field-group">
                        <label class="ep-label" for="religion">Religion</label>
                        <div class="ep-select-wrapper">
                            <select class="ep-select" id="religion" name="religion">
                                <option value="">Select</option>
                                <option value="Hindu" @selected(old('religion', $member->religion) == 'Hindu')>Hindu</option>
                                <option value="Muslim" @selected(old('religion', $member->religion) == 'Muslim')>Muslim</option>
                                <option value="Christian" @selected(old('religion', $member->religion) == 'Christian')>Christian</option>
                                <option value="Sikh" @selected(old('religion', $member->religion) == 'Sikh')>Sikh</option>
                                <option value="Buddhist" @selected(old('religion', $member->religion) == 'Buddhist')>Buddhist</option>
                                <option value="Jain" @selected(old('religion', $member->religion) == 'Jain')>Jain</option>
                            </select>
                            <i data-lucide="chevron-down" width="16" height="16" class="ep-select-icon"></i>
                        </div>
                    </div>

                    <div class="ep-field-group">
                        <label class="ep-label" for="cast">Caste</label>
                        <input class="ep-input" type="text" id="cast" name="cast" placeholder="e.g. Brahmin" value="{{ old('cast', $member->cast) }}" />
                    </div>

                    <div class="ep-field-group">
                        <label class="ep-label" for="marital_status">Marital Status</label>
                        <div class="ep-select-wrapper">
                            <select class="ep-select" id="marital_status" name="marital_status">
                                <option value="">Select</option>
                                <option value="Never Married" @selected(old('marital_status', $member->marital_status) == 'Never Married')>Never Married</option>
                                <option value="Divorced" @selected(old('marital_status', $member->marital_status) == 'Divorced')>Divorced</option>
                                <option value="Widowed" @selected(old('marital_status', $member->marital_status) == 'Widow')>Widowed</option>
                                <option value="Awaiting Divorce" @selected(old('marital_status', $member->marital_status) == 'Awaiting Divorce')>Awaiting Divorce</option>
                            </select>
                            <i data-lucide="chevron-down" width="16" height="16" class="ep-select-icon"></i>
                        </div>
                    </div>

                    <div class="ep-field-group" id="children-wrap" hidden>
                        <label class="ep-label" for="no_of_child">Children</label>
                        <div class="ep-select-wrapper">
                            <select class="ep-select" id="no_of_child" name="no_of_child">
                                <option value="">Select</option>
                                <option>0</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4+</option>
                            </select>
                            <i data-lucide="chevron-down" width="16" height="16" class="ep-select-icon"></i>
                        </div>
                    </div>

                    <div class="ep-field-group">
                        <label class="ep-label" for="country_living_in">Country</label>
                        <input class="ep-input" type="text" id="country_living_in" name="country_living_in" placeholder="e.g. India" value="{{ old('country_living_in', $member->country_living_in) }}" />
                    </div>

                    <div class="ep-field-group">
                        <label class="ep-label" for="state_living_in">State</label>
                        <input class="ep-input" type="text" id="state_living_in" name="state_living_in" placeholder="e.g. Himachal Pradesh" value="{{ old('state_living_in', $member->country_living_in) }}" />
                    </div>

                    <div class="ep-field-group">
                        <label class="ep-label" for="city_living_in">City</label>
                        <input class="ep-input" type="text" id="city_living_in" name="city_living_in" placeholder="e.g. Shimla" value="{{ old('city_living_in', $member->city_living_in) }}" />
                    </div>

                    <div class="ep-form-footer">
                        <button type="submit" class="ep-save-btn">
                            <i data-lucide="save" width="16" height="16"></i> Save Basic Info
                        </button>
                    </div>
                </form>
            </section>

            <!-- ===== TAB 1: ASTRO & KUNDLI ===== -->
            <section class="ep-tab-panel active" id="tab-astro" role="tabpanel" aria-labelledby="btn-astro">
                <div class="ep-section-header">
                    <h2 class="ep-section-title"><i data-lucide="star" width="20" height="20"></i> Astro & Kundli</h2>
                </div>

                <!-- Read-only info card -->
                @php
                $birthDateTime = \Carbon\Carbon::parse($member->birth_date_time);
                @endphp

                <div class="ep-info-card">
                    <div class="ep-info-row">
                        <span class="ep-info-label">Date of Birth</span>
                        <span class="ep-info-value">
                            {{ $birthDateTime->format('d M Y') }}
                        </span>
                    </div>

                    <div class="ep-info-row">
                        <span class="ep-info-label">Time of Birth</span>
                        <span class="ep-info-value">
                            {{ $birthDateTime->format('h:i A') }}
                        </span>
                    </div>

                    <a href="#" class="ep-info-link">
                        <i data-lucide="external-link" width="14" height="14"></i>
                        To edit date &amp; time, click here
                    </a>
                </div>

                <form class="ep-form" id="form-astro" data-section="astro" novalidate>
                    <div class="ep-field-group">
                        <label class="ep-label" for="manglik">Manglik</label>
                        <div class="ep-select-wrapper">
                            <select class="ep-select" id="manglik" name="manglik">
                                <option value="">Select</option>
                                <option value="Yes" @selected(old('manglik', $member->manglik) == 'Yes')>Yes</option>
                                <option value="No" @selected(old('manglik', $member->manglik) == 'No')>No</option>
                            </select>
                            <i data-lucide="chevron-down" width="16" height="16" class="ep-select-icon"></i>
                        </div>
                    </div>

                    <div class="ep-field-group">
                        <label class="ep-label" for="birth_place">Place of Birth</label>
                        <input class="ep-input" type="text" id="birth_place" name="birth_place" placeholder="e.g. Shimla, Himachal Pradesh" autocomplete="off" value="{{old('birth_place', $member->birth_place)}}" />
                    </div>

                    <div class="ep-form-footer">
                        <button type="submit" class="ep-save-btn">
                            <i data-lucide="save" width="16" height="16"></i> Save Astro Info
                        </button>
                    </div>
                </form>
            </section>

            <!-- ===== TAB 2: EDUCATION & CAREER ===== -->
            <section class="ep-tab-panel" id="tab-education" role="tabpanel" aria-labelledby="btn-education" hidden>
                <div class="ep-section-header">
                    <h2 class="ep-section-title"><i data-lucide="graduation-cap" width="20" height="20"></i> Education &amp; Career</h2>
                </div>

                <form class="ep-form" id="form-education" data-section="education" novalidate>
                    <div class="ep-field-group ep-full-width">
                        <label class="ep-label" for="about_my_education">About My Career &amp; Education</label>
                        <textarea class="ep-textarea" id="about_my_education" name="about_my_education" rows="3" placeholder="Brief description about your education and career...">{{old('about_my_education', $member->about_my_education)}}</textarea>
                    </div>

                    <div class="ep-field-group">
                        <label class="ep-label" for="education">Highest Education</label>
                        <div class="ep-select-wrapper">
                            <select class="ep-select" id="education" name="education">
                                <option value="">Select</option>
                                <option value="10" @selected(old('education', $member->education) == '10')>10th</option>
                                <option value="12" @selected(old('education', $member->education) == '12')>12th</option>
                                <option value="Diploma" @selected(old('education', $member->education) == 'Diploma')>Diploma</option>
                                <option value="B.A." @selected(old('education', $member->education) == 'B.A.')>B.A.</option>
                                <option value="B.Sc." @selected(old('education', $member->education) == 'B.Sc.')>B.Sc.</option>
                                <option value="B.Com." @selected(old('education', $member->education) == 'B.Com.')>B.Com.</option>
                                <option value="B.Tech / B.E." @selected(old('education', $member->education) == 'B.Tech / B.E.')>B.Tech / B.E.</option>
                                <option value="BBA" @selected(old('education', $member->education) == 'BBA')>BBA</option>
                                <option value="BCA" @selected(old('education', $member->education) == 'BCA')>BCA</option>
                                <option value="M.A." @selected(old('education', $member->education) == 'M.A.')>M.A.</option>
                                <option value="M.Sc." @selected(old('education', $member->education) == 'M.Sc.')>M.Sc.</option>
                                <option value="M.Com." @selected(old('education', $member->education) == 'M.Com.')>M.Com.</option>
                                <option value="M.Tech." @selected(old('education', $member->education) == 'M.Tech.')>M.Tech / M.E.</option>
                                <option value="MBA" @selected(old('education', $member->education) == 'MBA')>MBA</option>
                                <option value="MCA" @selected(old('education', $member->education) == 'MCA')>MCA</option>
                                <option value="Ph.D." @selected(old('education', $member->education) == 'Ph.D.')>Ph.D.</option>
                                <option value="Other" @selected(old('education', $member->education) == 'Other')>Other</option>
                            </select>
                            <i data-lucide="chevron-down" width="16" height="16" class="ep-select-icon"></i>
                        </div>
                    </div>

                    <div class="ep-field-group">
                        <label class="ep-label" for="any_other_qualifications">Other Qualification</label>
                        <input class="ep-input" type="text" id="any_other_qualifications" name="any_other_qualifications" placeholder="e.g. Chartered Accountant" value="{{old('any_other_qualifications', $member->any_other_qualifications)}}" />
                    </div>

                    <div class="ep-field-group">
                        <label class="ep-label" for="employed_in">Employed In</label>
                        <div class="ep-select-wrapper">
                            <select class="ep-select" id="employed_in" name="employed_in">
                                <option value="">Select</option>
                                <option value="Government" {{ old('employed_id', $member->employed_in) == 'Government' ? "slected" : ""}}>Government</option>
                                <option value="Private" {{ old('employed_id', $member->employed_in) == 'Private' ? "selected" : "" }}>Private</option>
                                <option value="Business" {{ old('employed_id', $member->employed_in) == 'Business' ? "selected" : "" }}>Business / Self Employed</option>
                                <option value="Defense" {{ old('employed_id', $member->employed_in) == 'Defense' ?  "selected" : "" }}>Defense</option>
                                <option value="Not Working" {{ old('employed_id', $member->employed_in) == 'Not Working' ? "selected" : "" }}>Not Working</option>
                            </select>
                            <i data-lucide="chevron-down" width="16" height="16" class="ep-select-icon"></i>
                        </div>
                    </div>
                    <div class="ep-field-group">
                        <label class="ep-label" for="occupation">Occupation</label>
                        <div class="ep-select-wrapper">
                            <select class="ep-select" id="occupation" name="occupation">
                                <option value="">Select</option>
                                <option value="Software Engineer" {{ old('occupation', $member->occupation) == 'Software developer' ? "slected" : "" }}>Software Engineer</option>
                                <option value="Doctor" {{ old('occupation', $member->occupation) == 'Doctor' ? "selected" : "" }}>Doctor</option>
                                <option value="Teacher" {{ old('occupation', $member->occupation) == 'Teacher' ? "selected" : "" }}>Teacher</option>
                                <option value="Lawyer" {{ old('occupation', $member->occupation) == 'Lawyer' ? "selected" : ""}}>Lawyer</option>
                                <option value="Banker" {{old('occupation', $member->occupation) == 'Banker' ? "selected" : ""}}>Banker</option>
                                <option value="Businessman" {{ old('occupation', $member->occupation) == 'Businessman' ? "selected" : "" }}>Businessman</option>
                                <option value="Farmer" {{ old('occupation', $member->occupation) == 'Farmer' ? "selected" : "" }}>Farmer</option>
                                <option value="Nurse" {{old('occupation', $member->occupation) == 'Nurse' ? "selected" : "" }}>Nurse</option>
                                <option value="Architect" {{old('occupation', $member->occupation) == 'Architect' ? "selected" : "" }}>Architect</option>
                                <option value="Other" {{ old('occupation', $member->occupation) == 'Other' ? "selected" : "" }}>Other</option>
                            </select>
                            <i data-lucide="chevron-down" width="16" height="16" class="ep-select-icon"></i>
                        </div>
                    </div>

                    <div class="ep-field-group">
                        <label class="ep-label" for="job_location">Job Location</label>
                        <input class="ep-input" type="text" id="job_location" name="job_location" placeholder="e.g. Shimla" value="{{old('job_location', $member->job_location)}}" />
                    </div>

                    <div class="ep-field-group">
                        <label class="ep-label" for="organization_name">Organization Name</label>
                        <input class="ep-input" type="text" id="organization_name" name="organization_name" placeholder="e.g. HP Government" value="{{old('organization_name', $member->organization_name)}}" />
                    </div>

                    <div class="ep-field-group">
                        <label class="ep-label" for="annual_income">Annual Income</label>
                        <div class="ep-select-wrapper">
                            <select class="ep-select" id="annual_income" name="annual_income">
                                <option value="">Select</option>
                                <option value="Below 1 LPA" {{ old('annual_income', $member->annual_income ) == 'Below 1 LPA' ? "selected" : ""  }}>Below 1 LPA</option>
                                <option value="1–2 LPA" {{ old('annual_income', $member->annual_income ) == '1–2 LPA' ? "selected" : ""  }}>1–2 LPA</option>
                                <option value="2–3 LPA" {{ old('annual_income', $member->annual_income ) == '2–3 LPA' ? "selected" : ""  }}>2–3 LPA</option>
                                <option value="3–5 LPA" {{ old('annual_income', $member->annual_income ) == '3–5 LPA' ? "selected" : ""  }}>3–5 LPA</option>
                                <option value="5–7 LPA" {{ old('annual_income', $member->annual_income ) == '5–7 LPA' ? "selected" : ""  }}>5–7 LPA</option>
                                <option value="7–10 LPA" {{ old('annual_income', $member->annual_income ) == '7–10 LPA' ? "selected" : ""  }}>7–10 LPA</option>
                                <option value="10–15 LPA" {{ old('annual_income', $member->annual_income ) == '10–15 LPA' ? "selected" : ""  }}>10–15 LPA</option>
                                <option value="15–20 LPA" {{ old('annual_income', $member->annual_income ) == '15–20 LPA' ? "selected" : ""  }}>15–20 LPA</option>
                                <option value="20–30 LPA" {{ old('annual_income', $member->annual_income ) == '20–30 LPA' ? "selected" : ""  }}>20–30 LPA</option>
                                <option value="30–50 LPA" {{ old('annual_income', $member->annual_income ) == '30–50 LPA' ? "selected" : ""  }}>30–50 LPA</option>
                                <option value="50 LPA+" {{ old('annual_income', $member->annual_income ) == '50 LPA+' ? "selected" : ""  }}>50 LPA+</option>
                            </select>
                            <i data-lucide="chevron-down" width="16" height="16" class="ep-select-icon"></i>
                        </div>
                    </div>

                    <div class="ep-form-footer">
                        <button type="submit" class="ep-save-btn">
                            <i data-lucide="save" width="16" height="16"></i> Save Education Info
                        </button>
                    </div>
                </form>
            </section>
            <!-- ===== TAB 3: FAMILY ===== -->
            <section class="ep-tab-panel" id="tab-family" role="tabpanel" hidden>
                <div class="ep-section-header">
                    <h2 class="ep-section-title"><i data-lucide="users" width="20" height="20"></i> Family Details</h2>
                </div>

                <form class="ep-form" id="form-family" data-section="family" novalidate>
                    <div class="ep-field-group ep-full-width">
                        <label class="ep-label" for="about_family">About My Family</label>
                        <textarea class="ep-textarea" id="about_family" name="about_my_family" rows="3" placeholder="Brief about your family background...">{{old('about_family', $member->about_family)}}</textarea>
                    </div>
                    <div class="ep-field-group">
                        <label class="ep-label" for="family_status">Family Status</label>
                        <div class="ep-select-wrapper">
                            <select class="ep-select" id="family_status" name="family_status">
                                <option value="">Select</option>
                                <option value="Middle Class" {{ old('family_status', $member->family_status) == 'Middle Class' ? "selected" : "" }}>Middle Class</option>
                                <option value="Upper Middle Class" {{ old('family_status', $member->family_status) == 'Upper Middle Class' ? "selected" : "" }}>Upper Middle Class</option>
                                <option value="Rich / Affluent" {{ old('family_status', $member->family_status) == 'Rich / Affluent' ? "selected" : "" }}>Rich / Affluent</option>
                                <option value="High Class" {{ old('family_status', $member->family_status) == 'High Class' ? "selected" : ""}}>High Class</option>
                            </select>
                            <i data-lucide="chevron-down" width="16" height="16" class="ep-select-icon"></i>
                        </div>
                    </div>

                    <div class="ep-field-group">
                        <label class="ep-label" for="native_place">Native Place</label>
                        <input class="ep-input" type="text" id="native_place" name="native_place" placeholder="e.g. Mandi, Himachal Pradesh" value="{{old('native_place', $member->native_place)}}" />
                    </div>

                    <div class="ep-field-group">
                        <label class="ep-label" for="father_name">Father's Name</label>
                        <input class="ep-input" type="text" id="father_name" name="father_name" placeholder="Father's full name" value="{{old('father_name', $member->father_name)}}" />
                    </div>

                    <div class="ep-field-group">
                        <label class="ep-label" for="father_occupation">Father's Occupation</label>
                        <input class="ep-input" type="text" id="father_occupation" name="father_occupation" placeholder="e.g. Retired Govt. Officer" value="{{old('father_occupation', $member->father_occupation)}}" />
                    </div>

                    <div class="ep-field-group">
                        <label class="ep-label" for="mother_name">Mother's Name</label>
                        <input class="ep-input" type="text" id="mother_name" name="mother_name" placeholder="Mother's full name" value="{{old('mother_name', $member->mother_name)}}" />
                    </div>

                    <div class="ep-field-group">
                        <label class="ep-label" for="mother_occupation">Mother's Occupation</label>
                        <input class="ep-input" type="text" id="mother_occupation" name="mother_occupation" placeholder="e.g. Homemaker" value="{{old('mother_occupation', $member->mother_occupation)}}" />
                    </div>

                    <!-- Sibling row -->
                    <div class="ep-field-group">
                        <label class="ep-label" for="no_of_brothers">Brothers</label>
                        <div class="ep-select-wrapper">
                            <select class="ep-select" id="no_of_brothers" name="no_of_brothers">
                                <option value="">Select</option>
                                <option value="0" {{ old('no_of_brothers', $member->no_of_brothers) == '0' ? 'selected' : '' }}>0</option>
                                <option value="1" {{ old('no_of_brothers', $member->no_of_brothers) == '1' ? 'selected' : '' }}>1</option>
                                <option value="2" {{ old('no_of_brothers', $member->no_of_brothers) == '2' ? 'selected' : '' }}>2</option>
                                <option value="3" {{ old('no_of_brothers', $member->no_of_brothers) == '3' ? 'selected' : '' }}>3</option>
                                <option value="4" {{ old('no_of_brothers', $member->no_of_brothers) == '4' ? 'selected' : '' }}>4</option>
                                <option value="5+" {{ old('no_of_brothers', $member->no_of_brothers) == '5+' ? 'selected' : '' }}>5+</option>
                            </select>
                            <i data-lucide="chevron-down" width="16" height="16" class="ep-select-icon"></i>
                        </div>
                    </div>

                    <div class="ep-field-group">
                        <label class="ep-label" for="married_brothers">Married Brothers</label>
                        <div class="ep-select-wrapper">
                            <select class="ep-select" id="married_brothers" name="married_brothers">
                                <option value="">Select</option>
                                <option value="0" {{ old('married_brothers', $member->married_brothers) == '0' ? 'selected' : '' }}>0</option>
                                <option value="1" {{ old('married_brothers', $member->married_brothers) == '1' ? 'selected' : '' }}>1</option>
                                <option value="2" {{ old('married_brothers', $member->married_brothers) == '2' ? 'selected' : '' }}>2</option>
                                <option value="3" {{ old('married_brothers', $member->married_brothers) == '3' ? 'selected' : '' }}>3</option>
                                <option value="4" {{ old('married_brothers', $member->married_brothers) == '4' ? 'selected' : '' }}>4</option>
                                <option value="5+" {{ old('married_brothers', $member->married_brothers) == '5+' ? 'selected' : '' }}>5+</option>
                            </select>
                            <i data-lucide="chevron-down" width="16" height="16" class="ep-select-icon"></i>
                        </div>
                    </div>

                    <div class="ep-field-group">
                        <label class="ep-label" for="no_of_sisters">Sisters</label>
                        <div class="ep-select-wrapper">
                            <select class="ep-select" id="no_of_sisters" name="no_of_sisters">
                                <option value="">Select</option>
                                <option value="0" {{ old('no_of_sisters', $member->no_of_sisters) == '0' ? 'selected' : '' }}>0</option>
                                <option value="1" {{ old('no_of_sisters', $member->no_of_sisters) == '1' ? 'selected' : '' }}>1</option>
                                <option value="2" {{ old('no_of_sisters', $member->no_of_sisters) == '2' ? 'selected' : '' }}>2</option>
                                <option value="3" {{ old('no_of_sisters', $member->no_of_sisters) == '3' ? 'selected' : '' }}>3</option>
                                <option value="4" {{ old('no_of_sisters', $member->no_of_sisters) == '4' ? 'selected' : '' }}>4</option>
                                <option value="5+" {{ old('no_of_sisters', $member->no_of_sisters) == '5+' ? 'selected' : '' }}>5+</option>
                            </select>
                            <i data-lucide="chevron-down" width="16" height="16" class="ep-select-icon"></i>
                        </div>
                    </div>

                    <div class="ep-field-group">
                        <label class="ep-label" for="married_sisters">Married Sisters</label>
                        <div class="ep-select-wrapper">
                            <select class="ep-select" id="married_sisters" name="married_sisters">
                                <option value="">Select</option>
                                <option value="0" {{ old('married_sisters', $member->married_sisters) == '0' ? 'selected' : '' }}>0</option>
                                <option value="1" {{ old('married_sisters', $member->married_sisters) == '1' ? 'selected' : '' }}>1</option>
                                <option value="2" {{ old('married_sisters', $member->married_sisters) == '2' ? 'selected' : '' }}>2</option>
                                <option value="3" {{ old('married_sisters', $member->married_sisters) == '3' ? 'selected' : '' }}>3</option>
                                <option value="4" {{ old('married_sisters', $member->married_sisters) == '4' ? 'selected' : '' }}>4</option>
                                <option value="5+" {{ old('married_sisters', $member->married_sisters) == '5+' ? 'selected' : '' }}>5+</option>
                            </select>
                            <i data-lucide="chevron-down" width="16" height="16" class="ep-select-icon"></i>
                        </div>
                    </div>

                    <div class="ep-form-footer">
                        <button type="submit" class="ep-save-btn">
                            <i data-lucide="save" width="16" height="16"></i> Save Family Info
                        </button>
                    </div>
                </form>
            </section>

            <!-- ===== TAB 4: LIFESTYLE ===== -->
            <section class="ep-tab-panel" id="tab-lifestyle" role="tabpanel" hidden>
                <div class="ep-section-header">
                    <h2 class="ep-section-title"><i data-lucide="heart-pulse" width="20" height="20"></i> Lifestyle</h2>
                </div>

                <form class="ep-form" id="form-lifestyle" data-section="lifestyle" novalidate>
                    <div class="ep-field-group">
                        <label class="ep-label" for="diet">Diet</label>
                        <div class="ep-select-wrapper">
                            <select class="ep-select" id="diet" name="diet">
                                <option value="">Select</option>
                                <option value="Ved" {{ old('diet', $member->diet) == 'Veg' ? 'selected' : '' }}>Veg</option>
                                <option value="Veg & Non-Veg" {{ old('diet', $member->diet) == 'Veg & Non-Veg' ? 'selected' : '' }}>Veg & Non-Veg</option>
                            </select>
                            <i data-lucide="chevron-down" width="16" height="16" class="ep-select-icon"></i>
                        </div>
                    </div>

                    <div class="ep-field-group">
                        <label class="ep-label" for="is_smoking">Smoking</label>
                        <div class="ep-select-wrapper">
                            <select class="ep-select" id="is_smoking" name="is_smoking">
                                <option value="">Select</option>
                                <option value="Yes" {{ old('is_smoking', $member->is_smoking) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                <option value="No" {{ old('is_smoking', $member->is_smoking) == 'No' ? 'selected' : '' }}>No</option>
                            </select>
                            <i data-lucide="chevron-down" width="16" height="16" class="ep-select-icon"></i>
                        </div>
                    </div>

                    <div class="ep-field-group">
                        <label class="ep-label" for="is_drinking">Drinking</label>
                        <div class="ep-select-wrapper">
                            <select class="ep-select" id="is_drinking" name="is_drinking">
                                <option value="">Select</option>
                                <option value="Yes" {{ old('is_drinking', $member->is_drinking) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                <option value="No" {{ old('is_drinking', $member->is_drinking) == 'No' ? 'selected' : '' }}>No</option>
                            </select>
                            <i data-lucide="chevron-down" width="16" height="16" class="ep-select-icon"></i>
                        </div>
                    </div>

                    <div class="ep-field-group">
                        <label class="ep-label" for="any_disability">Any Disability</label>
                        <div class="ep-select-wrapper">
                            <select class="ep-select" id="any_disability" name="any_disability">
                                <option value="">Select</option>
                                <option value="Yes" {{ old('any_disability', $member->any_disability) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                <option value="No" {{ old('any_disability', $member->any_disability) == 'No' ? 'selected' : '' }}>No</option>
                            </select>
                            <i data-lucide="chevron-down" width="16" height="16" class="ep-select-icon"></i>
                        </div>
                    </div>

                    <!-- Conditional field — shown when disability = Yes -->
                    <div class="ep-field-group ep-full-width" id="disability-detail-wrap" hidden>
                        <label class="ep-label" for="disability_detail">Please describe the disability</label>
                        <input class="ep-input" type="text" id="disability_detail" name="disability_detail" placeholder="Brief description..." value="{{old('disability_detail', $member->disability_detail)}}" />
                    </div>

                    <div class="ep-form-footer">
                        <button type="submit" class="ep-save-btn">
                            <i data-lucide="save" width="16" height="16"></i> Save Lifestyle Info
                        </button>
                    </div>
                </form>
            </section>

            <!-- ===== TAB 5: RELIGION ===== -->
            <section class="ep-tab-panel" id="tab-religion" role="tabpanel" hidden>
                <div class="ep-section-header">
                    <h2 class="ep-section-title"><i data-lucide="flame" width="20" height="20"></i> Religion Info</h2>
                </div>

                <!-- Read-only community card -->
                <div class="ep-info-card">
                    <div class="ep-info-row">
                        <span class="ep-info-label">Community / Caste</span>
                        <span class="ep-info-value">{{$member->cast}}</span>
                    </div>
                    <a href="#" class="ep-info-link"><i data-lucide="external-link" width="14" height="14"></i> To edit community, click here</a>
                </div>

                <form class="ep-form" id="form-religion" data-section="religion" novalidate>
                    <div class="ep-field-group">
                        <label class="ep-label" for="gotra">Gotra <span class="ep-required">*</span></label>
                        <input class="ep-input" type="text" id="gotra" name="gotra" value="{{old('gotra', $member->gotra)}}" placeholder="e.g. Kashyap" required />
                    </div>

                    <div class="ep-field-group">
                        <label class="ep-label" for="sub_cast">Sub Community</label>
                        <input class="ep-input" type="text" id="sub_cast" name="sub_cast" value="{{old('sub_cast', $member->sub_cast)}}" placeholder="e.g. Kanyakubja" />
                    </div>

                    <div class="ep-form-footer">
                        <button type="submit" class="ep-save-btn">
                            <i data-lucide="save" width="16" height="16"></i> Save Religion Info
                        </button>
                    </div>
                </form>
            </section>

            <!-- ===== TAB 6: PARTNER PREFERENCES ===== -->
            <section class="ep-tab-panel" id="tab-preferences" role="tabpanel" hidden>
                <div class="ep-section-header">
                    <h2 class="ep-section-title"><i data-lucide="sliders-horizontal" width="20" height="20"></i> Partner Preferences</h2>
                </div>

                <form class="ep-form" id="form-preferences" data-section="preferences" novalidate>

                    <!-- Age Range -->
                    <div class="ep-field-group ep-full-width">
                        <label class="ep-label">
                            Age Range:
                            <strong id="age-range-label">
                                {{ $member->partner_age_from ?? 18 }}
                                –
                                {{ $member->partner_age_to ?? 35 }}
                            </strong>
                            years
                        </label>

                        <div class="ep-range-row">
                            <input
                                type="range"
                                class="ep-range"
                                id="age_from"
                                name="partner_age_from"
                                min="18"
                                max="70"
                                value="{{ $member->partner_age_from ?? 18 }}"
                                step="1">

                            <input
                                type="range"
                                class="ep-range"
                                id="age_to"
                                name="partner_age_to"
                                min="18"
                                max="70"
                                value="{{ $member->partner_age_to ?? 35 }}"
                                step="1">
                        </div>
                    </div>


                    <!-- Height Range -->
                    <div class="ep-field-group ep-full-width">
                        <label class="ep-label">
                            Height Range:
                            <strong id="height-range-label">
                                {{ $member->partner_height_from ?? 1 }}
                                –
                                {{ $member->partner_height_to ?? 14 }}
                            </strong>
                        </label>

                        <div class="ep-range-row">
                            <input
                                type="range"
                                class="ep-range"
                                id="height_from"
                                name="partner_height_from"
                                min="1"
                                max="28"
                                value="{{ $member->partner_height_from ?? 1 }}"
                                step="1">

                            <input
                                type="range"
                                class="ep-range"
                                id="height_to"
                                name="partner_height_to"
                                min="1"
                                max="28"
                                value="{{ $member->partner_height_to ?? 14 }}"
                                step="1">
                        </div>
                    </div>


                    <!-- Income Range -->
                    <div class="ep-field-group ep-full-width">
                        <label class="ep-label">
                            Annual Income Range:
                            <strong id="income-range-label">
                                {{ $member->partner_annual_income_from ?? 0 }}
                                –
                                {{ $member->partner_annual_income_to ?? 10 }}
                                LPA
                            </strong>
                        </label>

                        <div class="ep-range-row">
                            <input
                                type="range"
                                class="ep-range"
                                id="income_from"
                                name="partner_annual_income_from"
                                min="0"
                                max="50"
                                value="{{ $member->partner_annual_income_from ?? 0 }}"
                                step="1">

                            <input
                                type="range"
                                class="ep-range"
                                id="income_to"
                                name="partner_annual_income_to"
                                min="0"
                                max="50"
                                value="{{ $member->partner_annual_income_to ?? 10 }}"
                                step="1">
                        </div>
                    </div>


                    <!-- About Partner -->
                    <div class="ep-field-group ep-full-width">
                        <label class="ep-label" for="about_my_partner">
                            About My Partner
                        </label>

                        <textarea
                            class="ep-textarea"
                            id="about_my_partner"
                            name="about_my_partner"
                            rows="3"
                            placeholder="What are you looking for in a partner...">{{ old('about_my_partner', $member->about_my_partner) }}</textarea>
                    </div>
                    @php
                    $looking = $member->looking_for ?? '';
                    $looking = $looking !== '' ? array_map('trim', explode(',', $looking)) : [];
                    $ms = ["Never Married","Divorced","Widowed","Awating Divorce"];
                    @endphp
                    <!-- Partner Marital status -->
                    <div class="ep-field-group">
                        <label class="ep-label" for="looking_for">Partner Marital Status</label>
                        <div class="ep-multiselect-trigger" data-target="looking_for" tabindex="0" role="button" aria-haspopup="true">
                            <span class="ep-multiselect-value" id="looking_for-display">Any</span>
                            <i data-lucide="chevron-down" width="16" height="16"></i>
                        </div>
                        <input type="hidden" id="looking_for" name="looking_for" value="Any" />
                        <div class="ep-multiselect-dropdown" id="looking_for-dropdown" hidden>
                            @foreach($ms as $m)
                            <label><input type="checkbox" name="looking_for[]" value="{{$m}}" {{in_array($m, $looking) ? "checked" : "" }} />{{$m}}</label>
                            @endforeach
                        </div>
                    </div>
                    @php
                    $religion = $member->partner_religion ?? '';
                    $religion = $religion !== '' ? array_map('trim', explode(',', $religion)) : [];
                    $rl = ["Hindu", "Muslim","Christian","Sikh","Buddhist","Jain"];
                    @endphp
                    <div class="ep-field-group">
                        <label class="ep-label" for="partner_religion">Religion</label>
                        <div class="ep-multiselect-trigger" data-target="partner_religion" tabindex="0" role="button">
                            <span class="ep-multiselect-value" id="partner_religion-display">{{count($religion) ? implode(',', $religion) : 'Any'}}</span>
                            <i data-lucide="chevron-down" width="16" height="16"></i>
                        </div>
                        <input type="hidden" id="partner_religion" name="partner_religion" value="Any" />
                        <div class="ep-multiselect-dropdown" id="partner_religion-dropdown" hidden>
                            @foreach($rl as $r)
                            <label><input type="checkbox" name="partner_religion[]" value="{{$r}}" {{in_array($r, $religion) ?  "checked" : "" }} />{{$r}}</label>
                            @endforeach
                        </div>
                    </div>
                    @php
                    $mother_tounge = $member->partner_mothertongue ?? '';
                    $mother_tounge = $mother_tounge !== '' ? array_map('trim', explode(',',$mother_tounge)) : [];
                    $pmt = ["Hindi", "Pahari", "Punjabi","Dogri","Kinnauri"];
                    @endphp
                    <div class="ep-field-group">
                        <label class="ep-label" for="partner_mothertongue">Mother Tongue</label>
                        <div class="ep-multiselect-trigger" data-target="partner_mothertongue" tabindex="0" role="button">
                            <span class="ep-multiselect-value" id="partner_mothertongue-display">{{count($mother_tounge) ? implode(',', $mother_tounge) : 'Any'}}</span>
                            <i data-lucide="chevron-down" width="16" height="16"></i>
                        </div>
                        <input type="hidden" id="partner_mothertongue" name="partner_mothertongue" value="Any" />
                        <div class="ep-multiselect-dropdown" id="partner_mothertongue-dropdown" hidden>
                            @foreach($pmt as $mt)
                            <label><input type="checkbox" name="partner_mothertongue[]" value="{{$mt}}" {{in_array($mt, $mother_tounge) ? "checked" : "" }} />{{$mt}}</label>
                            @endforeach
                        </div>
                    </div>
                    @php
                    $cast = $member->partner_cast ?? '';
                    $cast = $cast !== '' ? array_map('trim', explode(',',$cast)) : [];
                    $cst = ["Brahmin", "Rajput", "SC/ST", "Other"];
                    @endphp
                    <div class="ep-field-group">
                        <label class="ep-label" for="partner_cast">Caste</label>
                        <div class="ep-multiselect-trigger" data-target="partner_cast" tabindex="0" role="button">
                            <span class="ep-multiselect-value" id="partner_cast-display">{{count($cast) ? implode(',', $cast) : 'Any'}}</span>
                            <i data-lucide="chevron-down" width="16" height="16"></i>
                        </div>
                        <input type="hidden" id="partner_cast" name="partner_cast" value="Any" />
                        <div class="ep-multiselect-dropdown" id="partner_cast-dropdown" hidden>
                            @foreach($cst as $ct)
                            <label><input type="checkbox" name="partner_cast[]" value="{{$ct}}" {{ in_array($ct,$cast) ? "Checked" : "" }} />{{$ct}}</label>
                            @endforeach
                        </div>
                    </div>

                    <div class="ep-field-group">
                        <label class="ep-label" for="is_partner_manglik">Partner Manglik</label>
                        <div class="ep-select-wrapper">
                            <select class="ep-select" id="is_partner_manglik" name="is_partner_manglik">
                                <option value="Any" {{ old('is_partner_manglik', $member->is_partner_manglik) == 'Any' ? 'selected' : '' }}>Any</option>
                                <option value="Yes" {{ old('is_partner_manglik', $member->is_partner_manglik) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                <option value="No" {{ old('is_partner_manglik', $member->is_partner_manglik) == 'No' ? 'selected' : '' }}>No</option>
                            </select>
                            <i data-lucide="chevron-down" width="16" height="16" class="ep-select-icon"></i>
                        </div>
                    </div>
                    @php
                    $partner_edu = $member->partner_education ?? '';
                    $partner_edu = $partner_edu !=='' ? array_map('trim', explode(',',$partner_edu)) : [];
                    $ptedu = ["10th","12th","Graduate","Post Graduate","Doctrate"];
                    @endphp
                    <div class="ep-field-group">
                        <label class="ep-label" for="partner_education">Highest Qualification</label>
                        <div class="ep-multiselect-trigger" data-target="partner_education" tabindex="0" role="button">
                            <span class="ep-multiselect-value" id="partner_education-display">{{count($partner_edu) ? implode(',', $partner_edu) : 'Any'}}</span>
                            <i data-lucide="chevron-down" width="16" height="16"></i>
                        </div>
                        <input type="hidden" id="partner_education" name="partner_education" value="Any" />
                        <div class="ep-multiselect-dropdown" id="partner_education-dropdown" hidden>
                            @foreach($ptedu as $edu)
                            <label><input type="checkbox" name="partner_education[]" value="{{$edu}}" {{in_array($edu, $partner_edu) ? "checked" : "" }}>{{$edu}}</label>
                            @endforeach
                        </div>
                    </div>
                    @php
                    $partner_occ = $member->partner_occupation ?? '';
                    $partner_occ = $partner_edu !=='' ? array_map('trim', explode(',',$partner_occ)) : [];
                    $ptocc = ["Government","Private","Bussiness/Self Employed","Defence","Not Working"];
                    @endphp
                    <div class="ep-field-group">
                        <label class="ep-label" for="partner_occupation">Employed In</label>
                        <div class="ep-multiselect-trigger" data-target="partner_occupation" tabindex="0" role="button">
                            <span class="ep-multiselect-value" id="partner_occupation-display">{{count($partner_occ) ? implode(',', $partner_occ) : 'Any'}}</span>
                            <i data-lucide="chevron-down" width="16" height="16"></i>
                        </div>
                        <input type="hidden" id="partner_occupation" name="partner_occupation" value="Any" />
                        <div class="ep-multiselect-dropdown" id="partner_occupation-dropdown" hidden>
                            @foreach($ptocc as $oc)
                            <label><input type="checkbox" name="partner_occupation[]" value="{{$oc}}" {{in_array($oc, $partner_occ) ? "checked" : "" }} />{{$oc}}</label>
                            @endforeach
                        </div>
                    </div>

                    <div class="ep-field-group">
                        <label class="ep-label" for="partner_diet">Diet</label>
                        <div class="ep-select-wrapper">
                            <select class="ep-select" id="partner_diet" name="partner_diet">
                                <option value="Any" {{old('partner_diet', $member->partner_diet) == 'Any' ? 'selected' : ''}}>Any</option>
                                <option value="Veg" {{old('partner_diet', $member->partner_diet) == 'Veg' ? 'selected' : ''}}>Veg</option>
                                <option value="Veg & Non-Veg" {{old('partner_diet', $member->partner_diet) == 'Veg & Non-Veg' ? 'selected' : ''}}>Veg & Non-Veg</option>
                            </select>
                            <i data-lucide="chevron-down" width="16" height="16" class="ep-select-icon"></i>
                        </div>
                    </div>

                    <div class="ep-field-group">
                        <label class="ep-label" for="is_partner_smoking">Partner Smoking</label>
                        <div class="ep-select-wrapper">
                            <select class="ep-select" id="is_partner_smoking" name="is_partner_smoking">
                                <option value="Any" {{old('is_partner_smoking', $member->is_partner_smoking) == 'Any' ? 'selected' : ''}}>Any</option>
                                <option value="Yes" {{old('is_partner_smoking', $member->is_partner_smoking) == 'Yes' ? 'selected' : ''}}>Yes</option>
                                <option value="No" {{old('is_partner_smoking', $member->is_partner_smoking) == 'No' ? 'selected' : ''}}>No</option>
                            </select>
                            <i data-lucide="chevron-down" width="16" height="16" class="ep-select-icon"></i>
                        </div>
                    </div>

                    <div class="ep-field-group">
                        <label class="ep-label" for="is_partner_drinking">Partner Drinking</label>
                        <div class="ep-select-wrapper">
                            <select class="ep-select" id="is_partner_drinking" name="is_partner_drinking">
                                <option value="Any" {{old('is_partner_drinking', $member->is_partner_drinking) == 'Any' ? 'selected' : ''}}>Any</option>
                                <option value="Yes" {{old('is_partner_drinking', $member->is_partner_drinking) == 'Yes' ? 'selected' : ''}}>Yes</option>
                                <option value="No" {{old('is_partner_drinking', $member->is_partner_drinking) == 'No' ? 'selected' : ''}}>No</option>
                            </select>
                            <i data-lucide="chevron-down" width="16" height="16" class="ep-select-icon"></i>
                        </div>
                    </div>

                    <div class="ep-form-footer">
                        <button type="submit" class="ep-save-btn">
                            <i data-lucide="save" width="16" height="16"></i> Save Preferences
                        </button>
                    </div>
                </form>
            </section>

            <!-- ===== TAB 7: CONTACT ===== -->
            <section class="ep-tab-panel" id="tab-contact" role="tabpanel" hidden>
                <div class="ep-section-header">
                    <h2 class="ep-section-title"><i data-lucide="phone" width="20" height="20"></i> Contact Info</h2>
                </div>

                <form class="ep-form" id="form-contact" data-section="contact" novalidate>
                    <div class="ep-field-group">
                        <label class="ep-label" for="mobile_number">Phone Number <span class="ep-required">*</span></label>
                        <input class="ep-input" type="tel" id="mobile_number" name="mobile_number" placeholder="+91 98XXXXXXXX" maxlength="13" required value="{{old('mobile_number', $member->mobile_number)}}" />
                    </div>

                    <div class="ep-field-group">
                        <label class="ep-label" for="alternate_number">Alternate Phone Number</label>
                        <input class="ep-input" type="tel" id="alternate_number" name="alternate_number" placeholder="+91 98XXXXXXXX" maxlength="13" value="{{old('alternate_number', $member->alternate_number)}}" />
                    </div>

                    <div class="ep-field-group">
                        <label class="ep-label" for="whatsapp_number">WhatsApp Number</label>
                        <input class="ep-input" type="tel" id="whatsapp_number" name="whatsapp_number" placeholder="+91 98XXXXXXXX" maxlength="13" value="{{old('whatsapp_number', $member->whatsapp_number)}}" />
                    </div>

                    <div class="ep-field-group">
                        <label class="ep-label" for="email">Email ID <span class="ep-required">*</span></label>
                        <input class="ep-input" type="email" id="email" name="email" placeholder="you@example.com" required value="{{old('email', $member->email)}}" />
                    </div>

                    <div class="ep-form-footer">
                        <button type="submit" class="ep-save-btn">
                            <i data-lucide="save" width="16" height="16"></i> Save Contact Info
                        </button>
                    </div>
                </form>
            </section>

        </div><!-- /ep-tab-content -->
    </div><!-- /ep-layout -->
</main>
@endsection
<!-- ===== SUCCESS TOAST ===== -->
<div class="ep-toast" id="epSuccessToast" role="status" aria-live="polite">
    <i data-lucide="check-circle-2" width="18" height="18"></i>
    <span id="epToastMsg"></span>
</div>

@section('scripts')
<script src="{{ asset('assets/js/edit-profile.js') }}"></script>
@endsection