@extends('layouts.dashboard')

@section('title', 'Terms & Conditions - Himrishtey')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/refund-policy.css') }}">
@endsection

@section('content')

<main class="refund-page">

    <div class="refund-card">

        <div class="page-header">
            <h1>Terms & Conditions</h1>
            <p>
                Please read our Terms and Conditions carefully before purchasing any membership plan.
            </p>
        </div>

        <section class="policy-section">

            {!! $page->terms_and_conditions !!}

        </section>

    </div>

</main>

@endsection