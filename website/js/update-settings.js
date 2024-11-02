document.querySelector('#account-settings-form').addEventListener('submit', function(e) {
    const phone = document.getElementById('phone').value;
    const email = document.getElementById('email').value;
    const regexPhone = /^\(?\d{4}\)?[-\s]?\d{3}[-\s]?\d{4}$/;
    const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!regexPhone.test(phone)) {
        e.preventDefault();
        alert('Invalid phone number format');
    }

    if (!regexEmail.test(email)) {
        e.preventDefault();
        alert('Invalid email format');
    }
});