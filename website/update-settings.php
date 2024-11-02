<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: users.php'); 
    exit();
}

include 'config.php';

$username = $_SESSION['username'];
$message = '';

// Fetch current email for comparison
$currentEmailQuery = "SELECT email FROM users WHERE username = ?";
$currentEmailStmt = $conn->prepare($currentEmailQuery);
$currentEmailStmt->bind_param('s', $username);
$currentEmailStmt->execute();
$currentEmailResult = $currentEmailStmt->get_result();
$currentEmailRow = $currentEmailResult->fetch_assoc();
$currentEmail = $currentEmailRow['email'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $email_notifications = isset($_POST['email_notifications']) ? 1 : 0;
    $sms_notifications = isset($_POST['sms_notifications']) ? 1 : 0;

    // Check if the email has changed
    if ($currentEmail !== $email) {
        $emailCheckQuery = "SELECT COUNT(*) FROM users WHERE email = ? AND username != ?";
        $emailCheckStmt = $conn->prepare($emailCheckQuery);
        $emailCheckStmt->bind_param('ss', $email, $username);
        $emailCheckStmt->execute();
        $emailCheckStmt->bind_result($emailCount);
        $emailCheckStmt->fetch();
        $emailCheckStmt->close();

        if ($emailCount > 0) {
            // Set session message for error
            $_SESSION['message'] = "Email is already taken.";
            header('Location: account.php'); 
            exit();
        }
    }

    // Prepare SQL to update user settings
    $sql = "UPDATE users SET full_name = ?, email = ?, address = ?, email_notifications = ?, sms_notifications = ? WHERE username = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param('ssssss', $full_name, $email, $address, $email_notifications, $sms_notifications, $username);
        if ($stmt->execute()) {
            $_SESSION['message'] = 'Settings updated successfully.'; 
            header('Location: account.php');
            exit();
        } else {
            $_SESSION['message'] = "Error: " . $stmt->error;
        }
    } else {
        $_SESSION['message'] = "Error: Could not prepare the SQL statement.";
    }
}
?>
