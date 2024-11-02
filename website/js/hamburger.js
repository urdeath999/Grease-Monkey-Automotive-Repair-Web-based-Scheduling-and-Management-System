function toggleNav() {
    const navLinks = document.querySelector('.nav-links');
    navLinks.classList.toggle('active');
}

function toggleDropdown(event) {
    const dropdown = event.currentTarget.parentNode; 
    event.preventDefault(); 
    dropdown.classList.toggle('active'); 
}