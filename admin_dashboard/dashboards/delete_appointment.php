<?php
// Start the session to access session variables (if necessary)
session_start();

// Include your database connection file
require '../config.php'; // Update with your actual file

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_appointment'])) {
    // Get the appointment ID from the POST data
    $appointment_id = $_POST['appointment_id'];

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("DELETE FROM appointments WHERE id = ?");
    $stmt->bind_param("i", $appointment_id);

    // Execute the statement
    if ($stmt->execute()) {
        // Success message
        $_SESSION['message'] = "Appointment canceled successfully.";
    } else {
        // Error message
        $_SESSION['message'] = "Error deleting appointment: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    // If not a POST request or 'delete_appointment' is not set
    $_SESSION['message'] = "Invalid request.";
}

// Redirect back to the appointments page or wherever necessary
header("Location: appointments.php"); // Update with your actual redirect
exit();
?>
