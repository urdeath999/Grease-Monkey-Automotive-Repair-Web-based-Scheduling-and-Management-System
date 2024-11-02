<?php
include 'config.php';
session_start(); 

if (!isset($_SESSION['username'])) {
    echo json_encode(['status' => 'error', 'message' => 'You must log in to submit an appointment.']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $service_type = $_POST['service_type'];
    $appointment_date = $_POST['appointment_date'];
    $feedback = $_POST['feedback'];
    $user_email = $_SESSION['email'];

    // Insert feedback into the database
    $sql = "INSERT INTO feedback (user_email, service_type, appointment_date, feedback) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param('ssss', $user_email, $service_type, $appointment_date, $feedback);
        if ($stmt->execute()) {
            $_SESSION['message'] = 'Thank you for your feedback!';
        } else {
            $_SESSION['message'] = 'Error submitting feedback. Please try again.';
        }
    } else {
        $_SESSION['message'] = 'Error preparing SQL statement.';
    }

    header('Location: account.php');
    exit();
}
