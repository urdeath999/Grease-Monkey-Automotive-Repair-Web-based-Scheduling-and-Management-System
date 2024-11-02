<?php 
include 'config.php';
session_start();

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password']; 

    // Fetch user data, including id
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?"); // Select id as well
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc(); 
        if (password_verify($password, $user['password'])) {
            // Store user details in session
            $_SESSION['user_logged_in'] = true; 
            $_SESSION['username'] = $username; 
            $_SESSION['user_id'] = $user['id']; // Store the existing user ID in session
            header("Location: main.php"); 
            exit();
        } else {
            echo "Incorrect username or password!";
        }
    } else {
        echo "Incorrect username or password!";
    }
}
?>
