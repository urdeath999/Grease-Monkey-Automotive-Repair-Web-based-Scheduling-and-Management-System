<?php
include 'config.php';
session_start(); 

if (!isset($_SESSION['username'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in.']);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = trim($_POST['first_name']);
    $lastName = trim($_POST['last_name']);
    $appointmentDate = $_POST['appointment_date'];
    $appointmentTime = $_POST['appointment_time'];
    $serviceType = trim($_POST['service_type']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid email format']);
        exit();
    }

    if (!preg_match('/^\(?\d{4}\)?[\s\-]?\d{3}[\s\-]?\d{4}$/', $phone)) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid phone number format. Example: (0916) 220-0068']);
        exit();
    }

    $currentDate = date("Y-m-d");
    if ($appointmentDate < $currentDate) {
        echo json_encode(['status' => 'error', 'message' => 'Appointment date cannot be in the past']);
        exit();
    }

    $openingTime = "09:00";
    $closingTime = "18:00";
    $appointmentTime24 = date("H:i", strtotime($appointmentTime));

    if ($appointmentTime24 < $openingTime || $appointmentTime24 > $closingTime) {
        echo json_encode(['status' => 'error', 'message' => 'Appointment time must be between 9:00 AM and 6:00 PM']);
        exit();
    }

    if (empty($firstName) || empty($lastName) || empty($appointmentDate) || empty($appointmentTime) || empty($serviceType) || empty($phone) || empty($email)) {
        echo json_encode(['status' => 'error', 'message' => 'Please fill in all required fields']);
        exit();
    }

    $sql = "INSERT INTO appointments (first_name, last_name, appointment_date, appointment_time, service_type, phone, email) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $response = [];

    if ($stmt) {
        $stmt->bind_param("sssssss", $firstName, $lastName, $appointmentDate, $appointmentTime, $serviceType, $phone, $email);
        if ($stmt->execute()) {
            $response = ['status' => 'success', 'message' => 'Appointment booked successfully!'];
        } else {
            $response = ['status' => 'error', 'message' => 'Error: ' . $stmt->error];
        }
    } else {
        $response = ['status' => 'error', 'message' => 'Error: Could not prepare the SQL statement.'];
    }

    echo json_encode($response);

    $stmt->close();
    $conn->close();
}
?>
