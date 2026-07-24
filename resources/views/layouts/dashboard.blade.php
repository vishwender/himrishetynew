<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title', 'HimRishtey – Find Your Life Partner')</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Lucide Icons -->
  <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js" defer></script>

  <!-- Custom CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
  
  @yield('styles')
</head>
<body>

  <!-- Skip link -->
  <a href="#main-content" class="skip-link">Skip to main content</a>

  <!-- SIDEBAR OVERLAY -->
  <div class="sidebar-overlay" id="sidebarOverlay" aria-hidden="true"></div>

  <!-- SIDEBAR / SIDE DRAWER -->
  <aside class="sidebar" id="sidebar" role="complementary" aria-label="Navigation menu">
    <div class="sidebar-header">
      <div class="sidebar-profile-card" onclick="window.location='#'">
        <div class="sidebar-avatar-wrap">
          <img src="https://picsum.photos/seed/bride1/80/80" alt="{{ Auth::user()->name ?? 'User' }}" width="80" height="80" loading="lazy" class="sidebar-avatar" />
          <span class="sidebar-avatar-badge" aria-hidden="true">
            <i data-lucide="camera" width="12" height="12"></i>
          </span>
        </div>
        <div class="sidebar-user-info">
          <h2 class="sidebar-user-name">{{ Auth::user()->full_name ?? 'User' }}</h2>
          <span class="sidebar-label">Profile ID</span>
          <span class="sidebar-value">{{ Auth::user()->profile_id ?? 'N/A' }}</span>
          <span class="sidebar-label">Membership</span>
          <span class="sidebar-status active">Active</span>
          <span class="sidebar-label">Plan</span>
          <span class="sidebar-plan-name">Gold Member</span>
        </div>
      </div>
      <button class="sidebar-close-btn" id="sidebarClose" aria-label="Close menu">
        <i data-lucide="x" width="20" height="20"></i>
      </button>
    </div>

    <nav class="sidebar-nav" aria-label="Main navigation">
      <span class="sidebar-nav-section-label">Menu</span>
      <ul role="list">
        <li><a href="{{ route('profile') }}" class="sidebar-nav-item @if(Route::currentRouteName() === 'dashboard') active @endif" @if(Route::currentRouteName() === 'dashboard') aria-current="page" @endif><i data-lucide="home" width="18" height="18"></i><span>Home</span></a></li>
        <li><a href="#" class="sidebar-nav-item"><i data-lucide="shield" width="18" height="18"></i><span>Membership</span></a></li>
        <li><a href="#" class="sidebar-nav-item"><i data-lucide="edit-3" width="18" height="18"></i><span>Edit Profile</span></a></li>
        <li><a href="#" class="sidebar-nav-item"><i data-lucide="search" width="18" height="18"></i><span>Quick Search</span></a></li>
        <li><a href="#" class="sidebar-nav-item"><i data-lucide="sliders" width="18" height="18"></i><span>Advanced Search</span></a></li>
        <li><a href="#" class="sidebar-nav-item"><i data-lucide="user-search" width="18" height="18"></i><span>Search by Profile ID</span></a></li>
        <li><a href="#" class="sidebar-nav-item"><i data-lucide="inbox" width="18" height="18"></i><span>Interest Box</span></a></li>
        <li><a href="#" class="sidebar-nav-item"><i data-lucide="eye" width="18" height="18"></i><span>View My Profile</span></a></li>
        <li><a href="#" class="sidebar-nav-item"><i data-lucide="key-round" width="18" height="18"></i><span>Change Password</span></a></li>
        <li><a href="#" class="sidebar-nav-item"><i data-lucide="phone" width="18" height="18"></i><span>Viewed Contact</span></a></li>
        <li><a href="#" class="sidebar-nav-item"><i data-lucide="gift" width="18" height="18"></i><span>Refer &amp; Earn</span></a></li>
        <li><a href="#" class="sidebar-nav-item"><i data-lucide="trophy" width="18" height="18"></i><span>Success Stories</span></a></li>
        <li><a href="#" class="sidebar-nav-item"><i data-lucide="user-x" width="18" height="18"></i><span>Delete Profile</span></a></li>
        <li><a href="#" class="sidebar-nav-item"><i data-lucide="file-text" width="18" height="18"></i><span>Refund &amp; Cancellation</span></a></li>
        <li><a href="#" class="sidebar-nav-item"><i data-lucide="lock" width="18" height="18"></i><span>Privacy Policy</span></a></li>
        <li><a href="#" class="sidebar-nav-item"><i data-lucide="star" width="18" height="18"></i><span>Rate Us</span></a></li>
        <li><a href="tel:9857102002" class="sidebar-nav-item"><i data-lucide="phone-call" width="18" height="18"></i><span>Helpline: 9857102002</span></a></li>
        <li><a href="#" class="sidebar-nav-item"><i data-lucide="scroll-text" width="18" height="18"></i><span>Terms &amp; Conditions</span></a></li>
        <li>
          <form method="POST" action="{{ route('logout') }}" class="d-inline">
            @csrf
            <button type="submit" class="sidebar-nav-item sidebar-logout-btn">
              <i data-lucide="log-out" width="18" height="18"></i><span>Logout</span>
            </button>
          </form>
        </li>
      </ul>
    </nav>
  </aside>

  <!-- TOP NAVBAR -->
  <header class="top-navbar" role="banner">
    <div class="navbar-inner container-fluid">
      <div class="navbar-left">
        <button class="hamburger-btn" id="sidebarToggle" aria-label="Open menu" aria-expanded="false" aria-controls="sidebar">
          <i data-lucide="menu" width="22" height="22"></i>
        </button>
        <div class="navbar-brand">
          <img src="{{ asset('assets/images/logo.png') }}" alt="Himrishtey Logo" class="navbar-logo">
        </div>
        <span class="navbar-greeting">Hi, <strong>{{ Auth::user()->full_name ?? 'User' }}</strong> 👋</span>
      </div>
      <div class="navbar-right">
        <div class="navbar-wallet">
          <i data-lucide="wallet" width="18" height="18"></i>
          <span class="wallet-balance">₹{{ Auth::user()->wallet_balance ?? '0' }}</span>
        </div>
        <button class="theme-toggle-btn" data-theme-toggle aria-label="Switch to dark mode">
          <i data-lucide="moon" width="18" height="18"></i>
        </button>
        <button class="profile-avatar-btn" id="profileQuickViewBtn" aria-label="Open profile quick view" aria-expanded="false" aria-controls="profileQuickView">
          <img src="https://picsum.photos/seed/bride1/40/40" alt="{{ Auth::user()->name ?? 'User' }}" width="40" height="40" class="navbar-avatar" loading="lazy" />
          <span class="online-dot" aria-hidden="true"></span>
        </button>
      </div>
    </div>
  </header>

  <!-- PROFILE QUICK VIEW POPUP -->
  <div class="pqv-backdrop" id="pqvBackdrop" aria-hidden="true"></div>
  <div class="profile-quickview" id="profileQuickView" role="dialog" aria-modal="true" aria-label="Profile Quick View" aria-hidden="true">
    <div class="pqv-inner">
      <button class="pqv-close" id="pqvClose" aria-label="Close">
        <i data-lucide="x" width="18" height="18"></i>
      </button>

      <div class="pqv-user-row">
        <div class="pqv-avatar-wrap">
          <img src="https://picsum.photos/seed/bride1/60/60" alt="{{ Auth::user()->name ?? 'User' }}" width="60" height="60" loading="lazy" class="pqv-avatar" />
          <span class="pqv-avatar-camera" aria-hidden="true"><i data-lucide="camera" width="11" height="11"></i></span>
        </div>
        <div class="pqv-user-text">
          <div class="pqv-name-row">
            <strong class="pqv-name">{{ Auth::user()->full_name ?? 'User' }}</strong>
            <span class="pqv-profile-id">{{ Auth::user()->profile_id ?? 'N/A' }}</span>
          </div>
          <span class="pqv-email">{{ Auth::user()->email ?? 'email@example.com' }}</span>
          <a href="{{route('view-my-profile')}}" class="pqv-link-btn">View Your Profile</a>
        </div>
      </div>

      <hr class="pqv-divider" />

      <div class="pqv-info-row">
        <div class="pqv-info-icon"><i data-lucide="wallet" width="22" height="22"></i></div>
        <div class="pqv-info-content">
          <strong class="pqv-info-title">Wallet</strong>
          <div class="pqv-info-meta-row">
            <span class="pqv-info-label">Wallet Balance</span>
            <strong class="pqv-info-value">₹{{ Auth::user()->wallet_balance ?? '0' }}</strong>
          </div>
          <a href="#" class="pqv-link-btn">View Wallet</a>
        </div>
      </div>

      <hr class="pqv-divider" />

      <div class="pqv-info-row">
        <div class="pqv-info-icon"><i data-lucide="shield-check" width="22" height="22"></i></div>
        <div class="pqv-info-content">
          <div class="pqv-info-title-row">
            <strong class="pqv-info-title">Membership</strong>
            <span class="pqv-badge active">Active</span>
          </div>
          <div class="pqv-info-meta-row">
            <span class="pqv-info-label">Plan name</span>
            <strong class="pqv-info-value">Gold</strong>
          </div>
          <a href="#" class="pqv-link-btn">View Membership Plans</a>
        </div>
      </div>

      <hr class="pqv-divider" />

      <div class="pqv-footer-links">
        <a href="#">Terms and Conditions</a>
        <span aria-hidden="true">•</span>
        <a href="#">Privacy Policy</a>
      </div>
    </div>
  </div>

  <!-- MAIN CONTENT -->
  <main id="main-content" class="main-content">
    @yield('content')
  </main>

  <!-- PAGE FOOTER -->
  <footer class="site-footer" role="contentinfo">
    <div class="container-xxl footer-inner">
      <div class="footer-brand">
        <img src="{{ asset('assets/images/logo.png') }}" alt="Himrishtey Logo" class="footer-logo">
        <p class="footer-tagline">Connecting hearts across Himachal Pradesh &amp; beyond.</p>
      </div>
      <div class="footer-links">
        <a href="#">Terms &amp; Conditions</a>
        <a href="#">Privacy Policy</a>
        <a href="#">Refund Policy</a>
        <a href="#">Contact Us</a>
      </div>
      <p class="footer-copy">© 2026 HimRishtey. All rights reserved.</p>
    </div>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Custom JS -->
  <script src="{{ asset('assets/js/script.js') }}"></script>
  
  @yield('scripts')
</body>
</html>
