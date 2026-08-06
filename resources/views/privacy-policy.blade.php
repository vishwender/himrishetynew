@extends('layouts.app')
@section('title', 'Privacy Policy - Himrishtey')
@section('content')
@section('content')
<main class="pp-main" id="main-content">
  <section class="pp-hero" aria-labelledby="ppTitle">
    <p class="pp-kicker">Legal</p>
    <h1 class="pp-title" id="ppTitle">Privacy Policy</h1>
    <p class="pp-intro">
      Your privacy is important to us, and this page explains how HimRishtey collects, uses, and shares information.
    </p>
  </section>

  <article class="pp-card" aria-label="Privacy policy content">
    <div class="pp-content">
      {!! $data !!}
    </div>
  </article>
</main>
@endsection