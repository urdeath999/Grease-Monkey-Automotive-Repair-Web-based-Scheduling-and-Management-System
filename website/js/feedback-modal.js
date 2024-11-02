function openFeedbackModal(serviceType, appointmentDate) {
    // Fill in hidden form fields with the service details
    document.getElementById('service_type').value = serviceType;
    document.getElementById('appointment_date').value = appointmentDate;

    // Open the modal
    $('#feedbackModal').modal('show');
}

document.addEventListener('DOMContentLoaded', () => {
    const stars = document.querySelectorAll('.star-rating .star');
    const ratingInput = document.getElementById('rating');

    stars.forEach((star, index) => {
      star.addEventListener('click', () => {
        const rating = parseInt(star.getAttribute('data-value'), 10);
        ratingInput.value = rating;
        
        // Highlight stars up to and including the selected rating
        stars.forEach((s, i) => {
          s.classList.toggle('selected', i < rating);
        });
      });

      // Highlight stars on hover
      star.addEventListener('mouseover', () => {
        const hoverRating = parseInt(star.getAttribute('data-value'), 10);
        stars.forEach((s, i) => {
          s.classList.toggle('selected', i < hoverRating);
        });
      });

      // Reset stars on mouseout if no rating is selected
      star.addEventListener('mouseout', () => {
        const currentRating = parseInt(ratingInput.value, 10);
        stars.forEach((s, i) => {
          s.classList.toggle('selected', i < currentRating);
        });
      });
    });
  });

