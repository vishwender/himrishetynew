<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profile Detail – HimRishtey</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>

    <!-- Base CSS (always loaded) -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- Page-specific CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/view-my-profile.css') }}">
</head>

<body>

    <!-- ===================== NAVBAR ===================== -->
    <nav class="pd-navbar">
        <div class="pd-navbar-inner">
            <a href="{{route('home')}}" class="pd-back-btn" aria-label="Go back">
                <i data-lucide="arrow-left" width="20" height="20"></i>
                <span>Back</span>
            </a>

            <a href="{{ route('home') }}" class="pd-brand" aria-label="HimRishtey Home">
                <!-- <svg width="28" height="28" viewBox="0 0 36 36" fill="none" aria-hidden="true">
        <circle cx="18" cy="18" r="18" fill="#D92768"/>
        <path d="M18 8 C13 8 9 12 9 17 C9 22 14 26 18 29 C22 26 27 22 27 17 C27 12 23 8 18 8Z" fill="white" opacity="0.92"/>
        <path d="M14 17 C14 15 16 13 18 13 C20 13 22 15 22 17" stroke="#D92768" stroke-width="2" stroke-linecap="round" fill="none"/>
      </svg>
      <span>Him<span class="text-primary-accent">Rishtey</span></span> -->
                <img src="assets/images/logo.png" alt="Himrishtey Logo" class="navbar-logo">
            </a>

            <div class="pd-navbar-actions">
                <button class="pd-icon-btn" id="galleryBtn" title="View Gallery">
                    <i data-lucide="images" width="18" height="18"></i>
                    <span>Gallery</span>
                </button>
                <!-- <button class="pd-icon-btn" id="shareBtn" title="Share Profile">
                    <i data-lucide="share-2" width="18" height="18"></i>
                </button> -->
                <button class="pd-icon-btn theme-toggle-btn" id="themeToggleBtn" aria-label="Toggle dark mode">
                    <i data-lucide="moon" width="18" height="18"></i>
                </button>
            </div>
        </div>
    </nav>

    <!-- ===================== HERO / PHOTO CAROUSEL ===================== -->
    <section class="pd-hero">
        <div class="pd-hero-carousel" id="heroCarousel">
            <!-- Slides injected by JS or static placeholders -->
            <div class="pd-slide active" style="background: linear-gradient(135deg, #fde8f0 0%, #f4adc7 100%);">
                <div class="pd-slide-placeholder">
                    <i data-lucide="user" width="64" height="64"></i>
                </div>
            </div>
            <div class="pd-slide" style="background: linear-gradient(135deg, #f5f0ff 0%, #c8b0ff 100%);">
                <div class="pd-slide-placeholder">
                    <i data-lucide="image" width="64" height="64"></i>
                </div>
            </div>
            <div class="pd-slide" style="background: linear-gradient(135deg, #fff4ec 0%, #ffc399 100%);">
                <div class="pd-slide-placeholder">
                    <i data-lucide="image" width="64" height="64"></i>
                </div>
            </div>

            <!-- Slide indicators -->
            <div class="pd-slide-dots" id="slideDots"></div>

            <!-- Prev / Next -->
            <button class="pd-slide-nav pd-slide-prev" id="slidePrev" aria-label="Previous photo">
                <i data-lucide="chevron-left" width="22" height="22"></i>
            </button>
            <button class="pd-slide-nav pd-slide-next" id="slideNext" aria-label="Next photo">
                <i data-lucide="chevron-right" width="22" height="22"></i>
            </button>

            <!-- Hero overlay info -->
            <div class="pd-hero-overlay">
                <div class="pd-hero-meta">
                    <p class="pd-hero-age">{{$profile->age_years}} | 5'7" ft</p>
                    <h1 class="pd-hero-name">{{ $profile->full_name }}<span class="pd-hero-id">|{{$profile->profile_id}}</span></h1>
                    <p class="pd-hero-location">
                        <i data-lucide="map-pin" width="14" height="14"></i>
                        {{$profile->city_living_in}}, {{$profile->state_living_in}}
                    </p>
                </div>

                <!-- Right side action buttons (like / save) -->
                <!-- <div class="pd-hero-actions">
                    <button class="pd-hero-fab" id="likeBtn" aria-label="Like profile" title="Like">
                        <i data-lucide="heart" width="20" height="20"></i>
                    </button>
                    <button class="pd-hero-fab" id="shortlistBtn" aria-label="Shortlist profile" title="Shortlist">
                        <i data-lucide="bookmark" width="20" height="20"></i>
                    </button>
                </div> -->
            </div>
        </div>
    </section>

    <!-- ===================== MAIN CONTENT ===================== -->
    <main class="pd-main container-xl">
        <div class="pd-layout">

            <!-- LEFT COLUMN: Detail Sections -->
            <div class="pd-details-col">

                <!-- Premium / Verified badge strip -->
                <div class="pd-badge-strip">
                    <span class="pd-badge pd-badge-verified">
                        <i data-lucide="badge-check" width="14" height="14"></i> Verified Profile
                    </span>
                    <span class="pd-badge pd-badge-premium">
                        <i data-lucide="star" width="14" height="14"></i> Premium Member
                    </span>
                    <span class="pd-badge pd-badge-active">
                        <i data-lucide="circle" width="10" height="10"></i> Active
                    </span>
                </div>

                <!-- ── BASIC DETAILS ── -->
                <div class="pd-section" id="sec-basic">
                    <div class="pd-section-header">
                        <div class="pd-section-icon" style="--icon-color: var(--color-primary);">
                            <i data-lucide="user-circle" width="20" height="20"></i>
                        </div>
                        <h2 class="pd-section-title">Basic Details</h2>
                    </div>
                    <div class="pd-section-body">
                        <p class="pd-about-text">
                            {{ $profile->about_me }}
                        </p>
                        <p class="pd-meta-line">
                            Created by <strong>{{$profile->profile_created_for}}</strong> &nbsp;·&nbsp; {{$profile->age_years}} years &nbsp;·&nbsp; Profile ID: <strong>{{$profile->profile_id }}</strong> &nbsp;·&nbsp; {{$profile->religion }} &nbsp;·&nbsp; {{$profile->cast}} &nbsp;·&nbsp; {{$profile->city_living_in}}
                        </p>
                        <div class="pd-tags">
                            <span class="pd-tag">{{ $profile->marital_status }}</span>
                        </div>
                    </div>
                </div>

                <!-- ── ASTRO & KUNDLI ── -->
                <div class="pd-section" id="sec-kundli">
                    <div class="pd-section-header">
                        <div class="pd-section-icon" style="--icon-color: #4f8ef7;">
                            <i data-lucide="star" width="20" height="20"></i>
                        </div>
                        <h2 class="pd-section-title">Astro & Kundli Details</h2>
                    </div>
                    <div class="pd-section-body">
                        <div class="pd-info-grid">
                            <div class="pd-info-row">
                                <span class="pd-info-label">Date of Birth</span>
                                <span class="pd-info-value">15 March 1996</span>
                            </div>
                            <div class="pd-info-row">
                                <span class="pd-info-label">Time of Birth</span>
                                <span class="pd-info-value pd-locked" id="tobValue">
                                    <i data-lucide="lock" width="14" height="14"></i> Premium Only
                                </span>
                            </div>
                            <div class="pd-info-row">
                                <span class="pd-info-label">Place of Birth</span>
                                <span class="pd-info-value pd-locked" id="pobValue">
                                    <i data-lucide="lock" width="14" height="14"></i> {{$profile->birth_place}}
                                </span>
                            </div>
                            <div class="pd-info-row">
                                <span class="pd-info-label">Manglik</span>
                                <span class="pd-info-value">{{$profile->manglik}}</span>
                            </div>
                        </div>
                    </div>

                    <!-- ── RELIGION INFORMATION ── -->
                    <div class="pd-section" id="sec-religion">
                        <div class="pd-section-header">
                            <div class="pd-section-icon" style="--icon-color: #f97316;">
                                <i data-lucide="sun" width="20" height="20"></i>
                            </div>
                            <h2 class="pd-section-title">Religion Information</h2>
                        </div>
                        <div class="pd-section-body">
                            <div class="pd-info-grid">
                                <div class="pd-info-row">
                                    <span class="pd-info-label">Community</span>
                                    <span class="pd-info-value">{{$profile->cast}}</span>
                                </div>
                                <div class="pd-info-row">
                                    <span class="pd-info-label">Sub Community</span>
                                    <span class="pd-info-value">{{$profile->sub_cast}}</span>
                                </div>
                                <div class="pd-info-row">
                                    <span class="pd-info-label">Gotra</span>
                                    <span class="pd-info-value">{{$profile->gotra}}</span>
                                </div>
                                <div class="pd-info-row">
                                    <span class="pd-info-label">Native Place</span>
                                    <span class="pd-info-value">{{$profile->native_place}}</span>
                                </div>
                                <div class="pd-info-row">
                                    <span class="pd-info-label">Mother Tongue</span>
                                    <span class="pd-info-value">{{$profile->mother_tongue}}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ── CONTACT DETAILS ── -->
                    <div class="pd-section" id="sec-contact">
                        <div class="pd-section-header">
                            <div class="pd-section-icon" style="--icon-color: #ea4c2a;">
                                <i data-lucide="phone" width="20" height="20"></i>
                            </div>
                            <h2 class="pd-section-title">Contact Details</h2>
                        </div>
                        <div class="pd-section-body">
                            <div class="pd-info-grid">
                                <div class="pd-info-row pd-contact-row">
                                    <div>
                                        <span class="pd-info-label">Contact Number</span>
                                        <span class="pd-info-value pd-locked" id="mobileValue">
                                            <i data-lucide="lock" width="14" height="14"></i>{{$profile->mobile_number}}
                                        </span>
                                    </div>
                                    <i data-lucide="lock" width="16" height="16" class="pd-row-lock"></i>
                                </div>
                                <div class="pd-info-row pd-contact-row">
                                    <div>
                                        <span class="pd-info-label">WhatsApp</span>
                                        <span class="pd-info-value pd-locked" id="waValue">
                                            <i data-lucide="lock" width="14" height="14"></i>{{$profile->whatsapp_number}}
                                        </span>
                                    </div>
                                    <i data-lucide="lock" width="16" height="16" class="pd-row-lock"></i>
                                </div>
                                <div class="pd-info-row pd-contact-row">
                                    <div>
                                        <span class="pd-info-label">Email</span>
                                        <span class="pd-info-value pd-locked" id="emailValue">
                                            <i data-lucide="lock" width="14" height="14"></i>{{$profile->email}}
                                        </span>
                                    </div>
                                    <i data-lucide="lock" width="16" height="16" class="pd-row-lock"></i>
                                </div>
                            </div>
                            <!-- <div class="pd-unlock-strip" id="contactUnlock">
                                <span>Want to get full contact information?</span>
                                <button class="pd-btn-unlock pd-btn-unlock-orange" onclick="openUnlockModal('contact')">
                                    <i data-lucide="lock-open" width="15" height="15"></i> Unlock Now
                                </button>
                            </div> -->
                        </div>
                    </div>

                    <!-- ── EDUCATION & CAREER ── -->
                    <div class="pd-section" id="sec-edu">
                        <div class="pd-section-header">
                            <div class="pd-section-icon" style="--icon-color: #16a34a;">
                                <i data-lucide="graduation-cap" width="20" height="20"></i>
                            </div>
                            <h2 class="pd-section-title">Education & Career</h2>
                        </div>
                        <div class="pd-section-body">
                            <div class="pd-info-grid">
                                <div class="pd-info-row pd-info-row--full">
                                    <span class="pd-info-label">About Education & Career</span>
                                    <span class="pd-info-value">{{$profile->about_my_education}}</span>
                                </div>
                                <div class="pd-info-row">
                                    <span class="pd-info-label">Education</span>
                                    <span class="pd-info-value">{{$profile->education}}</span>
                                </div>
                                <div class="pd-info-row">
                                    <span class="pd-info-label">Other Qualification</span>
                                    <span class="pd-info-value">{{$profile->any_other_qualification}}</span>
                                </div>
                                <div class="pd-info-row">
                                    <span class="pd-info-label">Employed In</span>
                                    <span class="pd-info-value">{{$profile->employes_in}}</span>
                                </div>
                                <div class="pd-info-row">
                                    <span class="pd-info-label">Occupation</span>
                                    <span class="pd-info-value">{{$profile->occupation}}</span>
                                </div>
                                <div class="pd-info-row">
                                    <span class="pd-info-label">Currently Working At</span>
                                    <span class="pd-info-value">{{$profile->organization_name}}</span>
                                </div>
                                <div class="pd-info-row">
                                    <span class="pd-info-label">Job Location</span>
                                    <span class="pd-info-value">{{$profile->job_location}}</span>
                                </div>
                                <div class="pd-info-row">
                                    <span class="pd-info-label">Annual Income</span>
                                    <span class="pd-info-value">{{$profile->annual_income}}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ── FAMILY DETAILS ── -->
                    <div class="pd-section" id="sec-family">
                        <div class="pd-section-header">
                            <div class="pd-section-icon" style="--icon-color: #0d9488;">
                                <i data-lucide="users" width="20" height="20"></i>
                            </div>
                            <h2 class="pd-section-title">Family Details</h2>
                        </div>
                        <div class="pd-section-body">
                            <div class="pd-info-grid">
                                <div class="pd-info-row pd-info-row--full">
                                    <span class="pd-info-label">About My Family</span>
                                    <span class="pd-info-value">{{$profile->about_family}}</span>
                                </div>
                                <div class="pd-info-row">
                                    <span class="pd-info-label">Father's Occupation</span>
                                    <span class="pd-info-value">{{$profile->father_occupation}}</span>
                                </div>
                                <div class="pd-info-row">
                                    <span class="pd-info-label">Mother's Occupation</span>
                                    <span class="pd-info-value">{{$profile->mother_occupation}}</span>
                                </div>
                                <div class="pd-info-row">
                                    <span class="pd-info-label">Brothers</span>
                                    <span class="pd-info-value">{{$profile->no_of_brothers}}({{$profile->married_brothers}})</span>
                                </div>
                                <div class="pd-info-row">
                                    <span class="pd-info-label">Sisters</span>
                                    <span class="pd-info-value">{{$profile->no_of_sisters}}({{$profile->married_sisters}})</span>
                                </div>
                                <div class="pd-info-row">
                                    <span class="pd-info-label">Native Place</span>
                                    <span class="pd-info-value">{{$profile->native_place}},{{$profile->state_living_in}}</span>
                                </div>
                                <div class="pd-info-row">
                                    <span class="pd-info-label">Family Type</span>
                                    <span class="pd-info-value">{{$profile->family_type}}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ── LIFESTYLE ── -->
                    <div class="pd-section" id="sec-lifestyle">
                        <div class="pd-section-header">
                            <div class="pd-section-icon" style="--icon-color: #ca8a04;">
                                <i data-lucide="coffee" width="20" height="20"></i>
                            </div>
                            <h2 class="pd-section-title">Lifestyle</h2>
                        </div>
                        <div class="pd-section-body">
                            <div class="pd-lifestyle-grid">
                                <div class="pd-lifestyle-chip">
                                    <i data-lucide="utensils" width="16" height="16"></i>
                                    <div>
                                        <span class="pd-lc-label">Diet</span>
                                        <span class="pd-lc-value">{{$profile->diet}}</span>
                                    </div>
                                </div>
                                <div class="pd-lifestyle-chip">
                                    <i data-lucide="cigarette-off" width="16" height="16"></i>
                                    <div>
                                        <span class="pd-lc-label">Smoking</span>
                                        <span class="pd-lc-value">{{$profile->is_smoking}}</span>
                                    </div>
                                </div>
                                <div class="pd-lifestyle-chip">
                                    <i data-lucide="wine-off" width="16" height="16"></i>
                                    <div>
                                        <span class="pd-lc-label">Drinking</span>
                                        <span class="pd-lc-value">{{$profile->is_drinking}}</span>
                                    </div>
                                </div>
                                <div class="pd-lifestyle-chip">
                                    <i data-lucide="accessibility" width="16" height="16"></i>
                                    <div>
                                        <span class="pd-lc-label">Disability</span>
                                        <span class="pd-lc-value">{{$profile->any_disability}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ── PARTNER PREFERENCES ── -->
                    <div class="pd-section" id="sec-partner">
                        <div class="pd-section-header">
                            <div class="pd-section-icon" style="--icon-color: #e11d48;">
                                <i data-lucide="heart-handshake" width="20" height="20"></i>
                            </div>
                            <h2 class="pd-section-title">Partner Preferences</h2>
                        </div>
                        <div class="pd-section-body">
                            <div class="pd-info-grid">
                                <div class="pd-info-row pd-info-row--full">
                                    <span class="pd-info-label">About My Partner</span>
                                    <span class="pd-info-value">{{$profile->about_my_partner}}</span>
                                </div>
                                <div class="pd-info-row">
                                    <span class="pd-info-label">Age Range</span>
                                    <span class="pd-info-value">{{$profile->partner_age_from}} - {{$profile->partner_age_to}}</span>
                                </div>
                                <div class="pd-info-row">
                                    <span class="pd-info-label">Height Range</span>
                                    <span class="pd-info-value">{{$profile->partner_height_from}} - {{$profile->partner_height_to}}"</span>
                                </div>
                                <div class="pd-info-row">
                                    <span class="pd-info-label">Marital Status</span>
                                    <span class="pd-info-value">{{$profile->looking_for}}</span>
                                </div>
                                <div class="pd-info-row">
                                    <span class="pd-info-label">Religion & Mother Tongue</span>
                                    <span class="pd-info-value">{{$profile->partner_religion}} | {{$profile->partner_mothertongue}}</span>
                                </div>
                                <div class="pd-info-row">
                                    <span class="pd-info-label">Community</span>
                                    <span class="pd-info-value">{{$profile->partner_cast}}</span>
                                </div>
                                <div class="pd-info-row">
                                    <span class="pd-info-label">Is Manglik</span>
                                    <span class="pd-info-value">{{$profile->is_partner_manglik}}</span>
                                </div>
                                <div class="pd-info-row">
                                    <span class="pd-info-label">Highest Qualification</span>
                                    <span class="pd-info-value">{{$profile->partner_education}}</span>
                                </div>
                                <div class="pd-info-row">
                                    <span class="pd-info-label">Partner Occupation</span>
                                    <span class="pd-info-value">{{$profile->partner_occupation}}</span>
                                </div>
                                <div class="pd-info-row">
                                    <span class="pd-info-label">Annual Income</span>
                                    <span class="pd-info-value">{{$profile->partner_annual_income_from}} - {{$profile->partner_annual_income_to}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </main>

    <!-- ===================== GALLERY LIGHTBOX ===================== -->
    <div class="pd-gallery-overlay" id="galleryOverlay" aria-hidden="true" role="dialog" aria-modal="true" aria-label="Profile Gallery">
        <div class="pd-gallery-modal">
            <button class="pd-gallery-close" id="galleryClose" aria-label="Close gallery">
                <i data-lucide="x" width="22" height="22"></i>
            </button>
            <div class="pd-gallery-grid" id="galleryGrid">
                <div class="pd-gallery-item">
                    <div class="pd-gallery-placeholder">
                        <i data-lucide="user" width="40" height="40"></i>
                    </div>
                </div>
                <div class="pd-gallery-item">
                    <div class="pd-gallery-placeholder">
                        <i data-lucide="image" width="40" height="40"></i>
                    </div>
                </div>
                <div class="pd-gallery-item">
                    <div class="pd-gallery-placeholder">
                        <i data-lucide="image" width="40" height="40"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ===================== UNLOCK MODAL ===================== -->
    <div class="pd-modal-overlay" id="unlockModalOverlay" aria-hidden="true" role="dialog" aria-modal="true">
        <div class="pd-modal">
            <div class="pd-modal-header">
                <h3 id="unlockModalTitle">Unlock Profile</h3>
                <button class="pd-modal-close" onclick="closeUnlockModal()" aria-label="Close">
                    <i data-lucide="x" width="20" height="20"></i>
                </button>
            </div>
            <div class="pd-modal-body">
                <div class="pd-modal-profile">
                    <div class="pd-modal-avatar">
                        <i data-lucide="user" width="28" height="28"></i>
                    </div>
                    <strong>Rahul Thakur</strong>
                </div>
                <div class="pd-modal-row">
                    <span>Profile view price</span>
                    <span>₹ 20</span>
                </div>
                <div class="pd-modal-wallet">
                    <div>
                        <span>Wallet Balance</span>
                        <small class="pd-wallet-low" id="walletLowNote" style="display:none;">Low balance</small>
                    </div>
                    <span>₹ 150</span>
                </div>
            </div>
            <div class="pd-modal-footer">
                <button class="pd-modal-cancel" onclick="closeUnlockModal()">Cancel</button>
                <button class="pd-modal-confirm" id="unlockConfirmBtn" onclick="confirmUnlock()">
                    Unlock
                </button>
            </div>
        </div>
    </div>

    <!-- Toast notification -->
    <div class="pd-toast" id="pdToast" role="alert" aria-live="polite"></div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="{{ asset('assets/js/profile-detail.js') }}"></script>
</body>

</html>