<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>HimRishtey</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
    @yield('styles')
</head>

<body>

    <!-- ========== HEADER ========== -->
    <header class="top-navbar" role="banner">
        <div class="navbar-inner container-fluid">
            <div class="navbar-left">
                <button class="hamburger-btn" id="sidebarToggle" aria-label="Open menu" aria-expanded="false" aria-controls="sidebar">
                    <i data-lucide="menu" width="22" height="22"></i>
                </button>
                <div class="navbar-brand">
                    <img src="assets/images/logo.png" alt="Himrishtey Logo" class="navbar-logo">
                </div>
                <span class="navbar-greeting">Hi, <strong>Priya</strong> 👋</span>
            </div>
            <div class="navbar-right">
                <div class="navbar-wallet">
                    <i data-lucide="wallet" width="18" height="18"></i>
                    <span class="wallet-balance" id="navbarBalance">₹1,250</span>
                </div>
                <button class="theme-toggle-btn" data-theme-toggle aria-label="Switch to dark mode">
                    <i data-lucide="moon" width="18" height="18"></i>
                </button>
                <button class="profile-avatar-btn" id="profileQuickViewBtn" aria-label="Open profile quick view" aria-expanded="false" aria-controls="profileQuickView">
                    <img src="https://picsum.photos/seed/bride1/40/40" alt="Priya Sharma" width="40" height="40" class="navbar-avatar" loading="lazy" />
                    <span class="online-dot" aria-hidden="true"></span>
                </button>
            </div>
        </div>
    </header>
    @yield('content')
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    @yield('scripts')
</body>

</html>