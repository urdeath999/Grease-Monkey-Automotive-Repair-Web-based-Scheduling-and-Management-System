<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: users.php'); 
    exit();
}

include 'config.php';

$username = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $email_notifications = isset($_POST['email_notifications']) ? 1 : 0;
    $sms_notifications = isset($_POST['sms_notifications']) ? 1 : 0;

    $sql = "UPDATE users SET full_name = ?, email = ?, phone = ?, address = ?, email_notifications = ?, sms_notifications = ? WHERE username = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param('sssssss', $full_name, $email, $phone, $address, $email_notifications, $sms_notifications, $username);
        if ($stmt->execute()) {
            header('Location: account.php?success=Settings updated successfully');
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Error: Could not prepare the SQL statement.";
    }
}
?>
