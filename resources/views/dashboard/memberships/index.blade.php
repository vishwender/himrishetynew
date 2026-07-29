@extends('layouts.dashboard')
@section('title','Memberships - Him Rishtey')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/memberships.css') }}" />
@endsection

@section('content')
<section class="membership-section container-xxl">
    <div class="section-heading mb-4">
        <h2>Membership Plans</h2>
        <p>Choose the plan that best fits your matrimonial journey.</p>
    </div>

    <div class="membership-list">

        <!-- Free -->
        <div class="membership-card">
            <h3>Free Membership</h3>
            <p>
                Create your profile and explore verified matches at no cost.
                Send limited interests, browse profiles, and experience our
                platform before upgrading to a premium plan.
            </p>

            <ul>
                <li>✔ Create Profile</li>
                <li>✔ Browse Matches</li>
                <li>✔ Limited Interests</li>
                <li>✔ Basic Search Filters</li>
            </ul>

            <a href="#" class="membership-btn">Current Plan</a>
        </div>

        <!-- Normal -->
        <div class="membership-card">
            <h3>Normal Membership</h3>
            <p>
                Ideal for members who prefer searching for matches on their own.
                Unlock more profiles, advanced filters, and unlimited interest
                requests to connect with suitable matches.
            </p>

            <ul>
                <li>✔ Unlimited Interests</li>
                <li>✔ Advanced Filters</li>
                <li>✔ View More Profiles</li>
                <li>✔ Priority Listing</li>
            </ul>

            <a href="#" class="membership-btn">Choose Plan</a>
        </div>

        <!-- Premium -->
        <div class="membership-card featured">
            <span class="membership-badge">Most Popular</span>

            <h3>Premium Membership</h3>

            <p>
                Enjoy a personalized matchmaking experience with direct contact
                access, profile highlighting, and dedicated support to help you
                find your ideal life partner faster.
            </p>

            <ul>
                <li>✔ Everything in Normal</li>
                <li>✔ Contact Details Access</li>
                <li>✔ Highlighted Profile</li>
                <li>✔ Priority Customer Support</li>
                <li>✔ Better Match Visibility</li>
            </ul>

            <a href="#" class="membership-btn">Upgrade Now</a>
        </div>

        <!-- Premium Plus -->
        <div class="membership-card">
            <h3>Premium Plus</h3>

            <p>
                Our most exclusive plan. A dedicated relationship manager will
                personally assist you throughout your matchmaking journey,
                recommending suitable profiles and arranging introductions.
            </p>

            <ul>
                <li>✔ Dedicated Relationship Manager</li>
                <li>✔ Handpicked Matches</li>
                <li>✔ Assisted Matchmaking</li>
                <li>✔ Profile Promotion</li>
                <li>✔ Highest Priority Support</li>
            </ul>

            <a href="#" class="membership-btn">Get Premium Plus</a>
        </div>

    </div>
</section>
@endsection