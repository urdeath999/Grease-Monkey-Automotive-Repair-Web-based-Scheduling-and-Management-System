const passwordToggles = document.querySelectorAll('.password-toggle');

passwordToggles.forEach(toggle => {
    toggle.addEventListener('click', function () {
        const passwordField = this.previousElementSibling;

        if (passwordField.type === "password") {
            passwordField.type = "text";
            this.querySelector('i').classList.remove("fa-eye");
            this.querySelector('i').classList.add("fa-eye-slash");
        } else {
            passwordField.type = "password";
            this.querySelector('i').classList.remove("fa-eye-slash");
            this.querySelector('i').classList.add("fa-eye");
        }
    });
});

function toggleNav() {
    const navLinks = document.getElementById('nav-links');
    navLinks.classList.toggle('active');
}

function showSection(sectionId) {
    const sections = ['general-settings', 'change-password', 'service-history', 'repair-status', 'loyalty-status'];
    sections.forEach(id => document.getElementById(id).style.display = 'none');

    document.getElementById(sectionId).style.display = 'block';
}
