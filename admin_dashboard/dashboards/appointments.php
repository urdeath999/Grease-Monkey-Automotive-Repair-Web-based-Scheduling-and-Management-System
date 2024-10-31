<?php 
session_start();
require '../config.php';
$current_page = basename($_SERVER['PHP_SELF']); // Current file name

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../index.php'); // Redirect to login if not logged in
    exit();
}

$user_id = $_SESSION['user_id'];

// Query to fetch the user's role
$query = "SELECT role FROM admin_users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if the user exists in the admin_users table
if ($result->num_rows === 0) {
    // User not found, handle this case appropriately
    header('Location: ../index.php'); // Redirect to login or error page
    exit();
}

// Fetch the user's role
$user = $result->fetch_assoc();

// Redirect technicians to dash.php
if ($user['role'] === 'technician') {
    header('Location: dash.php'); 
    exit(); 
}


// Pagination Logic
$limit = 5; // Number of appointments per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Fetch pending appointments with pagination
$query = "SELECT id, phone, vehicle_details, appointment_date, appointment_time FROM appointments WHERE status = 'Pending' LIMIT ? OFFSET ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('ii', $limit, $offset);
$stmt->execute();
$query_run = $stmt->get_result();

// Fetch the total number of pending appointments for pagination
$total_query = "SELECT COUNT(*) as total FROM appointments WHERE status = 'Pending'";
$total_result = mysqli_fetch_assoc(mysqli_query($conn, $total_query));
$total_appointments = $total_result['total'];
$total_pages = ceil($total_appointments / $limit);

// Fetch ongoing repairs with pagination
$ongoing_query = "SELECT id, phone, vehicle_details, appointment_date, appointment_time FROM appointments WHERE status = 'Ongoing' LIMIT ? OFFSET ?";
$stmt = $conn->prepare($ongoing_query);
$stmt->bind_param('ii', $limit, $offset);
$stmt->execute();
$ongoing_query_run = $stmt->get_result();

// Fetch the total number of ongoing repairs for pagination
$total_ongoing_query = "SELECT COUNT(*) as total FROM appointments WHERE status = 'Ongoing'";
$total_ongoing_result = mysqli_fetch_assoc(mysqli_query($conn, $total_ongoing_query));
$total_ongoing_appointments = $total_ongoing_result['total'];
$total_ongoing_pages = ceil($total_ongoing_appointments / $limit);

// Fetch completed appointments with pagination
$completed_query = "SELECT id, phone, vehicle_details, appointment_date, appointment_time FROM appointments WHERE status = 'Completed' LIMIT ? OFFSET ?";
$stmt = $conn->prepare($completed_query);
$stmt->bind_param('ii', $limit, $offset);
$stmt->execute();
$completed_query_run = $stmt->get_result();

// Fetch the total number of completed appointments for pagination
$total_completed_query = "SELECT COUNT(*) as total FROM appointments WHERE status = 'Completed'";
$total_completed_result = mysqli_fetch_assoc(mysqli_query($conn, $total_completed_query));
$total_completed_appointments = $total_completed_result['total'];
$total_completed_pages = ceil($total_completed_appointments / $limit);
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
    <!-- Pending Appointments Section -->
    <div class="recent--patients">
        <div class="title">
            <h2 class="section--title">Pending Appointments</h2>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Phone</th>
                                        <th>Vehicle Details</th>
                                        <th>Appointment Date</th> 
                                        <th>Appointment Time</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($query_run->num_rows > 0) {
                                        while ($appointment = $query_run->fetch_assoc()) {
                                    ?>
                                            <tr>
                                                <td><?= htmlspecialchars($appointment['phone']); ?></td>
                                                <td><?= htmlspecialchars($appointment['vehicle_details']); ?></td>
                                                <td><?= htmlspecialchars($appointment['appointment_date']); ?></td>
                                                <td><?= htmlspecialchars($appointment['appointment_time']); ?></td>
                                                <td>
                                                    <form action="delete_appointment.php" method="post" class="d-inline">
                                                        <input type="hidden" name="appointment_id" value="<?= $appointment['id']; ?>">
                                                        <button type="submit" name="delete_appointment" class="btn delete">
                                                            <i class="ri-delete-bin-5-line"></i> Cancel
                                                        </button>
                                                    </form>
                                                    <form action="confirm_appointment.php" method="post" class="d-inline">
                                                        <input type="hidden" name="appointment_id" value="<?= $appointment['id']; ?>">
                                                        <button type="submit" name="confirm_appointment" class="btn confirm">
                                                            <i class="ri-check-line"></i> Confirm
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='5'>No appointments found</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <!-- Pagination Controls -->
                            <nav>
                                <ul class="pagination">
                                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                        <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                                            <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                                        </li>
                                    <?php endfor; ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Ongoing Repairs Section -->
    <div class="recent--patients">
        <div class="title">
            <h2 class="section--title">Ongoing Repairs</h2>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Phone</th>
                                        <th>Vehicle Details</th>
                                        <th>Appointment Date</th>
                                        <th>Appointment Time</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($ongoing_query_run->num_rows > 0) {
                                        while ($ongoing_appointment = $ongoing_query_run->fetch_assoc()) {
                                    ?>
                                            <tr>
                                                <td><?= htmlspecialchars($ongoing_appointment['phone']); ?></td>
                                                <td><?= htmlspecialchars($ongoing_appointment['vehicle_details']); ?></td>
                                                <td><?= htmlspecialchars($ongoing_appointment['appointment_date']); ?></td>
                                                <td><?= htmlspecialchars($ongoing_appointment['appointment_time']); ?></td>
                                                <td>
                                                    <form action="complete_appointment.php" method="post" class="d-inline">
                                                        <input type="hidden" name="appointment_id" value="<?= $ongoing_appointment['id']; ?>">
                                                        <button type="submit" name="complete_appointment" class="btn complete">
                                                            <i class="ri-check-double-line"></i> Complete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='5'>No ongoing repairs found</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <!-- Pagination Controls -->
                            <nav>
                                <ul class="pagination">
                                    <?php for ($i = 1; $i <= $total_ongoing_pages; $i++): ?>
                                        <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                                            <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                                        </li>
                                    <?php endfor; ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Completed Appointments Section -->
    <div class="recent--patients">
        <div class="title">
            <h2 class="section--title">Completed Appointments</h2>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Phone</th>
                                        <th>Vehicle Details</th>
                                        <th>Appointment Date</th>
                                        <th>Appointment Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($completed_query_run->num_rows > 0) {
                                        while ($completed_appointment = $completed_query_run->fetch_assoc()) {
                                    ?>
                                            <tr>
                                                <td><?= htmlspecialchars($completed_appointment['phone']); ?></td>
                                                <td><?= htmlspecialchars($completed_appointment['vehicle_details']); ?></td>
                                                <td><?= htmlspecialchars($completed_appointment['appointment_date']); ?></td>
                                                <td><?= htmlspecialchars($completed_appointment['appointment_time']); ?></td>
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='4'>No completed appointments found</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <!-- Pagination Controls -->
                            <nav>
                                <ul class="pagination">
                                    <?php for ($i = 1; $i <= $total_completed_pages; $i++): ?>
                                        <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                                            <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                                        </li>
                                    <?php endfor; ?>
                                </ul>
                            </nav>
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