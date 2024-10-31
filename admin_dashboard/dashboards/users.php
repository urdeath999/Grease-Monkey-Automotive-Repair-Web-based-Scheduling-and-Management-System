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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dashh.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <title>Dashboard</title>
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
                <h2 class="section--title">Users</h2>
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
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Number</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
    <?php
    $query = "SELECT * FROM users";
    $query_run = mysqli_query($conn, $query);

    if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $user) {
            ?>
            <tr>
                <td><?= $user['id']; ?></td>
                <td><?= isset($user['full_name']) ? $user['full_name'] : 'N/A'; ?></td> 
                <td><?= isset($user['email']) ? $user['email'] : 'N/A'; ?></td>
                <td><?= isset($user['phone']) ? $user['phone'] : 'N/A'; ?></td> 
                <td>
    <div class="dropdown">
        <button class="kebab-icon" onclick="toggleDropdown(event)">
            <i class="ri-more-2-line"></i>
        </button>
        <div class="dropdown-content">
            <button onclick="viewUser(
                '<?= $user['id']; ?>', 
                '<?= $user['username']; ?>', 
                '<?= $user['full_name']; ?>', 
                '<?= $user['email']; ?>', 
                '<?= $user['password']; ?>', 
                '<?= $user['address']; ?>', 
                '<?= $user['email_notifications']; ?>', 
                '<?= $user['sms_notifications']; ?>', 
                '<?= $user['status']; ?>')">View</button>
            <form action="suspend.php" method="post" style="display:inline;">
                <button type="suspend" name="suspend_user" value="<?= $user['id']; ?>">Suspend</button>
            </form>
            <form action="delete-user.php" method="post" style="display:inline;">
                <button type="delete" name="delete_user" value="<?= $user['id']; ?>">Delete</button>
            </form>
        </div>
    </div>
</td>
            </tr>
            <?php
        }
    } else {
        echo "<h3>No Record Found</h3>";
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
<div id="userModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>User Details</h2>
        <p><strong>ID:</strong> <span id="user-id"></span></p>
        <p><strong>Username:</strong> <span id="user-username"></span></p>
        <p><strong>Full Name:</strong> <span id="user-full_name"></span></p>
        <p><strong>Email:</strong> <span id="user-email"></span></p>
        <p><strong>Password:</strong> <span id="user-password"></span></p>
        <p><strong>Address:</strong> <span id="user-address"></span></p>
        <p><strong>Email Notifications:</strong> <span id="user-email_notifications"></span></p>
        <p><strong>SMS Notifications:</strong> <span id="user-sms_notifications"></span></p>
        <p><strong>Status:</strong> <span id="user-status"></span></p>
    </div>
</div>


<script>
function toggleDropdown(event) {
    const dropdown = event.currentTarget.nextElementSibling;
    dropdown.style.display = (dropdown.style.display === 'block') ? 'none' : 'block';
}
// Get the modal
var modal = document.getElementById("userModal");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// Function to open the modal and set user data
function viewUser(id, username, full_name, email, password, address, email_notifications, sms_notifications, status) {
    document.getElementById("user-id").innerText = id;
    document.getElementById("user-username").innerText = username;
    document.getElementById("user-full_name").innerText = full_name;
    document.getElementById("user-email").innerText = email;
    document.getElementById("user-password").innerText = password;
    document.getElementById("user-address").innerText = address;
    document.getElementById("user-email_notifications").innerText = email_notifications;
    document.getElementById("user-sms_notifications").innerText = sms_notifications;
    document.getElementById("user-status").innerText = status;
    
    modal.style.display = "block";
}


span.onclick = function() {
    modal.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
<script src="board.js"></script>
<script src="search.js"></script>
</body>
</html>
