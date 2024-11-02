const newPasswordInput = document.querySelector('#new_password');
const confirmPasswordInput = document.querySelector('#confirm_password');
const strengthText = document.querySelector('#strengthText');
const bar = document.querySelector('#bar');
const passwordMismatch = document.querySelector('#passwordMismatch');
const passwordTooShort = document.querySelector('#passwordTooShort');

newPasswordInput.addEventListener('input', function () {
    const password = newPasswordInput.value;

    if (password.length < 8) {
        passwordTooShort.textContent = "Password must be at least 8 characters long.";
        bar.style.width = '0%';
        strengthText.textContent = '';
    } else {
        passwordTooShort.textContent = '';
        const strength = checkPasswordStrength(password);
        updateStrengthBar(strength);
    }
});

confirmPasswordInput.addEventListener('input', function () {
    const newPassword = newPasswordInput.value;
    const confirmPassword = confirmPasswordInput.value;

    if (newPassword !== confirmPassword) {
        passwordMismatch.textContent = "Passwords do not match.";
    } else {
        passwordMismatch.textContent = "";
    }
});

// Function to check password strength
function checkPasswordStrength(password) {
    let strength = 0;

    if (password.length >= 8) strength++;

    if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength++;

    if (/\d/.test(password)) strength++;

    if (/[!@#$%^&*(),.?":{}|<>]/.test(password)) strength++;

    return strength;
}

function updateStrengthBar(strength) {
    let strengthColor;
    let strengthWidth;
    let strengthMsg;

    switch (strength) {
        case 0:
            strengthWidth = '0%';
            strengthColor = 'red';
            strengthMsg = '';
            break;
        case 1:
            strengthWidth = '25%';
            strengthColor = 'red';
            strengthMsg = 'Very Weak';
            break;
        case 2:
            strengthWidth = '50%';
            strengthColor = 'orange';
            strengthMsg = 'Weak';
            break;
        case 3:
            strengthWidth = '75%';
            strengthColor = 'yellow';
            strengthMsg = 'Moderate';
            break;
        case 4:
            strengthWidth = '100%';
            strengthColor = 'green';
            strengthMsg = 'Strong';
            break;
        default:
            strengthWidth = '0%';
            strengthColor = 'red';
            strengthMsg = '';
    }

    bar.style.width = strengthWidth;
    bar.style.backgroundColor = strengthColor;

    strengthText.textContent = strengthMsg;
}
