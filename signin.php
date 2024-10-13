<?php 
include 'config.php';
session_start();

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password']; 

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc(); 
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_logged_in'] = true; 
            $_SESSION['username'] = $username; 
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
