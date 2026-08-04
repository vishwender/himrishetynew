const profileSearchModal = document.getElementById('profileSearchModal');

document.getElementById('openProfileSearch').onclick = () => {

    profileSearchModal.classList.add('show');

    document.getElementById('profileSearchInput').focus();

}

document.getElementById('closeProfileSearch').onclick = () => {

    profileSearchModal.classList.remove('show');

}

const searchInput = document.getElementById('profileSearchInput');

let timer;

searchInput.addEventListener('keyup', function(){

    clearTimeout(timer);

    timer = setTimeout(function(){

        searchProfiles(searchInput.value);

    },300);

});

function searchProfiles(keyword) {

    if (keyword.length < 2) {
        document.getElementById('profileSearchResults').innerHTML =
            '<div class="search-empty">Start typing to search...</div>';
        return;
    }

    fetch(`search-home-profile?keyword=${encodeURIComponent(keyword)}`)
        .then(response => response.json())
        .then(data => {

            let html = '';

            if (data.length === 0) {

                html = `
                    <div class="search-empty">
                        No profiles found.
                    </div>
                `;

            } else {

                data.forEach(profile => {

                    html += `
                        <a href="/view-profile/${profile.profile_id}" class="search-item">

                            <img src="${profile.photo}" alt="${profile.full_name}">

                            <div class="search-details">

                                <h4>${profile.full_name}</h4>

                                <p>${profile.profile_id}</p>

                            </div>

                        </a>
                    `;

                });

            }

            document.getElementById('profileSearchResults').innerHTML = html;

        });

}