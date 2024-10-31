<?php
session_start();
require '../config.php'; // Adjust the path if needed

// Check if the delete button was clicked and a user ID was provided
if (isset($_POST['delete_user'])) {
    $user_id = $_POST['delete_user'];

    // Prepare and execute the SQL delete query
    $query = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        // If successful, redirect back to the users page with a success message
        $_SESSION['message'] = "User deleted successfully.";
        $_SESSION['msg_type'] = "success";
    } else {
        // If an error occurs, store an error message in the session
        $_SESSION['message'] = "Failed to delete user.";
        $_SESSION['msg_type'] = "danger";
    }

    $stmt->close();
    $conn->close();
}

// Redirect to the users page
header("Location: users.php");
exit();
?>
