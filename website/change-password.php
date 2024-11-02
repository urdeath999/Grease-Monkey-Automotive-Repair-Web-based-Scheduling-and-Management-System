<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: users.php'); 
    exit();
}

include 'config.php';

$username = $_SESSION['username'];

// Initialize message variable
$message = ''; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Prepare SQL to get the current user's password
    $sql = "SELECT password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user) {
            // Verify current password
            if (password_verify($current_password, $user['password'])) {
                // Check if new passwords match
                if ($new_password === $confirm_password) {
                    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

                    // Prepare SQL to update the password
                    $sql_update = "UPDATE users SET password = ? WHERE username = ?";
                    $stmt_update = $conn->prepare($sql_update);
                    if ($stmt_update) {
                        $stmt_update->bind_param('ss', $hashed_password, $username);
                        if ($stmt_update->execute()) {
                            // Set success message in session
                            $_SESSION['message'] = 'Success: Password updated successfully.';
                            header('Location: account.php'); // Redirect to account page
                            exit();
                        } else {
                            $_SESSION['message'] = 'Error: Could not update the password.';
                        }
                    } else {
                        $_SESSION['message'] = 'Error: Could not prepare the SQL statement for update.';
                    }
                } else {
                    $_SESSION['message'] = 'Error: New passwords do not match.';
                }
            } else {
                $_SESSION['message'] = 'Error: Current password is incorrect.';
            }
        } else {
            $_SESSION['message'] = 'Error: User not found.';
        }
    } else {
        $_SESSION['message'] = 'Error: Could not prepare the SQL statement.';
    }
}
?>
