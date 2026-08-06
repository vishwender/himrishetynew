@extends('layouts.app')
@section('title', 'About Us - Himrishtey')
@section('content')
<main class="pp-main" id="main-content">
    <section class="pp-hero" aria-labelledby="ppTitle">
        <p class="pp-kicker"> About Us</p>
        <!-- <h1 class="pp-title" id="ppTitle">Overview</h1> -->
        <p class="pp-intro">
        </p>
    </section>
    <article class="pp-card" aria-label="Privacy policy content">
        <div class="pp-content">
            <!-- <p>
                About Us
            </p> -->
            {!! $aboutUs !!}
        </div>
    </article>
</main>
@endsection