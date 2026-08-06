@extends('layouts.app')
@section('title', 'Terms & Conditions - Himrishtey')
@section('content')
<main class="pp-main" id="main-content">
  <section class="pp-hero" aria-labelledby="ppTitle">
    <p class="pp-kicker"> Terms & Conditions</p>
    <h1 class="pp-title" id="ppTitle">Overview</h1>
    <p class="pp-intro">
      Here's a hearty welcome big and warm enough to encompass you all your presence makes us happy and It's our pleasure extend a cheerful welcome to you all at Himrishtey.com. It is a site Make a perfect match and Bond of togetherness among to beautiful person. This is an agreement purely legal binding terms terms for your membership. This agreement can be modified from time to time and it may be affected by simple notice to members. All records are maintained by computer system And need not any physical or digital signature. Any e suggestions regarding the improvement of the site is always welcome.
    </p>
  </section>
  <article class="pp-card" aria-label="Privacy policy content">
    <div class="pp-content">
      <p>
        Conditions and Terms
      </p>
      {!! $data !!}
    </div>
  </article>
</main>
@endsection