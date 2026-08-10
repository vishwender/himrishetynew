const callbackBtn = document.getElementById('callbackBtn');
const timer = document.getElementById('timer');

let countdown = null;

callbackBtn.addEventListener('click', async function () {

    // Prevent multiple requests while timer is running
    if (countdown) {
        return;
    }

    const button = this;
    const url = button.dataset.url;

    const csrfToken = document.querySelector(
        'meta[name="csrf-token"]'
    )?.getAttribute('content');

    // Disable button while API request is being made
    button.disabled = true;
    button.innerHTML = 'Sending...';

    try {

        /*
        |--------------------------------------------------------------------------
        | Send callback request to Laravel
        |--------------------------------------------------------------------------
        */

        const response = await fetch(url, {
            method: 'POST',

            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            }
        });

        const data = await response.json();

        console.log('Callback API response:', data);

        /*
        |--------------------------------------------------------------------------
        | Check API response
        |--------------------------------------------------------------------------
        */

        if (!response.ok || data.status !== 'success') {
            throw new Error(
                data.message || 'Unable to send callback request.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | API successful
        | Start 10 minute timer
        |--------------------------------------------------------------------------
        */

        alert(data.message);

        button.innerHTML = 'Callback Requested';

        let timeLeft = 10 * 60; // 10 minutes

        updateTimer();

        countdown = setInterval(function () {

            timeLeft--;

            updateTimer();

            if (timeLeft <= 0) {

                clearInterval(countdown);

                countdown = null;

                button.disabled = false;
                button.innerHTML = 'Request a Callback';

                timer.innerHTML = '00:00';
            }

        }, 1000);


        function updateTimer() {

            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;

            timer.innerHTML =
                String(minutes).padStart(2, '0') + ':' +
                String(seconds).padStart(2, '0');
        }

    } catch (error) {

        /*
        |--------------------------------------------------------------------------
        | API failed
        |--------------------------------------------------------------------------
        */

        console.error('Callback request error:', error);

        alert(
            error.message ||
            'Unable to request callback.'
        );

        // Allow user to try again
        button.disabled = false;
        button.innerHTML = 'Request a Callback';

    }

});