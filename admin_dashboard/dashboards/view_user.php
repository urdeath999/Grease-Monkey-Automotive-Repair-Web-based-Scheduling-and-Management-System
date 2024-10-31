<?php
session_start();
require '../config.php';

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    $query = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        $_SESSION['message'] = "User not found.";
        header("Location: users.php");
        exit();
    }
} else {
    $_SESSION['message'] = "No user selected.";
    header("Location: users.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dashh.css">
    <title>View User</title>
</head>
<body>

<section class="main">
    <div class="container">
        <h2>User Details</h2>
        <div class="user-details">
            <p><strong>ID:</strong> <?= $user['id']; ?></p>
            <p><strong>Name:</strong> <?= $user['full_name']; ?></p>
            <p><strong>Email:</strong> <?= $user['email']; ?></p>
            <p><strong>Phone:</strong> <?= $user['phone']; ?></p>
            <p><strong>Address:</strong> <?= $user['address']; ?></p>
            <p><strong>Status:</strong> <?= isset($user['status']) ? $user['status'] : 'Active'; ?></p>
        </div>
        <a href="users.php" class="btn btn-secondary">Back to Users</a>
    </div>
</section>

</body>
</html>
