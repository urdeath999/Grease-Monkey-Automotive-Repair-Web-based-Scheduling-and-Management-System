<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: users.php'); 
    exit();
}

include 'config.php';

$username = $_SESSION['username'];

$sql_user = "SELECT email, full_name, phone, address, email_notifications, sms_notifications FROM users WHERE username = ?";
$stmt_user = $conn->prepare($sql_user);
if ($stmt_user) {
    $stmt_user->bind_param('s', $username);
    $stmt_user->execute();
    $result_user = $stmt_user->get_result();

    if ($result_user->num_rows > 0) {
        $user_data = $result_user->fetch_assoc();
        $user_email = $user_data['email'];
    } else {
        echo "Error: No user found with this username.";
        exit();
    }
} else {
    echo "Error: Could not prepare the SQL statement.";
    exit();
}

$sql_history = "SELECT service_type, appointment_date, appointment_time FROM appointments WHERE email = ? AND appointment_date < CURDATE()";
$stmt_history = $conn->prepare($sql_history);
if ($stmt_history) {
    $stmt_history->bind_param('s', $user_email);
    $stmt_history->execute();
    $result_history = $stmt_history->get_result();
    $completed_services = $result_history->fetch_all(MYSQLI_ASSOC);
} else {
    echo "Error: Could not prepare the SQL statement for service history.";
    exit();
}


$sql_status = "SELECT service_type, appointment_date, appointment_time FROM appointments WHERE email = ? AND appointment_date >= CURDATE()";
$stmt_status = $conn->prepare($sql_status);
if ($stmt_status) {
    $stmt_status->bind_param('s', $user_email);
    $stmt_status->execute();
    $result_status = $stmt_status->get_result();
    $ongoing_services = $result_status->fetch_all(MYSQLI_ASSOC);
} else {
    echo "Error: Could not prepare the SQL statement for ongoing services.";
    exit();
}

$sql_loyalty = "SELECT COUNT(id) AS service_count FROM appointments WHERE email = ? AND appointment_date < CURDATE()";
$stmt_loyalty = $conn->prepare($sql_loyalty);
if ($stmt_loyalty) {
    $stmt_loyalty->bind_param('s', $user_email);
    $stmt_loyalty->execute();
    $result_loyalty = $stmt_loyalty->get_result();
    $loyalty_data = $result_loyalty->fetch_assoc();
    $completed_service_count = $loyalty_data['service_count'];

    $next_discount = ($completed_service_count >= 5) ? 'You earned another 5% discount!' : 'Complete ' . (5 - $completed_service_count) . ' more services to earn a 5% discount!';
} else {
    echo "Error: Could not prepare the SQL statement for loyalty program.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Settings</title>
    <link rel="icon" href="images/logo.png" type="image/x-icon">
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">
    <link href="css/account.css" rel="stylesheet">
    <link href="css/offer.css" rel="stylesheet">
    <link href="css/nav-header.css" rel="stylesheet">
    <link href="css/footer.css" rel="stylesheet">
</head>
<body>
<header>
    <nav class="navbar">
        <div class="logo">
            <a href="main.php">
                <img src="images/logo.png" alt="Grease Monkey Logo" class="logo-image">
            </a>
            <span class="logo-text">Grease <span class="highlight">Monkey</span></span>
        </div>
        <div class="hamburger" onclick="toggleNav()">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <ul class="nav-links" id="nav-links">
            <li><a href="main.php">Home</a></li>
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropdown-toggle" onclick="toggleDropdown(event)">
                    Services <i class="fas fa-chevron-down chevron-icon"></i>
                </a>
                <ul class="dropdown-menu" id="services-dropdown">
                    <li><a href="services/change-oil.php">Change Oil</a></li>
                    <li><a href="services/abs-module.php">ABS Module Repair</a></li>
                    <li><a href="services/engine-repair.php">Engine Repair</a></li>
                    <li><a href="services/transmission.php">Transmission Repair</a></li>
                </ul>
            </li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="faq.php">FAQ</a></li>
            <li><a href="about-us.php">About Us</a></li>
        </ul>

        <?php if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true): ?>
            <a href="users.php" class="auth-btn" id="auth-btn">
                <span class="btn-sign-in">Sign In</span>
            </a>
        <?php endif; ?> 
    </nav>
    <section class="offer-banner">
        <div class="offer-content">
            <h2>Get 5% Off!</h2>
            <p>First-time customers enjoy a 5% discount on their first service.</p>
        </div>
    </section>
