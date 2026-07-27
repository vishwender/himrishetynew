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

        @forelse($data['matching_profiles'] as $profile)

        @include('dashboard.partials.profile-card', [
        'profile' => $profile,
        'match' => true
        ])

        @empty

        <article class="profile-card" role="listitem">
            <div class="profile-card-body">
                <h3 class="profile-card-name">
                    No matching profiles found.
                </h3>

                <p class="profile-card-meta">
                    Try updating your partner preferences to see more matches.
                </p>
            </div>
        </article>

        @endforelse

    </div>
    </div>
</section>