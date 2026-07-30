const callbackBtn = document.getElementById('callbackBtn');
const timer = document.getElementById('timer');

let countdown;

callbackBtn.addEventListener('click', function () {

    if (countdown) return;

    let timeLeft = 10 * 60; // 10 minutes

    callbackBtn.disabled = true;
    callbackBtn.innerHTML = 'Callback Requested';

    updateTimer();

    countdown = setInterval(function () {

        timeLeft--;

        updateTimer();

        if (timeLeft <= 0) {

            clearInterval(countdown);

            countdown = null;

            callbackBtn.disabled = false;
            callbackBtn.innerHTML = 'Request a Callback';

            timer.innerHTML = "00:00";
        }

    }, 1000);

    function updateTimer(){

        const minutes = Math.floor(timeLeft / 60);
        const seconds = timeLeft % 60;

        timer.innerHTML =
            String(minutes).padStart(2,'0') + ":" +
            String(seconds).padStart(2,'0');
    }

});