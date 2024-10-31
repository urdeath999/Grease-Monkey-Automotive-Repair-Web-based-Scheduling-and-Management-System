<?php
session_start();
require '../config.php';
$current_page = basename($_SERVER['PHP_SELF']); // Current file name

if (!isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$query = "SELECT role FROM admin_users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user['role'] === 'technician') {
    header('Location: dash.php'); 
    exit(); 
}

// Fetch admin details from the database
$user_id = $_SESSION['user_id'];
$sql = "SELECT username, email FROM admin_users WHERE id = ?";
$stmt = $conn->prepare($sql);

// Check if the statement preparation was successful
if (!$stmt) {
    die("Error preparing statement: " . $conn->error);
}

// Bind the user ID as an integer
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$admin = $result->fetch_assoc(); // Fetch admin data into associative array

// Check if the admin data was retrieved successfully
if (!$admin) {
    die("No admin data found for user ID: " . $user_id);
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings - Grease Monkey</title>
    <link rel="stylesheet" href="dashh.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
</head>
<body>
<section class="header">
    <div class="logo">
        <i class="ri-menu-line icon icon-0 menu"></i>
        <h2>Grease <span>Monkey</span></h2>
    </div>
</section>
    
    <section class="main">
    <div class="sidebar">
        <ul class="sidebar--items">
            <li>
                <a href="dash.php" <?php if($current_page == 'dash.php'){ echo 'id="active--link"'; } ?>>
                    <span class="icon icon-1"><i class="ri-layout-grid-line"></i></span>
                    <span class="sidebar--item">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="appointments.php" <?php if($current_page == 'appointments.php'){ echo 'id="active--link"'; } ?>>
                    <span class="icon icon-2"><i class="ri-calendar-2-line"></i></span>
                    <span class="sidebar--item">Appointment</span>
                </a>
            </li>
            <li>
                <a href="users.php" <?php if($current_page == 'users.php'){ echo 'id="active--link"'; } ?>>
                    <span class="icon icon-3"><i class="ri-user-2-line"></i></span>
                    <span class="sidebar--item">Users</span>
                </a>
            </li>
            <li>
                <a href="notification.php" <?php if($current_page == 'notification.php'){ echo 'id="active--link"'; } ?>>
                    <span class="icon icon-4"><i class="ri-notification-2-line"></i></span>
                    <span class="sidebar--item">Notification</span>
                </a>
            </li>
        </ul>
        <ul class="sidebar--bottom-items">
            <li>
                <a href="settings.php" <?php if($current_page == 'settings.php'){ echo 'id="active--link"'; } ?>>
                    <span class="icon icon-7"><i class="ri-settings-3-line"></i></span>
                    <span class="sidebar--item">Settings</span>
                </a>
            </li>
            <li>
                <a href="../logout.php">
                    <span class="icon icon-8"><i class="ri-logout-box-r-line"></i></span>
                    <span class="sidebar--item">Logout</span>
                </a>
            </li>
        </ul>
    </div>
</section>
    <div class="main--content">
        <div class="overview">
            <div class="title"></div>
        </div>
        <div class="recent--patients">
            <div class="title">
                <h2 class="section--title">Admin Settings</h2>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="save_admin_settings.php" method="POST">
                                    <div class="form-group">
                                        <label for="username">Username:</label>
                                        <input type="text" name="username" id="username" class="form-control" value="<?= htmlspecialchars($admin['username']); ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email:</label>
                                        <input type="email" name="email" id="email" class="form-control" value="<?= htmlspecialchars($admin['email']); ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Change Password:</label>
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Enter new password">
                                    </div>

                                    <div class="form-group">
                                        <label for="confirm_password">Confirm New Password:</label>
                                        <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm new password">
                                    </div>

                                    <button type="submit" class="btn btn-primary">Save Settings</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="board.js"></script>
</body>
</html>
