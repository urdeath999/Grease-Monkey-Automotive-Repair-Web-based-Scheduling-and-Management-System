<?php 
include 'config.php';

if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password']; 

    $checkEmail = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $checkEmail->bind_param("s", $email);
    $checkEmail->execute();
    $result = $checkEmail->get_result();

    if ($result->num_rows > 0) {
        echo "Email already exists!";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $insertQuery = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $insertQuery->bind_param("sss", $username, $email, $hashed_password);

        if ($insertQuery->execute()) {
            header("Location: users.php"); 
        } else {
            echo "Error: " . $insertQuery->error; 
        }
    }

    $checkEmail->close();
    $insertQuery->close();
}

$conn->close(); 
?>