</header>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-3">
            <div class="sidebar">
                <h4>Account Settings</h4>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0);" onclick="showSection('general-settings')">
                            <i class="fas fa-cog"></i> General Settings
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0);" onclick="showSection('change-password')">
                            <i class="fas fa-key"></i> Change Password
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0);" onclick="showSection('service-history')">
                            <i class="fas fa-history"></i> Service History
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0);" onclick="showSection('repair-status')">
                            <i class="fas fa-tools"></i> Ongoing Repairs
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0);" onclick="showSection('loyalty-status')">
                            <i class="fas fa-gift"></i> Loyalty Program
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-md-9">
            <!-- General Settings Section -->
            <div id="general-settings" class="general-settings" style="display:none;">
                <h3>General Settings</h3>
                <form action="update-settings.php" method="POST">
                    <div class="form-group">
                        <label for="full_name">Full Name</label>
                        <input type="text" class="form-control custom-input" id="full_name" name="full_name" value="<?php echo htmlspecialchars($user_data['full_name'] ?? ''); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control custom-input" id="email" name="email" value="<?php echo htmlspecialchars($user_email); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control custom-input" id="phone" name="phone" value="<?php echo htmlspecialchars($user_data['phone'] ?? ''); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control custom-input" id="address" name="address" value="<?php echo htmlspecialchars($user_data['address'] ?? ''); ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>

            <div id="change-password" class="change-password" style="display:none;">
                <h3>Change Password</h3>
                <form action="update-password.php" method="POST">
                    <div class="form-group">
                        <label for="current_password">Current Password</label>
                        <input type="password" class="form-control custom-input" id="current_password" name="current_password" required>
                    </div>
                    <div class="form-group">
                        <label for="new_password">New Password</label>
                        <input type="password" class="form-control custom-input" id="new_password" name="new_password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Change Password</button>
                </form>
            </div>

            <div id="service-history" class="service-history" style="display:none;">
                <h3>Service History</h3>
                <?php if (count($completed_services) > 0): ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Service Type</th>
                                <th>Appointment Date</th>
                                <th>Appointment Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($completed_services as $service): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($service['service_type']); ?></td>
                                    <td><?php echo htmlspecialchars($service['appointment_date']); ?></td>
                                    <td><?php echo htmlspecialchars($service['appointment_time']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>No completed services found.</p>
                <?php endif; ?>
            </div>

            <div id="repair-status" class="repair-status" style="display:none;">
                <h3>Ongoing Repairs</h3>
                <?php if (count($ongoing_services) > 0): ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Service Type</th>
                                <th>Appointment Date</th>
                                <th>Appointment Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($ongoing_services as $service): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($service['service_type']); ?></td>
                                    <td><?php echo htmlspecialchars($service['appointment_date']); ?></td>
                                    <td><?php echo htmlspecialchars($service['appointment_time']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>No ongoing repairs found.</p>
                <?php endif; ?>
            </div>

            <div id="loyalty-status" class="loyalty-status" style="display:none;">
                <h3>Loyalty Program</h3>
                <p><?php echo htmlspecialchars($next_discount); ?></p>
            </div>
        </div>
    </div>
</div>

<footer class="footer-container">
    <div class="footer-content">
        <div class="footer-left">
            <div class="footer-logo-container">
                <img src="images/logo.png" alt="Grease Monkey Logo" class="footer-logo">
                <span class="footer-logo-text">
                    <span class="footer-logo-grease">Grease</span> 
                    <span class="footer-logo-monkey">Monkey</span>
                </span>
            </div>
            <p class="footer-description">
                Grease Monkey Automotive Repair is dedicated to providing quality repair services above all.
            </p>
            <div class="footer-social">
                <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-youtube"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
            </div>
        </div>

        <div class="footer-center">
            <h3>Links</h3>
            <ul>
                <li><a href="main.php">Home</a></li>
                <li><a href="about-us.php">About Us</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="faq.php">FAQ</a></li>
                <li><a href="privacy-policy.php">Privacy Policy</a></li>
            </ul>
        </div>

        <div class="footer-right">
            <h3>Services</h3>
            <ul>
                <li><a href="services/change-oil.php">Oil Change</a></li>
                <li><a href="services/abs-module.php">ABS Module Repair</a></li>
                <li><a href="services/engine-repair.php">Engine Repair</a></li>
                <li><a href="services/transmission.php">Transmission Repair</a></li>
            </ul>
        </div>

        <div class="footer-account <?php echo isset($_SESSION['username']) ? 'visible' : ''; ?>"> 
            <h3>Account</h3>
            <ul>
            <li>
                <?php if (isset($_SESSION['username'])): ?>
                    <span class="welcome-message">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</span>
                <?php else: ?>
                    <span class="welcome-message">Welcome, Guest!</span>
                <?php endif; ?>
            </li>
        
            <?php if (isset($_SESSION['username'])): ?>
                <li><a href="account.php">Profile</a></li>
                <li><a href="logout.php">Sign Out</a></li>
            <?php endif; ?>
            </ul>
        </div>
    </div>

    <div class="footer-copyright">
        <p>© 2024 Grease Monkey. All rights reserved</p>
    </div>
</footer>
<script>
    function showSection(sectionId) {
        document.querySelectorAll('.general-settings, .change-password, .service-history, .repair-status, .loyalty-status').forEach(section => {
            section.style.display = 'none';
        });

        const selectedSection = document.getElementById(sectionId);
        selectedSection.style.display = 'block';

        document.querySelector('.sidebar').style.display = 'none';

        let backButton = selectedSection.querySelector('.back-button');
        if (!backButton) {
            backButton = document.createElement('button');
            backButton.innerHTML = 'Back to Settings';
            backButton.className = 'btn btn-secondary back-button';
            backButton.onclick = function() {
                selectedSection.style.display = 'none';
                document.querySelector('.sidebar').style.display = 'block';
            };
            
            selectedSection.prepend(backButton);
        }
    }

    function toggleNav() {
        const navLinks = document.getElementById('nav-links');
        navLinks.classList.toggle('active');
    }

    function toggleDropdown(event) {
        const dropdownMenu = document.getElementById('services-dropdown');
        dropdownMenu.classList.toggle('show');
        event.stopPropagation(); 
    }

    document.addEventListener('click', function() {
        const dropdownMenu = document.getElementById('services-dropdown');
        if (dropdownMenu.classList.contains('show')) {
            dropdownMenu.classList.remove('show');
        }
    });
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/password-toogle.js"></script>
    <script src="js/hamburger.js"></script>
    <script src="js/testimonial.js"></script>
</body>
</html>

