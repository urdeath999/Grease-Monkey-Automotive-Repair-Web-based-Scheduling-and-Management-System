<?php 
include 'config.php';
session_start();

if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password']; 

    // Check if email already exists
    $checkEmail = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $checkEmail->bind_param("s", $email);
    $checkEmail->execute();
    $emailResult = $checkEmail->get_result();

    // Check if username already exists
    $checkUsername = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $checkUsername->bind_param("s", $username);
    $checkUsername->execute();
    $usernameResult = $checkUsername->get_result();

    if ($emailResult->num_rows > 0) {
        echo "Email already exists!";
    } elseif ($usernameResult->num_rows > 0) {
        echo "Username already exists!";
    } else {
        // Hash the password before inserting
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert user into the `users` table
        $insertQuery = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $insertQuery->bind_param("sss", $username, $email, $hashed_password);

        if ($insertQuery->execute()) {
            // Get the ID of the newly inserted user
            $user_id = $conn->insert_id;

            // Log the user in by setting session variables
            $_SESSION['user_logged_in'] = true; 
            $_SESSION['username'] = $username; 
            $_SESSION['user_id'] = $user_id; // Store user ID in session
            
            // Insert notification for new user registration
            $insertNotification = $conn->prepare("INSERT INTO notifications (message, type, user_id, status) VALUES (?, ?, ?, ?)");
            $message = "New user registered: " . $username;
            $type = "user_registration"; // Type of notification
            $status = "unread"; // Initially set to unread
            $insertNotification->bind_param("ssis", $message, $type, $user_id, $status);

            if ($insertNotification->execute()) {
                // Redirect to users.php after inserting notification
                header("Location: users.php"); 
            } else {
                echo "Error inserting notification: " . $insertNotification->error;
            }

            // Close the notification query
            $insertNotification->close();
        } else {
            echo "Error: " . $insertQuery->error; 
        }
    }

    // Close prepared statements
    $checkEmail->close();
    $checkUsername->close();
    $insertQuery->close();
}

$conn->close(); 
?>
