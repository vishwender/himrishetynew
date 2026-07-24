@extends('layouts.dashboard')

@section('title', 'Dashboard - HimRishtey')

@section('content')

<!-- BREADCRUMB / PAGE TITLE -->
<div class="page-header-bar container-xxl">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb-custom">
            <li><i data-lucide="home" width="14" height="14"></i></li>
            <li aria-current="page">Dashboard</li>
        </ol>
    </nav>
    <div class="page-header-actions">
        <a href="#" class="btn-primary-sm">
            <i data-lucide="plus" width="15" height="15"></i> Add Photos
        </a>
        <a href="#" class="btn-outline-sm">
            <i data-lucide="search" width="15" height="15"></i> Search Profiles
        </a>
    </div>
</div>

<!-- VERIFY BANNER (conditional) -->
<div class="verify-banner container-xxl" id="verifyBanner">
    <div class="verify-banner-inner">
        <i data-lucide="shield-alert" width="20" height="20"></i>
        <span>Your profile is not verified. Verify now to get more matches and build trust.</span>
        <a href="#" class="verify-banner-btn">Verify Now</a>
    </div>
    <button class="verify-banner-dismiss" aria-label="Dismiss" onclick="document.getElementById('verifyBanner').remove()">
        <i data-lucide="x" width="16" height="16"></i>
    </button>
</div>

<!-- PROFILE COMPLETION -->
<section class="profile-completion-section container-xxl" aria-label="Profile completion">
    <div class="pc-card">
        <div class="pc-left">
            <div class="pc-avatar-ring" style="--progress: 72%;">
                <img src="https://picsum.photos/seed/bride1/70/70" alt="Priya Sharma" width="70" height="70" loading="lazy" class="pc-avatar" />
                <svg class="pc-ring-svg" viewBox="0 0 80 80" aria-hidden="true">
                    <circle cx="40" cy="40" r="36" fill="none" stroke="var(--color-surface-offset)" stroke-width="4" />
                    <circle cx="40" cy="40" r="36" fill="none" stroke="var(--color-primary)" stroke-width="4" stroke-dasharray="226.2" stroke-dashoffset="63.3" stroke-linecap="round" transform="rotate(-90 40 40)" />
                </svg>
                <span class="pc-percent">72%</span>
            </div>
        </div>
        <div class="pc-right">
            <h3 class="pc-title">Complete Your Profile</h3>
            <p class="pc-desc">A complete profile gets <strong>5x more</strong> matches. Add your details to stand out.</p>
            <div class="pc-progress-bar-wrap">
                <div class="pc-progress-bar" style="width: 72%;" role="progressbar" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div class="pc-steps">
                <span class="pc-step done"><i data-lucide="check" width="12" height="12"></i> Basic Info</span>
                <span class="pc-step done"><i data-lucide="check" width="12" height="12"></i> Photos</span>
                <span class="pc-step pending"><i data-lucide="plus" width="12" height="12"></i> Horoscope</span>
                <span class="pc-step pending"><i data-lucide="plus" width="12" height="12"></i> Family Details</span>
            </div>
        </div>
        <a href="#" class="pc-cta-btn">Complete Now</a>
    </div>
</section>

<!-- STATS BLOCKS -->
<section class="stats-section container-xxl" aria-label="Dashboard statistics">
    <div class="stats-grid">

        <!-- Profile Views -->
        <a href="{{ url('stats-profiles?profile=profile_viewed') }}" class="stat-card pink">
            <div class="stat-card-header">
                <span class="stat-label">Profile Views</span>
                <div class="stat-icon-wrap pink">
                    <i data-lucide="user" width="20" height="20"></i>
                </div>
            </div>

            <span class="stat-number" data-target="{{ $data['iviewed'] }}">
                {{ $data['iviewed'] }}
            </span>

            <span class="stat-trend up">
                <i data-lucide="trending-up" width="12" height="12"></i>
                Viewed your profile
            </span>
        </a>

        <!-- Likes -->
        <a href="{{ url('stats-profiles?profile=likes') }}" class="stat-card blue">
            <div class="stat-card-header">
                <span class="stat-label">Likes</span>
                <div class="stat-icon-wrap blue">
                    <i data-lucide="heart" width="20" height="20"></i>
                </div>
            </div>

            <span class="stat-number" data-target="{{ $data['iLikes'] }}">
                {{ $data['iLikes'] }}
            </span>

            <span class="stat-trend up">
                <i data-lucide="heart" width="12" height="12"></i>
                Profiles you liked
            </span>
        </a>

        <!-- Interests -->
        <a href="{{ url('interest-box') }}" class="stat-card purple">
            <div class="stat-card-header">
                <span class="stat-label">Interests Sent</span>
                <div class="stat-icon-wrap purple">
                    <i data-lucide="user-plus" width="20" height="20"></i>
                </div>
            </div>

            <span class="stat-number" data-target="{{ $data['interestSent'] }}">
                {{ $data['interestSent'] }}
            </span>

            <span class="stat-trend up">
                <i data-lucide="send" width="12" height="12"></i>
                Interests sent
            </span>
        </a>

        <!-- Contacts -->
        <a href="{{ url('stats-profiles?profile=contacts') }}" class="stat-card green">
            <div class="stat-card-header">
                <span class="stat-label">Contacts Viewed</span>
                <div class="stat-icon-wrap green">
                    <i data-lucide="eye" width="20" height="20"></i>
                </div>
            </div>

            <span class="stat-number" data-target="{{ $data['contact'] }}">
                {{ $data['contact'] }}
            </span>

            <span class="stat-trend neutral">
                <i data-lucide="phone" width="12" height="12"></i>
                Contacts viewed
            </span>
        </a>

    </div>
</section>

<!-- PROFILE SECTIONS -->

@include('dashboard.recent.recent-profiles', [
'recents' => $data['recents']
])

@include('dashboard.matching.matching-profiles', [
'matching' => $data['matching_profiles']
])

@include('dashboard.verified.verified-profiles', [
'verifiedProfiles' => $data['verifiedUsers']
])

@include('dashboard.viewed.who-viewed-profiles', [
'viewedMyProfile' => $data['viewed']
])

@include('dashboard.shortlisted.shortlisted-profiles', [
'shortlisted' => $data['shortlist']
])

<!-- UPGRADE BANNER -->
<section class="upgrade-banner-section container-xxl" aria-label="Upgrade membership">
    <div class="upgrade-banner">
        <div class="upgrade-banner-text">
            <h3 class="upgrade-title">Unlock Full Access</h3>
            <p>See who liked you, view contact numbers, and get priority matching with a premium plan.</p>
        </div>
        <div class="upgrade-banner-actions">
            <a href="#" class="btn-upgrade">View Plans</a>
        </div>
    </div>
</section>

@endsection