<!-- Who Viewed My Profile -->
<section class="profile-row-section container-xxl" aria-label="Who Viewed My Profile">
    <div class="section-header">
        <div class="section-title-group">
            <h2 class="section-title">Who Viewed My Profile</h2>
        </div>
        <a href="#" class="section-view-all">View All <i data-lucide="arrow-right" width="14" height="14"></i></a>
    </div>
    <div class="profile-scroll-track" role="list">
        @forelse($viewedMyProfile ?? [] as $profile)
        @include('dashboard.partials.profile-card', ['profile' => $profile])
        @empty
        <article class="profile-card" role="listitem" tabindex="0">
            <div class="profile-card-body">
                <h3 class="profile-card-name">No one has viewed your profile yet.</h3>
                <p class="profile-card-meta">Keep your profile complete to attract more visitors.</p>
            </div>
        </article>
        @endforelse
    </div>
</section>