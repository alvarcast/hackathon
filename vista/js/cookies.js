document.addEventListener('DOMContentLoaded', () => {
    const cookieModal = new bootstrap.Modal(document.getElementById('cookieModal'));
    const acceptAllBtn = document.getElementById('acceptAllCookies');
    const savePreferencesBtn = document.getElementById('savePreferences');

    // Comprueba si ya se guardaron las preferencias de cookies
    const cookiePreferences = JSON.parse(localStorage.getItem('cookiePreferences'));

    if (!cookiePreferences) {
        cookieModal.show();
    }

    acceptAllBtn.addEventListener('click', () => {
        const preferences = {
            essential: true,
            analytics: true,
            marketing: true,
        };
        localStorage.setItem('cookiePreferences', JSON.stringify(preferences));
        cookieModal.hide();
    });

    savePreferencesBtn.addEventListener('click', () => {
        const preferences = {
            essential: true,
            analytics: document.getElementById('analyticsCookies').checked,
            marketing: document.getElementById('marketingCookies').checked,
        };
        localStorage.setItem('cookiePreferences', JSON.stringify(preferences));
        cookieModal.hide();
    });
});