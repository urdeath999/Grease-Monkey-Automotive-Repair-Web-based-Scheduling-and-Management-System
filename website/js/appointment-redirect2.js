document.getElementById('appointmentForm').addEventListener('submit', function (e) {
    e.preventDefault(); 

    console.log('Form submitted');
    
    fetch('submit-appointment.php', {
        method: 'POST',
        body: new FormData(this)
    })
    .then(response => {
        console.log('Response:', response); // Log the raw response
        return response.json();
    })
    .then(data => {
        console.log('Data:', data); // Log the parsed data
        if (data.status === 'error') {
            alert(data.message);
            window.location.href = 'users.php'; 
        } else {
            alert('Appointment submitted successfully!');
            closeModal();  
        }
    })
    .catch(error => console.error('Error:', error));
});
