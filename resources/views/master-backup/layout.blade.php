<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>HimRishtey – Himachal's Most Trusted Matrimony</title>
  <meta name="description" content="Him Rishtey is Himachal Pradesh's most trusted matrimonial service. Connect with Himachali brides and grooms across all castes and communities." />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Lucide -->
  <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>

  <link rel="stylesheet" href="{{ asset('assets/css/landing.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/privacy-policies.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/success-stories.css') }}" />
</head>
<body>

<!-- <a href="#main-content" class="skip-link">Skip to content</a> -->

<header class="site-header" id="site-header">
  <nav class="navbar-inner container-xl">
    <a href="/" class="brand-logo" aria-label="HimRishtey Home">
       <img src="{{ asset('assets/images/logo.png') }}" alt="Himrishtey Logo" class="navbar-logo">
    </a>

    <ul class="nav-links" role="list">
      <li><a href="#how-it-works">How It Works</a></li>
      <li><a href="#features">Features</a></li>
      <li><a href="#communities">Communities</a></li>
      <li><a href="{{route('success-stories')}}">Success Stories</a></li>
      <li><a href="#contact">Contact</a></li>
    </ul>

    <div class="nav-actions">
      <!-- <button class="btn-theme-toggle" data-theme-toggle aria-label="Switch to dark mode">
        <i data-lucide="moon" width="18" height="18"></i>
      </button> -->
      <button class="theme-toggle-btn" data-theme-toggle aria-label="Switch to dark mode">
          <i data-lucide="moon" width="18" height="18"></i>
        </button>

      <a href="{{ route('login') }}" class="btn-nav-login">Login</a>
      <a href="{{ route('login') }}#register" class="btn-nav-cta">Register Free</a>

      <button class="hamburger" id="hamburgerBtn" aria-label="Open menu" aria-expanded="false">
        <i data-lucide="menu" width="22" height="22"></i>
      </button>
    </div>
  </nav>
</header>

<div class="mobile-drawer" id="mobileDrawer" aria-hidden="true">
  <div class="drawer-header">
    <span class="brand-name">Him<span class="brand-accent">Rishtey</span></span>
    <button class="drawer-close" id="drawerClose" aria-label="Close menu">
      <i data-lucide="x" width="22" height="22"></i>
    </button>
  </div>

  <ul class="drawer-links" role="list">
    <li><a href="#how-it-works">How It Works</a></li>
    <li><a href="#features">Features</a></li>
    <li><a href="#communities">Communities</a></li>
    <li><a href="{{route('success-stories')}}">Success Stories</a></li>
    <li><a href="#contact">Contact</a></li>
  </ul>

  <div class="drawer-footer">
    <a href="{{ route('login') }}" class="btn-drawer-login">Login</a>
    <a href="{{ route('login')}}#register" class="btn-drawer-cta">Register Free</a>
  </div>
</div>

<div class="drawer-overlay" id="drawerOverlay"></div>

<main id="main-content">
  @yield('content')
</main>

<footer class="site-footer">
  <div class="container-xl footer-grid">
          <div class="footer-brand">
            <a href="landing.html" class="brand-logo" aria-label="HimRishtey Home">
              <img src="{{ asset('assets/images/logo.png') }}" alt="Himrishtey Logo" class="navbar-logo">
            </a>
            <p>
              One of the most trusted matrimonial services for Himachali families, connecting hearts across Himachal Pradesh and beyond.
            </p>
            <div class="footer-social">
          <a href="https://www.facebook.com/himrishtey" aria-label="Facebook" target="_blank" rel="noopener noreferrer">
              <i class="fa-brands fa-facebook-f"></i>
          </a>
          <a href="https://x.com/himrishte" aria-label="Twitter" target="_blank" rel="noopener noreferrer">
              <i class="fa-brands fa-twitter"></i>
          </a>

          <a href="https://www.instagram.com/himrishtey/" aria-label="Instagram" target="_blank" rel="noopener noreferrer">
              <i class="fa-brands fa-instagram"></i>
          </a>

          <a href="https://www.youtube.com/channel/UCwIe3GhJL-_c0bQ80eFv6RQ" aria-label="YouTube" target="_blank" rel="noopener noreferrer">
              <i class="fa-brands fa-youtube"></i>
          </a>
      </div>
    </div>

    <div class="footer-col">
      <h4>Pages</h4>
      <ul role="list">
        <li><a href="/">Home</a></li>
        <li><a href="{{route('login')}}">Login</a></li>
        <li><a href="{{route('login')}}#register">Register</a></li>
        <li><a href="index.html">Dashboard</a></li>
      </ul>
    </div>

    <div class="footer-col">
      <h4>Explore</h4>
      <ul role="list">
        <li><a href="#how-it-works">How It Works</a></li>
        <li><a href="#features">Features</a></li>
        <li><a href="#communities">Communities</a></li>
        <li><a href="#testimonials">Success Stories</a></li>
      </ul>
    </div>

    <div class="footer-col">
      <h4>Support</h4>
      <ul role="list">
        <li><a href="#contact">Contact Us</a></li>
        <li><a href="{{route('privacy-policy')}}">Privacy Policy</a></li>
        <li><a href="{{route('terms-and-conditions')}}">Terms & Conditions</a></li>
        <li><a href="#">Help Center</a></li>
      </ul>
    </div>
  </div>

  <div class="footer-bottom">
    <div class="container-xl">
      <p>&copy; {{ date('Y') }} HimRishtey. All rights reserved.</p>
    </div>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('assets/js/landing.js') }}"></script>
<script src="{{asset('assets/js/login.js') }}"></script>
</body>
</html>