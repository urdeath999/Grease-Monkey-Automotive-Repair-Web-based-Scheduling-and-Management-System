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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications - Grease Monkey</title>
    <link rel="stylesheet" href="dashh.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
</head>
<body>
<section class="header">
    <div class="logo">
        <i class="ri-menu-line icon icon-0 menu"></i>
        <h2>Grease <span>Monkey</span></h2>
    </div>
    <div class="search--notification--profile">
        <div class="search">
            <input type="text" id="searchInput" placeholder="Search Schedule..">
            <button><i class="ri-search-2-line"></i></button>
        </div>
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
                <h2 class="section--title">Notifications</h2>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Message</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $query = "SELECT * FROM notifications ORDER BY created_at DESC";
                                    $query_run = mysqli_query($conn, $query);

                                    if (mysqli_num_rows($query_run) > 0) {
                                        foreach ($query_run as $notification) {
                                            ?>
                                            <tr>
                                                <td><?= $notification['id']; ?></td>
                                                <td><?= $notification['message']; ?></td>
                                                <td><?= $notification['type']; ?></td>
                                                <td><?= $notification['status']; ?></td>
                                                <td><?= $notification['created_at']; ?></td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='5'>No Notifications Found</td></tr>";
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="board.js"></script>
<script src="search.js"></script>
</body>
</html>
