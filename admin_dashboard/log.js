const signUpButton = document.getElementById('signUpButton');
const signInButton = document.getElementById('signInButton');
const signInForm = document.getElementById('signIn');
const signUpForm = document.getElementById('signup');

// Switch between Sign Up and Sign In forms
signUpButton.addEventListener('click', function () {
    signInForm.style.display = "none";
    signUpForm.style.display = "block";
});

signInButton.addEventListener('click', function () {
    signInForm.style.display = "block";
    signUpForm.style.display = "none";
});

// Toggle password visibility
function togglePassword(id) {
    const input = document.getElementById(id);
    const toggle = input.nextElementSibling;
    const icon = toggle.querySelector('i');

    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
        toggle.classList.add('active');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
        toggle.classList.remove('active');
    }
}

// Form Validation with real-time feedback
const inputs = document.querySelectorAll('input');
inputs.forEach(input => {
    input.addEventListener('input', function () {
        if (input.checkValidity()) {
            input.classList.remove('invalid');
            input.classList.add('valid');
        } else {
            input.classList.remove('valid');
            input.classList.add('invalid');
        }
    });
});

// Password match validation
const password = document.getElementById('password');
const confirmPassword = document.getElementById('confirmPassword');
confirmPassword.addEventListener('input', function () {
    if (password.value !== confirmPassword.value) {
        confirmPassword.classList.remove('valid');
        confirmPassword.classList.add('invalid');
    } else {
        confirmPassword.classList.remove('invalid');
        confirmPassword.classList.add('valid');
    }
});

// Toggle password recovery field
document.getElementById('forgotPasswordLink').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent default anchor behavior
    const recoveryField = document.getElementById('passwordRecovery');
    const sendRecoveryButton = document.getElementById('sendRecoveryEmail');

    // Toggle visibility of recovery field
    const isFieldVisible = recoveryField.style.display === 'block';
    recoveryField.style.display = isFieldVisible ? 'none' : 'block';
    sendRecoveryButton.style.display = isFieldVisible ? 'none' : 'block'; // Show/hide the button
});

// Add functionality to send recovery email
document.getElementById('sendRecoveryEmail').addEventListener('click', function() {
    const recoveryEmail = document.getElementById('recoveryEmail');
    
    // Validate email
    if (!recoveryEmail.checkValidity()) {
        recoveryEmail.focus(); // Focus on the invalid input
        return; // Stop execution if the email is invalid
    }

    // Handle email sending logic here (e.g., AJAX call to your server)
    alert('Recovery email sent to ' + recoveryEmail.value); // Example feedback

    // Clear the input field and hide the recovery input again
    recoveryEmail.value = '';
    document.getElementById('passwordRecovery').style.display = 'none';
    this.style.display = 'none'; // Hide send button
});
    