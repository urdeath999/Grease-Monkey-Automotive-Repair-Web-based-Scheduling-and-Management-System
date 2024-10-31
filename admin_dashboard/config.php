<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "grease_monkey"; // Change this if you create a separate database for admin

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    echo "Failed to connect DB: " . $conn->connect_error;
}
?>