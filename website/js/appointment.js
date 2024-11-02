function openModal() {
    const modal = document.getElementById('appointmentModal');
    modal.style.display = 'flex'; 
}

function closeModal() {
    const modal = document.getElementById('appointmentModal');
    modal.style.display = 'none'; 
    document.getElementById('appointmentForm').reset(); 
}

document.querySelector('.appointment-btn').addEventListener('click', openModal);

window.onclick = function(event) {
    const modal = document.getElementById('appointmentModal');
    if (event.target === modal) {
        modal.style.display = 'none';
    }
};