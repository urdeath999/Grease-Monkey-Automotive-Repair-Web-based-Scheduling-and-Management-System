<?php
session_start();
require '../config.php';

if (!isset($_SESSION['admin_id'])) {
    header('Location: ../index.php');
    exit();
}

$admin_id = $_SESSION['admin_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $admin_notifications = $_POST['admin_notifications'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate password change
    if (!empty($password) && $password === $confirm_password) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $update_password_query = "UPDATE admin_users SET password='$hashed_password' WHERE id='$admin_id'";
        mysqli_query($conn, $update_password_query);
    }

    // Update username, email, and notifications
    $update_admin_query = "UPDATE admin_users SET username='$username', email='$email', admin_notifications='$admin_notifications' WHERE id='$admin_id'";
    mysqli_query($conn, $update_admin_query);

    // Redirect back to settings page with success message
    $_SESSION['message'] = "Admin settings updated successfully!";
    header('Location: settings.php');
}
