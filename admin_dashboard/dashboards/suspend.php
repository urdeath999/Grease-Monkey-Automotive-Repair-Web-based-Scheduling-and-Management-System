<?php
session_start();
require '../config.php';

// Check if user ID is set in the POST request
if (isset($_POST['suspend_user'])) {
    $user_id = $_POST['suspend_user'];

    // Update the user's status to 'suspended'
    $query = "UPDATE users SET status = 'suspended' WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        $_SESSION['message'] = "User suspended successfully.";
    } else {
        $_SESSION['message'] = "Failed to suspend user.";
    }

    // Redirect back to the users dashboard
    header("Location: users.php");
    exit();
} else {
    $_SESSION['message'] = "No user selected to suspend.";
    header("Location: users.php");
    exit();
}
?>
