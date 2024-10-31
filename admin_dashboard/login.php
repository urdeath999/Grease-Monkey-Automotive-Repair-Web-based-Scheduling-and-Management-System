<?php
// Start session
session_start();
require 'config.php';

// Check if form is submitted
if (isset($_POST['signIn'])) {
    // Sanitize email and password
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Check if the fields are not empty
    if (!empty($email) && !empty($password)) {
        // Fetch user from the database
        $sql = "SELECT * FROM admin_users WHERE email = '$email'";
        $result = $conn->query($sql);

        // Check if user exists
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Verify the password
            if (password_verify($password, $user['password'])) {
                // Password is correct, authenticate the user
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['email'] = $user['email'];

                // Redirect to the dashboard or any other protected page
                header("Location: dashboards/dash.php");
                exit();
            } else {
                // Incorrect password
                echo "<p style='color: red;'>Incorrect password!</p>";
            }
        } else {
            // User not found
            echo "<p style='color: red;'>No account found with that email!</p>";
        }
    } else {
        // Fields are empty
        echo "<p style='color: red;'>Please fill in both email and password fields.</p>";
    }
}

// Close connection
$conn->close();
?>
