<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: users.php'); 
    exit();
}

include 'config.php';

$username = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    $sql = "SELECT password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if (password_verify($current_password, $user['password'])) {
            if ($new_password === $confirm_password) {
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

                $sql_update = "UPDATE users SET password = ? WHERE username = ?";
                $stmt_update = $conn->prepare($sql_update);
                if ($stmt_update) {
                    $stmt_update->bind_param('ss', $hashed_password, $username);
                    if ($stmt_update->execute()) {
                        header('Location: account.php?success=Password updated successfully');
                    } else {
                        echo "Error: Could not update the password.";
                    }
                }
            } else {
                echo "Error: New passwords do not match.";
            }
        } else {
            echo "Error: Current password is incorrect.";
        }
    } else {
        echo "Error: Could not prepare the SQL statement.";
    }
}
?>
