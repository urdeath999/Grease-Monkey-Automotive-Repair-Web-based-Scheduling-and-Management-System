document.getElementById('appointmentForm').addEventListener('submit', function (e) {
    e.preventDefault(); 

    fetch('../submit-appointment.php', {
        method: 'POST',
        body: new FormData(this)
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'error') {
            alert(data.message);
            window.location.href = '../users.php';  
        } else {
            alert('Appointment submitted successfully!');
            closeModal();  
        }
    })
    .catch(error => console.error('Error:', error));
});

