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
