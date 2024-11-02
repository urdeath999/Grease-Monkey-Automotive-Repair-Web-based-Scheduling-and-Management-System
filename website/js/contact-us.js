(function() {
    emailjs.init("juWSlMGY5tMFnAtzWWqej"); 
})();

document.getElementById('contact-form').addEventListener('submit', function(event) {
    event.preventDefault();

    // Collect form data
    const firstName = event.target.firstName.value.trim();
    const lastName = event.target.lastName.value.trim();
    const email = event.target.email.value.trim();
    const message = event.target.message.value.trim();

    // Validation
    if (!firstName || !lastName || !email || !message) {
        alert('Please fill out all fields.');
        return;
    }

    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
        alert('Please enter a valid email address.');
        return;
    }

    // Send email
    emailjs.send("service_59t0qik", "template_lmux7xv", {
        firstName: firstName,
        lastName: lastName,
        email: email,
        message: message
    })
    .then(function(response) {
        console.log('SUCCESS!', response.status, response.text);
        alert('Message sent successfully!');
    }, function(error) {
        console.log('FAILED...', error);
        alert('Failed to send message. Please try again later.');
    });
});
