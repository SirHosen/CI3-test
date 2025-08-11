// Auto logout after inactivity
let inactivityTimer;
const INACTIVITY_TIMEOUT = 30 * 60 * 1000; // 30 menit

function resetInactivityTimer() {
    clearTimeout(inactivityTimer);
    inactivityTimer = setTimeout(() => {
        alert('Session expired due to inactivity');
        window.location.href = '/ci3-app/logout';
    }, INACTIVITY_TIMEOUT);
}

// Reset timer on user activity
document.addEventListener('mousemove', resetInactivityTimer);
document.addEventListener('keypress', resetInactivityTimer);
document.addEventListener('click', resetInactivityTimer);
document.addEventListener('scroll', resetInactivityTimer);

// Initialize timer
resetInactivityTimer();

// AJAX check username availability
function checkUsername(username) {
    fetch('/ci3-app/api/check-username', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ username: username })
    })
    .then(response => response.json())
    .then(data => {
        if (data.available) {
            document.getElementById('username-feedback').innerHTML = '<span class="text-success">Username available</span>';
        } else {
            document.getElementById('username-feedback').innerHTML = '<span class="text-danger">Username already taken</span>';
        }
    });
}
