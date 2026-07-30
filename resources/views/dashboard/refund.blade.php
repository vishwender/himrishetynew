@extends('layouts.dashboard')

@section('title', 'Refund & Cancellation - Himrishtey')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/refund-policy.css') }}">
@endsection

@section('content')

<main class="refund-page">

    <div class="refund-card">

        <div class="page-header">
            <h1>Refund Policy</h1>
            <p>
                Please read our refund policy carefully before purchasing any membership plan.
            </p>
        </div>

        <section class="policy-section">

            {!! $page->refund_policy !!}

        </section>

    </div>

</main>

@endsection