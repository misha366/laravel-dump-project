import './bootstrap';
// bootstrap
import '../css/import.bootstrap.css';
import 'bootstrap';

// bootstrap icons
// npm install bootstrap-icons
import 'bootstrap-icons/font/bootstrap-icons.css';

import '../css/style.css';

// preloader
window.addEventListener('load', function () {
    document.getElementById('preloader').remove(); 
    document.querySelector('.page').style.display = 'block';
});

// Remove empty parameters from url
function removeEmptyGetParams() {
    const url = new URL(window.location.href);
    const params = new URLSearchParams(url.search);

    const keysToRemove = [];
    for (const [key, value] of params.entries()) {
        if (value === "") {
            keysToRemove.push(key);
        }
    }

    keysToRemove.forEach(key => params.delete(key));

    const newUrl = url.pathname + (params.toString() ? `?${params}` : "");
    window.history.replaceState(null, "", newUrl);
}

removeEmptyGetParams();

// Two Factor Challenge toggler
document.addEventListener('DOMContentLoaded', function () {
    const toggleButton = document.getElementById('toggle-recovery');
    const authCodeGroup = document.getElementById('auth-code-group');
    const recoveryCodeGroup = document.getElementById('recovery-code-group');
    const authText = document.getElementById('auth-text');

    let usingRecoveryCode = false;

    toggleButton.addEventListener('click', function () {
        usingRecoveryCode = !usingRecoveryCode;
        authCodeGroup.classList.toggle('d-none', usingRecoveryCode);
        recoveryCodeGroup.classList.toggle('d-none', !usingRecoveryCode);

        toggleButton.textContent = usingRecoveryCode
            ? 'Use an authentication code'
            : 'Use a recovery code';

        authText.textContent = usingRecoveryCode
            ? 'Please confirm access to your account by entering one of your emergency recovery codes.'
            : 'Please confirm access to your account by entering the authentication code provided by your authenticator application.';
    });
});