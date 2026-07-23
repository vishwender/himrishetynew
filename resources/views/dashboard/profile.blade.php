@extends('layouts.dashboard')

@section('title', 'Dashboard - HimRishtey')

@section('content')

    <!-- BREADCRUMB / PAGE TITLE -->
    <div class="page-header-bar container-xxl">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb-custom">
          <li><i data-lucide="home" width="14" height="14"></i></li>
          <li aria-current="page">Dashboard</li>
        </ol>
      </nav>
      <div class="page-header-actions">
        <a href="#" class="btn-primary-sm">
          <i data-lucide="plus" width="15" height="15"></i> Add Photos
        </a>
        <a href="#" class="btn-outline-sm">
          <i data-lucide="search" width="15" height="15"></i> Search Profiles
        </a>
      </div>
    </div>

    <!-- VERIFY BANNER (conditional) -->
    <div class="verify-banner container-xxl" id="verifyBanner">
      <div class="verify-banner-inner">
        <i data-lucide="shield-alert" width="20" height="20"></i>
        <span>Your profile is not verified. Verify now to get more matches and build trust.</span>
        <a href="#" class="verify-banner-btn">Verify Now</a>
      </div>
      <button class="verify-banner-dismiss" aria-label="Dismiss" onclick="document.getElementById('verifyBanner').remove()">
        <i data-lucide="x" width="16" height="16"></i>
      </button>
    </div>

    <!-- PROFILE COMPLETION -->
    <section class="profile-completion-section container-xxl" aria-label="Profile completion">
      <div class="pc-card">
        <div class="pc-left">
          <div class="pc-avatar-ring" style="--progress: 72%;">
            <img src="https://picsum.photos/seed/bride1/70/70" alt="Priya Sharma" width="70" height="70" loading="lazy" class="pc-avatar" />
            <svg class="pc-ring-svg" viewBox="0 0 80 80" aria-hidden="true">
              <circle cx="40" cy="40" r="36" fill="none" stroke="var(--color-surface-offset)" stroke-width="4"/>
              <circle cx="40" cy="40" r="36" fill="none" stroke="var(--color-primary)" stroke-width="4" stroke-dasharray="226.2" stroke-dashoffset="63.3" stroke-linecap="round" transform="rotate(-90 40 40)"/>
            </svg>
            <span class="pc-percent">72%</span>
          </div>
        </div>
        <div class="pc-right">
          <h3 class="pc-title">Complete Your Profile</h3>
          <p class="pc-desc">A complete profile gets <strong>5x more</strong> matches. Add your details to stand out.</p>
          <div class="pc-progress-bar-wrap">
            <div class="pc-progress-bar" style="width: 72%;" role="progressbar" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <div class="pc-steps">
            <span class="pc-step done"><i data-lucide="check" width="12" height="12"></i> Basic Info</span>
            <span class="pc-step done"><i data-lucide="check" width="12" height="12"></i> Photos</span>
            <span class="pc-step pending"><i data-lucide="plus" width="12" height="12"></i> Horoscope</span>
            <span class="pc-step pending"><i data-lucide="plus" width="12" height="12"></i> Family Details</span>
          </div>
        </div>
        <a href="#" class="pc-cta-btn">Complete Now</a>
      </div>
    </section>

    <!-- STATS BLOCKS -->
    <section class="stats-section container-xxl" aria-label="Dashboard statistics">
      <div class="stats-grid">
        <a href="#" class="stat-card pink" aria-label="Profile Visits: 128">
          <div class="stat-card-header">
            <span class="stat-label">Profile Visits</span>
            <div class="stat-icon-wrap pink">
              <i data-lucide="user" width="20" height="20"></i>
            </div>
          </div>
          <span class="stat-number" data-target="128">0</span>
          <span class="stat-trend up"><i data-lucide="trending-up" width="12" height="12"></i> +12% this week</span>
        </a>
        <a href="#" class="stat-card blue" aria-label="Likes: 54">
          <div class="stat-card-header">
            <span class="stat-label">Likes</span>
            <div class="stat-icon-wrap blue">
              <i data-lucide="heart" width="20" height="20"></i>
            </div>
          </div>
          <span class="stat-number" data-target="54">0</span>
          <span class="stat-trend up"><i data-lucide="trending-up" width="12" height="12"></i> +5 new</span>
        </a>
        <a href="#" class="stat-card purple" aria-label="Interests Received: 37">
          <div class="stat-card-header">
            <span class="stat-label">Interests</span>
            <div class="stat-icon-wrap purple">
              <i data-lucide="user-plus" width="20" height="20"></i>
            </div>
          </div>
          <span class="stat-number" data-target="37">0</span>
          <span class="stat-trend up"><i data-lucide="trending-up" width="12" height="12"></i> +3 today</span>
        </a>
        <a href="#" class="stat-card green" aria-label="Contacts Viewed: 19">
          <div class="stat-card-header">
            <span class="stat-label">Contacts Viewed</span>
            <div class="stat-icon-wrap green">
              <i data-lucide="eye" width="20" height="20"></i>
            </div>
          </div>
          <span class="stat-number" data-target="19">0</span>
          <span class="stat-trend neutral"><i data-lucide="minus" width="12" height="12"></i> Same as last week</span>
        </a>
      </div>
    </section>

    <!-- PROFILE SECTIONS -->

    <!-- Recent Profiles -->
    <section class="profile-row-section container-xxl" aria-label="Recent Profiles">
      <div class="section-header">
        <div class="section-title-group">
          <h2 class="section-title">Recent Profiles</h2>
          <span class="section-badge">New</span>
        </div>
        <a href="#" class="section-view-all">View All <i data-lucide="arrow-right" width="14" height="14"></i></a>
      </div>
      <div class="profile-scroll-track" role="list">
        <!-- Profile Card Template (×6) -->
        <article class="profile-card" role="listitem" tabindex="0">
          <div class="profile-card-img-wrap">
            <img src="https://picsum.photos/seed/match1/220/280" alt="Ananya Verma, 27" width="220" height="280" loading="lazy" class="profile-card-img" />
            <span class="profile-card-online" aria-label="Online"></span>
            <div class="profile-card-actions">
              <button class="pca-btn like" aria-label="Like Ananya Verma"><i data-lucide="heart" width="16" height="16"></i></button>
              <button class="pca-btn interest" aria-label="Send interest to Ananya Verma"><i data-lucide="user-plus" width="16" height="16"></i></button>
            </div>
          </div>
          <div class="profile-card-body">
            <h3 class="profile-card-name">Ananya Verma</h3>
            <p class="profile-card-meta"><i data-lucide="map-pin" width="12" height="12"></i> Shimla, HP</p>
            <p class="profile-card-meta"><i data-lucide="briefcase" width="12" height="12"></i> Software Engineer • 27 yrs</p>
            <div class="profile-card-tags">
              <span class="pct">Hindu</span>
              <span class="pct">5'4"</span>
              <span class="pct">B.Tech</span>
            </div>
          </div>
        </article>
        <article class="profile-card" role="listitem" tabindex="0">
          <div class="profile-card-img-wrap">
            <img src="https://picsum.photos/seed/match2/220/280" alt="Sneha Kapoor, 25" width="220" height="280" loading="lazy" class="profile-card-img" />
            <div class="profile-card-actions">
              <button class="pca-btn like" aria-label="Like Sneha Kapoor"><i data-lucide="heart" width="16" height="16"></i></button>
              <button class="pca-btn interest" aria-label="Send interest to Sneha Kapoor"><i data-lucide="user-plus" width="16" height="16"></i></button>
            </div>
          </div>
          <div class="profile-card-body">
            <h3 class="profile-card-name">Sneha Kapoor</h3>
            <p class="profile-card-meta"><i data-lucide="map-pin" width="12" height="12"></i> Manali, HP</p>
            <p class="profile-card-meta"><i data-lucide="briefcase" width="12" height="12"></i> Doctor • 25 yrs</p>
            <div class="profile-card-tags">
              <span class="pct">Hindu</span>
              <span class="pct">5'2"</span>
              <span class="pct">MBBS</span>
            </div>
          </div>
        </article>
        <article class="profile-card" role="listitem" tabindex="0">
          <div class="profile-card-img-wrap">
            <img src="https://picsum.photos/seed/match3/220/280" alt="Kavita Thakur, 28" width="220" height="280" loading="lazy" class="profile-card-img" />
            <div class="profile-card-actions">
              <button class="pca-btn like" aria-label="Like Kavita Thakur"><i data-lucide="heart" width="16" height="16"></i></button>
              <button class="pca-btn interest" aria-label="Send interest to Kavita Thakur"><i data-lucide="user-plus" width="16" height="16"></i></button>
            </div>
          </div>
          <div class="profile-card-body">
            <h3 class="profile-card-name">Kavita Thakur</h3>
            <p class="profile-card-meta"><i data-lucide="map-pin" width="12" height="12"></i> Dharamshala, HP</p>
            <p class="profile-card-meta"><i data-lucide="briefcase" width="12" height="12"></i> Teacher • 28 yrs</p>
            <div class="profile-card-tags">
              <span class="pct">Sikh</span>
              <span class="pct">5'5"</span>
              <span class="pct">M.Ed</span>
            </div>
          </div>
        </article>
        <article class="profile-card" role="listitem" tabindex="0">
          <div class="profile-card-img-wrap">
            <img src="https://picsum.photos/seed/match4/220/280" alt="Ritika Devi, 26" width="220" height="280" loading="lazy" class="profile-card-img" />
            <div class="profile-card-actions">
              <button class="pca-btn like" aria-label="Like Ritika Devi"><i data-lucide="heart" width="16" height="16"></i></button>
              <button class="pca-btn interest" aria-label="Send interest to Ritika Devi"><i data-lucide="user-plus" width="16" height="16"></i></button>
            </div>
          </div>
          <div class="profile-card-body">
            <h3 class="profile-card-name">Ritika Devi</h3>
            <p class="profile-card-meta"><i data-lucide="map-pin" width="12" height="12"></i> Kullu, HP</p>
            <p class="profile-card-meta"><i data-lucide="briefcase" width="12" height="12"></i> CA • 26 yrs</p>
            <div class="profile-card-tags">
              <span class="pct">Hindu</span>
              <span class="pct">5'3"</span>
              <span class="pct">CA</span>
            </div>
          </div>
        </article>
        <article class="profile-card" role="listitem" tabindex="0">
          <div class="profile-card-img-wrap">
            <img src="https://picsum.photos/seed/match5/220/280" alt="Pooja Negi, 29" width="220" height="280" loading="lazy" class="profile-card-img" />
            <div class="profile-card-actions">
              <button class="pca-btn like" aria-label="Like Pooja Negi"><i data-lucide="heart" width="16" height="16"></i></button>
              <button class="pca-btn interest" aria-label="Send interest to Pooja Negi"><i data-lucide="user-plus" width="16" height="16"></i></button>
            </div>
          </div>
          <div class="profile-card-body">
            <h3 class="profile-card-name">Pooja Negi</h3>
            <p class="profile-card-meta"><i data-lucide="map-pin" width="12" height="12"></i> Mandi, HP</p>
            <p class="profile-card-meta"><i data-lucide="briefcase" width="12" height="12"></i> Nurse • 29 yrs</p>
            <div class="profile-card-tags">
              <span class="pct">Hindu</span>
              <span class="pct">5'1"</span>
              <span class="pct">GNM</span>
            </div>
          </div>
        </article>
        <article class="profile-card" role="listitem" tabindex="0">
          <div class="profile-card-img-wrap">
            <img src="https://picsum.photos/seed/match6/220/280" alt="Meena Rawat, 27" width="220" height="280" loading="lazy" class="profile-card-img" />
            <div class="profile-card-actions">
              <button class="pca-btn like" aria-label="Like Meena Rawat"><i data-lucide="heart" width="16" height="16"></i></button>
              <button class="pca-btn interest" aria-label="Send interest to Meena Rawat"><i data-lucide="user-plus" width="16" height="16"></i></button>
            </div>
          </div>
          <div class="profile-card-body">
            <h3 class="profile-card-name">Meena Rawat</h3>
            <p class="profile-card-meta"><i data-lucide="map-pin" width="12" height="12"></i> Bilaspur, HP</p>
            <p class="profile-card-meta"><i data-lucide="briefcase" width="12" height="12"></i> Bank Officer • 27 yrs</p>
            <div class="profile-card-tags">
              <span class="pct">Hindu</span>
              <span class="pct">5'3"</span>
              <span class="pct">MBA</span>
            </div>
          </div>
        </article>
      </div>
    </section>

    <!-- Matching Profiles -->
    <section class="profile-row-section matching-bg container-xxl" aria-label="Matching Profiles">
      <div class="section-header">
        <div class="section-title-group">
          <h2 class="section-title">Matching Profiles</h2>
          <span class="section-badge primary">For You</span>
        </div>
        <a href="#" class="section-view-all">View All <i data-lucide="arrow-right" width="14" height="14"></i></a>
      </div>
      <div class="profile-scroll-track" role="list">
        <article class="profile-card featured" role="listitem" tabindex="0">
          <div class="profile-card-img-wrap">
            <img src="https://picsum.photos/seed/match7/220/280" alt="Simran Bhatia, 26" width="220" height="280" loading="lazy" class="profile-card-img" />
            <span class="profile-card-match-badge">98% Match</span>
            <span class="profile-card-online" aria-label="Online"></span>
            <div class="profile-card-actions">
              <button class="pca-btn like" aria-label="Like Simran Bhatia"><i data-lucide="heart" width="16" height="16"></i></button>
              <button class="pca-btn interest" aria-label="Send interest to Simran Bhatia"><i data-lucide="user-plus" width="16" height="16"></i></button>
            </div>
          </div>
          <div class="profile-card-body">
            <h3 class="profile-card-name">Simran Bhatia</h3>
            <p class="profile-card-meta"><i data-lucide="map-pin" width="12" height="12"></i> Chandigarh</p>
            <p class="profile-card-meta"><i data-lucide="briefcase" width="12" height="12"></i> IAS Officer • 26 yrs</p>
            <div class="profile-card-tags">
              <span class="pct">Sikh</span>
              <span class="pct">5'5"</span>
              <span class="pct">UPSC</span>
            </div>
          </div>
        </article>
        <article class="profile-card" role="listitem" tabindex="0">
          <div class="profile-card-img-wrap">
            <img src="https://picsum.photos/seed/match8/220/280" alt="Nisha Chauhan, 24" width="220" height="280" loading="lazy" class="profile-card-img" />
            <span class="profile-card-match-badge">92% Match</span>
            <div class="profile-card-actions">
              <button class="pca-btn like" aria-label="Like Nisha Chauhan"><i data-lucide="heart" width="16" height="16"></i></button>
              <button class="pca-btn interest" aria-label="Send interest to Nisha Chauhan"><i data-lucide="user-plus" width="16" height="16"></i></button>
            </div>
          </div>
          <div class="profile-card-body">
            <h3 class="profile-card-name">Nisha Chauhan</h3>
            <p class="profile-card-meta"><i data-lucide="map-pin" width="12" height="12"></i> Solan, HP</p>
            <p class="profile-card-meta"><i data-lucide="briefcase" width="12" height="12"></i> Architect • 24 yrs</p>
            <div class="profile-card-tags">
              <span class="pct">Hindu</span>
              <span class="pct">5'4"</span>
              <span class="pct">B.Arch</span>
            </div>
          </div>
        </article>
        <article class="profile-card" role="listitem" tabindex="0">
          <div class="profile-card-img-wrap">
            <img src="https://picsum.photos/seed/match9/220/280" alt="Puja Sharma, 27" width="220" height="280" loading="lazy" class="profile-card-img" />
            <span class="profile-card-match-badge">88% Match</span>
            <div class="profile-card-actions">
              <button class="pca-btn like" aria-label="Like Puja Sharma"><i data-lucide="heart" width="16" height="16"></i></button>
              <button class="pca-btn interest" aria-label="Send interest to Puja Sharma"><i data-lucide="user-plus" width="16" height="16"></i></button>
            </div>
          </div>
          <div class="profile-card-body">
            <h3 class="profile-card-name">Puja Sharma</h3>
            <p class="profile-card-meta"><i data-lucide="map-pin" width="12" height="12"></i> Hamirpur, HP</p>
            <p class="profile-card-meta"><i data-lucide="briefcase" width="12" height="12"></i> Lawyer • 27 yrs</p>
            <div class="profile-card-tags">
              <span class="pct">Hindu</span>
              <span class="pct">5'3"</span>
              <span class="pct">LLB</span>
            </div>
          </div>
        </article>
        <article class="profile-card" role="listitem" tabindex="0">
          <div class="profile-card-img-wrap">
            <img src="https://picsum.photos/seed/match10/220/280" alt="Tanu Gupta, 25" width="220" height="280" loading="lazy" class="profile-card-img" />
            <span class="profile-card-match-badge">85% Match</span>
            <div class="profile-card-actions">
              <button class="pca-btn like" aria-label="Like Tanu Gupta"><i data-lucide="heart" width="16" height="16"></i></button>
              <button class="pca-btn interest" aria-label="Send interest to Tanu Gupta"><i data-lucide="user-plus" width="16" height="16"></i></button>
            </div>
          </div>
          <div class="profile-card-body">
            <h3 class="profile-card-name">Tanu Gupta</h3>
            <p class="profile-card-meta"><i data-lucide="map-pin" width="12" height="12"></i> Palampur, HP</p>
            <p class="profile-card-meta"><i data-lucide="briefcase" width="12" height="12"></i> Pharmacist • 25 yrs</p>
            <div class="profile-card-tags">
              <span class="pct">Hindu</span>
              <span class="pct">5'2"</span>
              <span class="pct">B.Pharma</span>
            </div>
          </div>
        </article>
        <article class="profile-card" role="listitem" tabindex="0">
          <div class="profile-card-img-wrap">
            <img src="https://picsum.photos/seed/match11/220/280" alt="Usha Rani, 28" width="220" height="280" loading="lazy" class="profile-card-img" />
            <span class="profile-card-match-badge">81% Match</span>
            <div class="profile-card-actions">
              <button class="pca-btn like" aria-label="Like Usha Rani"><i data-lucide="heart" width="16" height="16"></i></button>
              <button class="pca-btn interest" aria-label="Send interest to Usha Rani"><i data-lucide="user-plus" width="16" height="16"></i></button>
            </div>
          </div>
          <div class="profile-card-body">
            <h3 class="profile-card-name">Usha Rani</h3>
            <p class="profile-card-meta"><i data-lucide="map-pin" width="12" height="12"></i> Una, HP</p>
            <p class="profile-card-meta"><i data-lucide="briefcase" width="12" height="12"></i> Govt. Officer • 28 yrs</p>
            <div class="profile-card-tags">
              <span class="pct">Hindu</span>
              <span class="pct">5'4"</span>
              <span class="pct">BA</span>
            </div>
          </div>
        </article>
      </div>
    </section>

    <!-- Verified Profiles -->
    <section class="profile-row-section container-xxl" aria-label="Verified Profiles">
      <div class="section-header">
        <div class="section-title-group">
          <h2 class="section-title">Verified Profiles</h2>
          <span class="section-badge verified"><i data-lucide="shield-check" width="11" height="11"></i> Verified</span>
        </div>
        <a href="#" class="section-view-all">View All <i data-lucide="arrow-right" width="14" height="14"></i></a>
      </div>
      <div class="profile-scroll-track" role="list">
        <article class="profile-card" role="listitem" tabindex="0">
          <div class="profile-card-img-wrap">
            <img src="https://picsum.photos/seed/match12/220/280" alt="Rekha Devi, 26" width="220" height="280" loading="lazy" class="profile-card-img" />
            <span class="profile-card-verified-badge"><i data-lucide="shield-check" width="12" height="12"></i></span>
            <span class="profile-card-online" aria-label="Online"></span>
            <div class="profile-card-actions">
              <button class="pca-btn like" aria-label="Like Rekha Devi"><i data-lucide="heart" width="16" height="16"></i></button>
              <button class="pca-btn interest" aria-label="Send interest to Rekha Devi"><i data-lucide="user-plus" width="16" height="16"></i></button>
            </div>
          </div>
          <div class="profile-card-body">
            <h3 class="profile-card-name">Rekha Devi <i data-lucide="shield-check" width="13" height="13" class="verified-icon"></i></h3>
            <p class="profile-card-meta"><i data-lucide="map-pin" width="12" height="12"></i> Kangra, HP</p>
            <p class="profile-card-meta"><i data-lucide="briefcase" width="12" height="12"></i> Accountant • 26 yrs</p>
            <div class="profile-card-tags">
              <span class="pct">Hindu</span>
              <span class="pct">5'3"</span>
              <span class="pct">B.Com</span>
            </div>
          </div>
        </article>
        <article class="profile-card" role="listitem" tabindex="0">
          <div class="profile-card-img-wrap">
            <img src="https://picsum.photos/seed/match13/220/280" alt="Lata Kumari, 27" width="220" height="280" loading="lazy" class="profile-card-img" />
            <span class="profile-card-verified-badge"><i data-lucide="shield-check" width="12" height="12"></i></span>
            <div class="profile-card-actions">
              <button class="pca-btn like" aria-label="Like Lata Kumari"><i data-lucide="heart" width="16" height="16"></i></button>
              <button class="pca-btn interest" aria-label="Send interest to Lata Kumari"><i data-lucide="user-plus" width="16" height="16"></i></button>
            </div>
          </div>
          <div class="profile-card-body">
            <h3 class="profile-card-name">Lata Kumari <i data-lucide="shield-check" width="13" height="13" class="verified-icon"></i></h3>
            <p class="profile-card-meta"><i data-lucide="map-pin" width="12" height="12"></i> Chamba, HP</p>
            <p class="profile-card-meta"><i data-lucide="briefcase" width="12" height="12"></i> Principal • 27 yrs</p>
            <div class="profile-card-tags">
              <span class="pct">Hindu</span>
              <span class="pct">5'2"</span>
              <span class="pct">M.Sc</span>
            </div>
          </div>
        </article>
        <article class="profile-card" role="listitem" tabindex="0">
          <div class="profile-card-img-wrap">
            <img src="https://picsum.photos/seed/match14/220/280" alt="Geeta Negi, 25" width="220" height="280" loading="lazy" class="profile-card-img" />
            <span class="profile-card-verified-badge"><i data-lucide="shield-check" width="12" height="12"></i></span>
            <div class="profile-card-actions">
              <button class="pca-btn like" aria-label="Like Geeta Negi"><i data-lucide="heart" width="16" height="16"></i></button>
              <button class="pca-btn interest" aria-label="Send interest to Geeta Negi"><i data-lucide="user-plus" width="16" height="16"></i></button>
            </div>
          </div>
          <div class="profile-card-body">
            <h3 class="profile-card-name">Geeta Negi <i data-lucide="shield-check" width="13" height="13" class="verified-icon"></i></h3>
            <p class="profile-card-meta"><i data-lucide="map-pin" width="12" height="12"></i> Spiti, HP</p>
            <p class="profile-card-meta"><i data-lucide="briefcase" width="12" height="12"></i> Nurse • 25 yrs</p>
            <div class="profile-card-tags">
              <span class="pct">Buddhist</span>
              <span class="pct">5'2"</span>
              <span class="pct">GNM</span>
            </div>
          </div>
        </article>
        <article class="profile-card" role="listitem" tabindex="0">
          <div class="profile-card-img-wrap">
            <img src="https://picsum.photos/seed/match15/220/280" alt="Shanti Devi, 29" width="220" height="280" loading="lazy" class="profile-card-img" />
            <span class="profile-card-verified-badge"><i data-lucide="shield-check" width="12" height="12"></i></span>
            <div class="profile-card-actions">
              <button class="pca-btn like" aria-label="Like Shanti Devi"><i data-lucide="heart" width="16" height="16"></i></button>
              <button class="pca-btn interest" aria-label="Send interest to Shanti Devi"><i data-lucide="user-plus" width="16" height="16"></i></button>
            </div>
          </div>
          <div class="profile-card-body">
            <h3 class="profile-card-name">Shanti Devi <i data-lucide="shield-check" width="13" height="13" class="verified-icon"></i></h3>
            <p class="profile-card-meta"><i data-lucide="map-pin" width="12" height="12"></i> Sirmaur, HP</p>
            <p class="profile-card-meta"><i data-lucide="briefcase" width="12" height="12"></i> Lawyer • 29 yrs</p>
            <div class="profile-card-tags">
              <span class="pct">Hindu</span>
              <span class="pct">5'4"</span>
              <span class="pct">LLM</span>
            </div>
          </div>
        </article>
        <article class="profile-card" role="listitem" tabindex="0">
          <div class="profile-card-img-wrap">
            <img src="https://picsum.photos/seed/match16/220/280" alt="Mamta Rana, 28" width="220" height="280" loading="lazy" class="profile-card-img" />
            <span class="profile-card-verified-badge"><i data-lucide="shield-check" width="12" height="12"></i></span>
            <div class="profile-card-actions">
              <button class="pca-btn like" aria-label="Like Mamta Rana"><i data-lucide="heart" width="16" height="16"></i></button>
              <button class="pca-btn interest" aria-label="Send interest to Mamta Rana"><i data-lucide="user-plus" width="16" height="16"></i></button>
            </div>
          </div>
          <div class="profile-card-body">
            <h3 class="profile-card-name">Mamta Rana <i data-lucide="shield-check" width="13" height="13" class="verified-icon"></i></h3>
            <p class="profile-card-meta"><i data-lucide="map-pin" width="12" height="12"></i> Baddi, HP</p>
            <p class="profile-card-meta"><i data-lucide="briefcase" width="12" height="12"></i> Engineer • 28 yrs</p>
            <div class="profile-card-tags">
              <span class="pct">Hindu</span>
              <span class="pct">5'5"</span>
              <span class="pct">B.E</span>
            </div>
          </div>
        </article>
      </div>
    </section>

    <!-- Who Viewed My Profile -->
    <section class="profile-row-section container-xxl" aria-label="Who Viewed My Profile">
      <div class="section-header">
        <div class="section-title-group">
          <h2 class="section-title">Who Viewed My Profile</h2>
        </div>
        <a href="#" class="section-view-all">View All <i data-lucide="arrow-right" width="14" height="14"></i></a>
      </div>
      <div class="profile-scroll-track" role="list">
        <article class="profile-card blurred-unlock" role="listitem" tabindex="0">
          <div class="profile-card-img-wrap">
            <img src="https://picsum.photos/seed/match17/220/280" alt="Hidden Profile" width="220" height="280" loading="lazy" class="profile-card-img blurred" />
            <div class="blur-overlay">
              <i data-lucide="lock" width="24" height="24"></i>
              <span>Upgrade to Reveal</span>
            </div>
          </div>
          <div class="profile-card-body">
            <h3 class="profile-card-name blurred-name">●●●●● ●●●●●</h3>
            <p class="profile-card-meta">Viewed your profile <strong>2h ago</strong></p>
          </div>
        </article>
        <article class="profile-card" role="listitem" tabindex="0">
          <div class="profile-card-img-wrap">
            <img src="https://picsum.photos/seed/match18/220/280" alt="Divya Mehta, 27" width="220" height="280" loading="lazy" class="profile-card-img" />
            <div class="profile-card-actions">
              <button class="pca-btn like" aria-label="Like Divya Mehta"><i data-lucide="heart" width="16" height="16"></i></button>
              <button class="pca-btn interest" aria-label="Send interest to Divya Mehta"><i data-lucide="user-plus" width="16" height="16"></i></button>
            </div>
          </div>
          <div class="profile-card-body">
            <h3 class="profile-card-name">Divya Mehta</h3>
            <p class="profile-card-meta"><i data-lucide="map-pin" width="12" height="12"></i> Paonta Sahib</p>
            <p class="profile-card-meta"><i data-lucide="briefcase" width="12" height="12"></i> Designer • 27 yrs</p>
            <div class="profile-card-tags">
              <span class="pct">Hindu</span>
              <span class="pct">5'3"</span>
            </div>
          </div>
        </article>
        <article class="profile-card" role="listitem" tabindex="0">
          <div class="profile-card-img-wrap">
            <img src="https://picsum.photos/seed/match19/220/280" alt="Kiran Bala, 26" width="220" height="280" loading="lazy" class="profile-card-img" />
            <div class="profile-card-actions">
              <button class="pca-btn like" aria-label="Like Kiran Bala"><i data-lucide="heart" width="16" height="16"></i></button>
              <button class="pca-btn interest" aria-label="Send interest to Kiran Bala"><i data-lucide="user-plus" width="16" height="16"></i></button>
            </div>
          </div>
          <div class="profile-card-body">
            <h3 class="profile-card-name">Kiran Bala</h3>
            <p class="profile-card-meta"><i data-lucide="map-pin" width="12" height="12"></i> Nahan, HP</p>
            <p class="profile-card-meta"><i data-lucide="briefcase" width="12" height="12"></i> Dietitian • 26 yrs</p>
            <div class="profile-card-tags">
              <span class="pct">Hindu</span>
              <span class="pct">5'2"</span>
            </div>
          </div>
        </article>
        <article class="profile-card" role="listitem" tabindex="0">
          <div class="profile-card-img-wrap">
            <img src="https://picsum.photos/seed/match20/220/280" alt="Sangeeta, 28" width="220" height="280" loading="lazy" class="profile-card-img" />
            <div class="profile-card-actions">
              <button class="pca-btn like" aria-label="Like Sangeeta"><i data-lucide="heart" width="16" height="16"></i></button>
              <button class="pca-btn interest" aria-label="Send interest to Sangeeta"><i data-lucide="user-plus" width="16" height="16"></i></button>
            </div>
          </div>
          <div class="profile-card-body">
            <h3 class="profile-card-name">Sangeeta</h3>
            <p class="profile-card-meta"><i data-lucide="map-pin" width="12" height="12"></i> Rampur, HP</p>
            <p class="profile-card-meta"><i data-lucide="briefcase" width="12" height="12"></i> Lecturer • 28 yrs</p>
            <div class="profile-card-tags">
              <span class="pct">Hindu</span>
              <span class="pct">5'4"</span>
            </div>
          </div>
        </article>
      </div>
    </section>

    <!-- Shortlisted Profiles -->
    <section class="profile-row-section container-xxl" aria-label="Shortlisted Profiles">
      <div class="section-header">
        <div class="section-title-group">
          <h2 class="section-title">Shortlisted Profiles</h2>
          <span class="section-badge gold"><i data-lucide="bookmark" width="11" height="11"></i> Saved</span>
        </div>
        <a href="#" class="section-view-all">View All <i data-lucide="arrow-right" width="14" height="14"></i></a>
      </div>
      <div class="profile-scroll-track" role="list">
        <article class="profile-card" role="listitem" tabindex="0">
          <div class="profile-card-img-wrap">
            <img src="https://picsum.photos/seed/match21/220/280" alt="Anita Sharma, 26" width="220" height="280" loading="lazy" class="profile-card-img" />
            <span class="profile-card-shortlist-icon" aria-hidden="true"><i data-lucide="bookmark" width="14" height="14"></i></span>
            <div class="profile-card-actions">
              <button class="pca-btn like" aria-label="Like Anita Sharma"><i data-lucide="heart" width="16" height="16"></i></button>
              <button class="pca-btn interest" aria-label="Send interest to Anita Sharma"><i data-lucide="user-plus" width="16" height="16"></i></button>
            </div>
          </div>
          <div class="profile-card-body">
            <h3 class="profile-card-name">Anita Sharma</h3>
            <p class="profile-card-meta"><i data-lucide="map-pin" width="12" height="12"></i> Shimla, HP</p>
            <p class="profile-card-meta"><i data-lucide="briefcase" width="12" height="12"></i> Banker • 26 yrs</p>
            <div class="profile-card-tags">
              <span class="pct">Hindu</span>
              <span class="pct">5'3"</span>
              <span class="pct">MBA</span>
            </div>
          </div>
        </article>
        <article class="profile-card" role="listitem" tabindex="0">
          <div class="profile-card-img-wrap">
            <img src="https://picsum.photos/seed/match22/220/280" alt="Asha Kumari, 25" width="220" height="280" loading="lazy" class="profile-card-img" />
            <span class="profile-card-shortlist-icon" aria-hidden="true"><i data-lucide="bookmark" width="14" height="14"></i></span>
            <div class="profile-card-actions">
              <button class="pca-btn like" aria-label="Like Asha Kumari"><i data-lucide="heart" width="16" height="16"></i></button>
              <button class="pca-btn interest" aria-label="Send interest to Asha Kumari"><i data-lucide="user-plus" width="16" height="16"></i></button>
            </div>
          </div>
          <div class="profile-card-body">
            <h3 class="profile-card-name">Asha Kumari</h3>
            <p class="profile-card-meta"><i data-lucide="map-pin" width="12" height="12"></i> Solan, HP</p>
            <p class="profile-card-meta"><i data-lucide="briefcase" width="12" height="12"></i> Entrepreneur • 25 yrs</p>
            <div class="profile-card-tags">
              <span class="pct">Hindu</span>
              <span class="pct">5'4"</span>
              <span class="pct">BBA</span>
            </div>
          </div>
        </article>
        <article class="profile-card" role="listitem" tabindex="0">
          <div class="profile-card-img-wrap">
            <img src="https://picsum.photos/seed/match23/220/280" alt="Renu Pathak, 27" width="220" height="280" loading="lazy" class="profile-card-img" />
            <span class="profile-card-shortlist-icon" aria-hidden="true"><i data-lucide="bookmark" width="14" height="14"></i></span>
            <div class="profile-card-actions">
              <button class="pca-btn like" aria-label="Like Renu Pathak"><i data-lucide="heart" width="16" height="16"></i></button>
              <button class="pca-btn interest" aria-label="Send interest to Renu Pathak"><i data-lucide="user-plus" width="16" height="16"></i></button>
            </div>
          </div>
          <div class="profile-card-body">
            <h3 class="profile-card-name">Renu Pathak</h3>
            <p class="profile-card-meta"><i data-lucide="map-pin" width="12" height="12"></i> Mandi, HP</p>
            <p class="profile-card-meta"><i data-lucide="briefcase" width="12" height="12"></i> Teacher • 27 yrs</p>
            <div class="profile-card-tags">
              <span class="pct">Hindu</span>
              <span class="pct">5'3"</span>
              <span class="pct">B.Ed</span>
            </div>
          </div>
        </article>
      </div>
    </section>

    <!-- UPGRADE BANNER -->
    <section class="upgrade-banner-section container-xxl" aria-label="Upgrade membership">
      <div class="upgrade-banner">
        <div class="upgrade-banner-text">
          <h3 class="upgrade-title">Unlock Full Access</h3>
          <p>See who liked you, view contact numbers, and get priority matching with a premium plan.</p>
        </div>
        <div class="upgrade-banner-actions">
          <a href="#" class="btn-upgrade">View Plans</a>
        </div>
      </div>
    </section>

@endsection
