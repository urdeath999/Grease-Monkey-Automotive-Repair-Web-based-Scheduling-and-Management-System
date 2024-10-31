<?php
session_start();
require '../config.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit();
}

// Check if the confirm button is clicked
if (isset($_POST['confirm_appointment'])) {
    $appointment_id = $_POST['appointment_id'];

    // Update the appointment status to confirmed
    $query = "UPDATE appointments SET status='Ongoing' WHERE id=?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $appointment_id);
    
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['message'] = "Appointment confirmed successfully.";
    } else {
        $_SESSION['message'] = "Failed to confirm appointment.";
    }

    mysqli_stmt_close($stmt);
    header('Location: dash.php');
    exit();
} else {
    header('Location: dash.php');
    exit();
}
?>
