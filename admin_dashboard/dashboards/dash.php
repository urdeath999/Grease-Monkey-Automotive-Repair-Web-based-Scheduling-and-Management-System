<?php
session_start();
require '../config.php';
$current_page = basename($_SERVER['PHP_SELF']); // This will return the current file name, e.g., "dash.php"
if (!isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit();
}

$sqlTechnicians = "SELECT COUNT(*) as total FROM admin_users WHERE role='technician'";
$sqlUsers = "SELECT COUNT(*) as total FROM users";
$sqlAppointments = "SELECT COUNT(*) as total FROM appointments WHERE status='Ongoing'";
$sqlAvailableTechnicians = "SELECT COUNT(*) as total FROM admin_users WHERE role='technician' AND status='available'";

// Execute the queries
$resultTechnicians = $conn->query($sqlTechnicians);
$resultUsers = $conn->query($sqlUsers);
$resultAppointments = $conn->query($sqlAppointments);
$resultAvailableTechnicians = $conn->query($sqlAvailableTechnicians);

// Fetch the results
$totalTechnicians = $resultTechnicians->fetch_assoc()['total'];
$totalUsers = $resultUsers->fetch_assoc()['total'];
$totalAppointments = $resultAppointments->fetch_assoc()['total'];
$availableTechnicians = $resultAvailableTechnicians->fetch_assoc()['total'];
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
                <div class="title">
                    <h2 class="section--title">Overview</h2>
                    <select name="date" id="date" class="dropdown">
                        <option value="today">Today</option>
                        <option value="lastweek">Last Week</option>
                        <option value="lastmonth">Last Month</option>
                        <option value="lastyear">Last Year</option>
                        <option value="alltime">All Time</option>
                    </select>
                </div>
                <div class="cards">
                    <div class="card card-1">
                        <div class="card--data">
                            <div class="card--content">
                                <h5 class="card--title">Total Technician</h5>
                                <h1><?php echo $totalTechnicians; ?></h1>
                            </div>
                            <i class="ri-user-2-line card--icon--lg"></i>
                        </div>
                        <div class="card--stats">
                            <span><i class="ri-bar-chart-fill card--icon stat--icon"></i>65%</span>
                            <span><i class="ri-arrow-up-s-fill card--icon up--arrow"></i>10</span>
                            <span><i class="ri-arrow-down-s-fill card--icon down--arrow"></i>2</span>
                        </div>
                    </div>
                    <div class="card card-2">
                        <div class="card--data">
                            <div class="card--content">
                                <h5 class="card--title">Users</h5>
                                <h1><?php echo $totalUsers; ?></h1>
                            </div>
                            <i class="ri-user-line card--icon--lg"></i>
                        </div>
                        <div class="card--stats">
                            <span><i class="ri-bar-chart-fill card--icon stat--icon"></i>82%</span>
                            <span><i class="ri-arrow-up-s-fill card--icon up--arrow"></i>230</span>
                            <span><i class="ri-arrow-down-s-fill card--icon down--arrow"></i>45</span>
                        </div>
                    </div>
                    <div class="card card-3">
                        <div class="card--data">
                            <div class="card--content">
                                <h5 class="card--title">Confirmed Appointments</h5>
                                <h1><?php echo $totalAppointments; ?></h1>
                            </div>
                            <i class="ri-calendar-2-line card--icon--lg"></i>
                        </div>
                        <div class="card--stats">
                            <span><i class="ri-bar-chart-fill card--icon stat--icon"></i>27%</span>
                            <span><i class="ri-arrow-up-s-fill card--icon up--arrow"></i>31</span>
                            <span><i class="ri-arrow-down-s-fill card--icon down--arrow"></i>23</span>
                        </div>
                    </div>
                    <div class="card card-4">
                        <div class="card--data">
                            <div class="card--content">
                                <h5 class="card--title">Technician Available</h5>
                                <h1><?php echo $availableTechnicians; ?></h1>
                        </div>
                            <i class="ri-user-2-line card--icon--lg"></i>
                        </div>
                        <div class="card--stats">
                            <span><i class="ri-bar-chart-fill card--icon stat--icon"></i>8%</span>
                            <span><i class="ri-arrow-up-s-fill card--icon up--arrow"></i>11</span>
                            <span><i class="ri-arrow-down-s-fill card--icon down--arrow"></i>2</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="doctors">
                <div class="title">
                    <h2 class="section--title">Technician</h2>
                    <div class="doctors--right--btns">
                        <select name="date" id="date" class="dropdown doctor--filter">
                            <option>Filter</option>
                            <option value="free">Free</option>
                            <option value="scheduled">Scheduled</option>
                        </select>
                    </div>
                </div>
                <div class="doctors--cards">
                    <a href="#" class="doctor--card">
                        <div class="img--box--cover">
                            <div class="img--box">
                                <img src="m1.png" alt="">
                            </div>
                        </div>
                    </a>
                    <a href="#" class="doctor--card">
                        <div class="img--box--cover">
                            <div class="img--box">
                                <img src="m2.png" alt="">
                            </div>
                        </div>
                    </a>
                    <a href="#" class="doctor--card">
                        <div class="img--box--cover">
                            <div class="img--box">
                                <img src="m3.png" alt="">
                            </div>
                        </div>
                    </a>
                    <a href="#" class="doctor--card">
                        <div class="img--box--cover">
                            <div class="img--box">
                                <img src="tech4.jpg" alt="">
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="recent--patients">
    <div class="title">
        <h2 class="section--title">Confirmed Appointments</h2>
        <button class="add"><i class="ri-add-line"></i>Add Technician</button>
    </div>
    <div class="table">
        <table>
            <thead>
                <tr>
                    <th>Contact No.</th>
                    <th>Vehicle Details</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Pagination setup
                $limit = 5; // Number of results per page
                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Get current page number from URL, default to 1
                $offset = ($page - 1) * $limit; // Calculate offset for SQL query

                // Get total number of records
                $total_query = "SELECT COUNT(*) as total FROM appointments WHERE status='Ongoing'";
                $total_result = mysqli_query($conn, $total_query);
                $total_row = mysqli_fetch_assoc($total_result);
                $total_records = $total_row['total'];
                $total_pages = ceil($total_records / $limit); // Calculate total pages

                // Fetch appointments for current page, including contact_no, vehicle_details, and appointment_time
                $query = "SELECT phone, vehicle_details, appointment_date, appointment_time FROM appointments WHERE status='Ongoing' LIMIT $limit OFFSET $offset";
                $query_run = mysqli_query($conn, $query);

                if (mysqli_num_rows($query_run) > 0) {
                    foreach ($query_run as $appointment) {
                        ?>
                        <tr>
                            <td><?= htmlspecialchars($appointment['phone']); ?></td>
                            <td><?= htmlspecialchars($appointment['vehicle_details']); ?></td>
                            <td><?= htmlspecialchars($appointment['appointment_date']); ?></td>
                            <td><?= htmlspecialchars($appointment['appointment_time']); ?></td>
                            <td class="confirmed">Confirmed</td>
                        </tr>
                    <?php
                    }
                } else {
                    echo "<tr><td colspan='5'>No appointments</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="pagination">
        <?php if ($total_pages > 1): ?>
            <nav>
                <ul class="pagination">
                    <?php if ($page > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?= $page - 1; ?>">Previous</a>
                        </li>
                    <?php endif; ?>
                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <li class="page-item <?= ($i === $page) ? 'active' : ''; ?>">
                            <a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a>
                        </li>
                    <?php endfor; ?>
                    <?php if ($page < $total_pages): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?= $page + 1; ?>">Next</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        <?php endif; ?>
    </div>
</div>
        <script src="board.js"></script>
        <script src="search.js"></script>
    </body>
</html>
