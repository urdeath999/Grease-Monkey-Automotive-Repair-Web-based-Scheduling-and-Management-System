<?php
session_start();
if (isset($_POST['login'])) {
    $_SESSION['user_id'] = $userId; 
    $_SESSION['username'] = $username; 
    $_SESSION['user_logged_in'] = true; 
    header('Location: users.php'); 
    exit();
}

include 'config.php';
$message = ''; 
if (isset($_SESSION['message'])) {
    echo "<script>alert('" . htmlspecialchars($_SESSION['message']) . "');</script>";
    unset($_SESSION['message']); 
}

$username = $_SESSION['username'];

// Fetch user data and id
$sql_user = "SELECT id, email, full_name, address, email_notifications, sms_notifications FROM users WHERE username = ?";
$stmt_user = $conn->prepare($sql_user);
if ($stmt_user) {
    $stmt_user->bind_param('s', $username);
    $stmt_user->execute();
    $result_user = $stmt_user->get_result();

    if ($result_user->num_rows > 0) {
        $user_data = $result_user->fetch_assoc();
        $user_email = $user_data['email'];
        $user_id = $user_data['id']; // Store id
    } else {
        echo "Error: No user found with this username.";
        exit();
    }
} else {
    echo "Error: Could not prepare the SQL statement.";
    exit();
}

// Fetch completed services using id
$sql_history = "SELECT service_type, appointment_date, appointment_time FROM appointments WHERE user_id = ? AND status = 'Completed'";
$stmt_history = $conn->prepare($sql_history);
if ($stmt_history) {
    $stmt_history->bind_param('i', $user_id); // Bind id as an integer
    $stmt_history->execute();
    $result_history = $stmt_history->get_result();
    $completed_services = $result_history->fetch_all(MYSQLI_ASSOC);
} else {
    echo "Error: Could not prepare the SQL statement for service history.";
    exit();
}

// Fetch ongoing services using id
$sql_status = "SELECT service_type, appointment_date, appointment_time, status FROM appointments WHERE user_id = ? AND appointment_date >= CURDATE()";
$stmt_status = $conn->prepare($sql_status);
if ($stmt_status) {
    $stmt_status->bind_param('i', $user_id); // Bind id as an integer
    $stmt_status->execute();
    $result_status = $stmt_status->get_result();
    $ongoing_services = $result_status->fetch_all(MYSQLI_ASSOC);
} else {
    echo "Error: Could not prepare the SQL statement for ongoing services.";
    exit();
}

// Fetch loyalty information using id
$sql_loyalty = "SELECT completed_service_count FROM users WHERE id = ?";
$stmt_loyalty = $conn->prepare($sql_loyalty);
if ($stmt_loyalty) {
    $stmt_loyalty->bind_param('i', $user_id); // Bind id as an integer
    $stmt_loyalty->execute();
    $result_loyalty = $stmt_loyalty->get_result();
    $loyalty_data = $result_loyalty->fetch_assoc();
    $completed_service_count = $loyalty_data['completed_service_count'];

    // Determine the tier and next discount message based on new criteria
    if ($completed_service_count < 5) {
        $tier = 1; // Tier 1
        $next_discount = 'Complete ' . (5 - $completed_service_count) . ' more services to earn a 5% discount!';
        $progress = ($completed_service_count / 5) * 100;  // Progress for Tier 1
    } elseif ($completed_service_count < 10) {
        $tier = 1; // Tier 1 for discounts, but now in Tier 2
        $next_discount = 'Complete ' . (10 - $completed_service_count) . ' more services to earn another 5% discount!';
        $progress = (($completed_service_count - 5) / 5) * 100;  // Progress for Tier 2
    } elseif ($completed_service_count < 15) {
        $tier = 2; // Tier 2
        $next_discount = 'Complete ' . (15 - $completed_service_count) . ' more services to earn another 5% discount!';
        $progress = (($completed_service_count - 10) / 5) * 100;  // Progress for Tier 3
    } else {
        $tier = 3; // Tier 3
        $next_discount = 'You have reached the highest tier!';
        $progress = 100;  // Full progress at Tier 3
    }

} else {
    echo "Error: Could not prepare the SQL statement for loyalty program.";
    exit();
}

// Check if any vouchers exist for the user using id
$sql_voucher = "SELECT code, discount, expiration_date, is_redeemed FROM vouchers WHERE user_id = ? AND is_redeemed = 0";
$stmt_voucher = $conn->prepare($sql_voucher);
if ($stmt_voucher) {
    $stmt_voucher->bind_param('i', $user_id); // Bind id as an integer
    $stmt_voucher->execute();
    $result_voucher = $stmt_voucher->get_result();
    $vouchers = $result_voucher->fetch_all(MYSQLI_ASSOC);
} else {
    echo "Error: Could not prepare the SQL statement for vouchers.";
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
            <li><a href="faq.php">FAQs</a></li>
            <li><a href="about-us.php">About Us</a></li>
        </ul>

        <?php if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true): ?>
            <a href="users.php" class="auth-btn" id="auth-btn">
                <span class="btn-sign-in">Sign In</span>
            </a>
        <?php else: ?>
            <a href="logout.php" class="auth-btn" id="auth-btn">
                <span class="btn-sign-in">Logout</span>
            </a>
        <?php endif; ?>
    </nav>
    <section class="offer-banner">
        <div class="offer-content">
            <h2>Get 5% Off!</h2>
            <p>Earn a 5% discount on your next service after completing 5 repair services!</p>
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
                            <i class="fas fa-cog" style="margin-right: 8px;"></i> General Settings
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0);" onclick="showSection('change-password')">
                            <i class="fas fa-key" style="margin-right: 8px;"></i> Change Password
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0);" onclick="showSection('service-history')">
                            <i class="fas fa-history" style="margin-right: 8px;"></i> Service History
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0);" onclick="showSection('repair-status')">
                            <i class="fas fa-tools" style="margin-right: 8px;"></i> Ongoing Repairs
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0);" onclick="showSection('loyalty-status')">
                            <i class="fas fa-gift" style="margin-right: 8px;"></i> Loyalty Program
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-md-9">
            <div id="general-settings" class="general-settings" style="display:none;">
                <h3>General Settings</h3>
                <form id="account-settings-form" action="update-settings.php" method="POST">
                    <div class="form-group">
                        <label for="full_name">Full Name</label>
                        <input type="text" class="form-control custom-input" id="full_name" name="full_name" value="<?php echo htmlspecialchars($user_data['full_name'] ?? ''); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control custom-input" id="email" name="email" value="<?php echo htmlspecialchars($user_email); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control custom-input" id="address" name="address" value="<?php echo htmlspecialchars($user_data['address'] ?? ''); ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Email Notifications</label>
                        <select name="email_notifications" class="form-control custom-input" required>
                            <option value="1" <?php echo $user_data['email_notifications'] == 1 ? 'selected' : ''; ?>>Enabled</option>
                            <option value="0" <?php echo $user_data['email_notifications'] == 0 ? 'selected' : ''; ?>>Disabled</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>SMS Notifications</label>
                        <select name="sms_notifications" class="form-control custom-input" required>
                            <option value="1" <?php echo $user_data['sms_notifications'] == 1 ? 'selected' : ''; ?>>Enabled</option>
                            <option value="0" <?php echo $user_data['sms_notifications'] == 0 ? 'selected' : ''; ?>>Disabled</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width: 40%; background-color: #ffd700; color: #333333; border: none;">Update Settings</button>
                </form>
                <?php if (!empty($message)): ?>
                    <div class="alert alert-danger"><?php echo htmlspecialchars($message); ?></div>
                <?php endif; ?>
            </div>

            <div id="change-password" class="change-password" style="display:none;">
                <h3>Change Password</h3>
                <form action="change-password.php" method="POST" id="passwordForm">
                    <div class="form-group">
                        <label for="current_password">Current Password</label>
                        <input type="password" class="form-control custom-input" id="current_password" name="current_password" required>
                    </div>

                    <div class="form-group">
                        <label for="new_password">New Password</label>
                        <input type="password" class="form-control custom-input" id="new_password" name="new_password" required minlength="8" 
                                title="Password must be at least 8 characters long, include an uppercase letter, a number, and a special character.">
                        <div id="passwordStrength">
                            <span id="strengthText"></span>
                            <div id="strengthBar">
                                <div id="bar"></div>
                            </div>
                        </div>
                        <span id="passwordTooShort" style="color: red;"></span>
                    </div>

                    <div class="form-group">
                        <label for="confirm_password">Confirm New Password</label>
                        <input type="password" class="form-control custom-input" id="confirm_password" name="confirm_password" required>
                        <span id="passwordMismatch" style="color: red;"></span>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width: 37%; background-color: #ffd700; color: #333333; border: none;">Change Password</button>
                    <button type="button" class="btn btn-secondary" onclick="cancelAction()" style="width: 37%; background-color: #ccc; color: #333333; border: none;">Cancel</button>
                </form>
                <?php if ($message): ?>
                    <script>alert('<?php echo $message; ?>');</script>
                <?php endif; ?>
            </div>

            <div id="service-history" class="service-history" style="display:none;">
                <h3>Service History</h3>
                <input type="text" id="serviceSearch" onkeyup="searchServiceHistory()" placeholder="Search service history..." class="form-control" style="margin-bottom: 10px; width: 50%;">

                <?php if (empty($completed_services)): ?>
                    <p>No completed services found.</p>
                <?php else: ?>
                    <table class="table table-bordered" id="serviceTable">
                        <thead>
                            <tr>
                                <th style="text-align: center;">Service Type</th>
                                <th style="text-align: center;">Date</th>
                                <th style="text-align: center;">Time</th>
                                <th style="text-align: center;">Feedback</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($completed_services as $service): ?>
                                <tr>
                                    <td style="text-align: center;"><?php echo htmlspecialchars($service['service_type']); ?></td>
                                    <td style="text-align: center;"><?php echo htmlspecialchars($service['appointment_date']); ?></td>
                                    <td style="text-align: center;"><?php echo htmlspecialchars($service['appointment_time']); ?></td>
                                    <td>
                                        <button class="btn btn-primary" style="width: 100%; background-color: #ffd700; color: #333333; border: none;" onclick="openFeedbackModal('<?php echo htmlspecialchars($service['service_type']); ?>', '<?php echo htmlspecialchars($service['appointment_date']); ?>')">
                                            Leave Feedback
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <div id="completedPagination" class="pagination" style="display: flex; justify-content: center;"></div>
                <?php endif; ?>
            </div>

            <div id="repair-status" class="repair-status" style="display:none;">
                <h3>Ongoing Repairs</h3>
                <input type="text" id="repairSearch" onkeyup="searchOngoingRepairs()" placeholder="Search ongoing repairs..." class="form-control" style="margin-bottom: 10px; width: 50%;">

                <?php 
                $filtered_services = array_filter($ongoing_services, function($service) {
                    return $service['status'] !== 'Completed';
                });
                ?>

                <?php if (empty($filtered_services)): ?>
                    <p>No ongoing repairs found.</p>
                <?php else: ?>
                    <table class="table table-bordered" id="repairTable">
                        <thead>
                            <tr>
                                <th style="text-align: center;">Service Type</th>
                                <th style="text-align: center;">Date</th>
                                <th style="text-align: center;">Time</th>
                                <th style="text-align: center;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($filtered_services as $service): ?>
                                <tr>
                                    <td style="text-align: center;"><?php echo htmlspecialchars($service['service_type']); ?></td>
                                    <td style="text-align: center;"><?php echo htmlspecialchars($service['appointment_date']); ?></td>
                                    <td style="text-align: center;"><?php echo htmlspecialchars($service['appointment_time']); ?></td>
                                    <td style="text-align: center;"><?php echo htmlspecialchars($service['status']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <div id="repairPagination" class="pagination" style="display: flex; justify-content: center;"></div>
                <?php endif; ?>
            </div>


            <div id="loyalty-status" class="loyalty-status" style="display:none;">
                <h3 class="text-center">Loyalty Program Status</h3>

                <div id="redeem-success" class="alert alert-success" style="display:none;">
                    <p>Congratulations! Your voucher has been successfully redeemed.</p>
                </div>

                <div class="progress mb-4" style="height: 30px;">
                    <div class="progress-bar" role="progressbar" style="width: <?php echo $progress; ?>%;" aria-valuenow="<?php echo $progress; ?>" aria-valuemin="0" aria-valuemax="100">
                        <?php echo $progress; ?>% to next discount
                    </div>
                </div>
    
                <p class="text-center">Current Tier: <strong>Tier <?php echo $tier; ?></strong></p>
                <p class="text-center"><?php echo htmlspecialchars($next_discount); ?></p>
    
                <h4 class="mt-4">Your Vouchers</h4>
                <?php if (empty($vouchers)): ?>
                    <div class="alert alert-info">No vouchers available at this time.</div>
                <?php else: ?>
                    <div class="list-group">
                        <?php foreach ($vouchers as $voucher): ?>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>Voucher Code:</strong> <?php echo htmlspecialchars($voucher['code']); ?><br>
                                    <strong>Discount:</strong> <?php echo htmlspecialchars($voucher['discount']); ?>% off<br>
                                    <strong>Expires on:</strong> <?php echo htmlspecialchars($voucher['expiration_date']); ?>
                                </div>
                                <?php if ($voucher['is_redeemed']): ?>
                                    <span class="text-danger">Redeemed</span>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <h4 class="mt-4">How to Redeem Your Voucher</h4>
                <ol>
                    <li>Show the voucher to the technician at the time of service.</li>
                </ol>

                <div class="alert alert-warning mt-3">
                    <strong>Note:</strong> Vouchers cannot be stacked. Each voucher has an expiration date, so please use them before they expire.
                </div>
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
                <li><a href="faq.php">FAQs</a></li>
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
            <?php endif; ?>
            </ul>
        </div>
    </div>

    <div class="footer-copyright">
        <p>© 2024 Grease Monkey. All rights reserved</p>
    </div>
</footer>

<div id="feedbackModal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title w-100 text-center">Give Feedback</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="text-center">Please share your experience about our shop.</p>
        <form id="feedbackForm" action="submit_feedback.php" method="POST">
          <input type="hidden" id="service_type" name="service_type">
          <input type="hidden" id="appointment_date" name="appointment_date">

          <div class="form-group">
            <label for="rating">Rating</label>
            <div id="starRating" class="star-rating">
              <span class="star" data-value="1">&#9733;</span>
              <span class="star" data-value="2">&#9733;</span>
              <span class="star" data-value="3">&#9733;</span>
              <span class="star" data-value="4">&#9733;</span>
              <span class="star" data-value="5">&#9733;</span>
            </div>
            <input type="hidden" id="rating" name="rating" required>
          </div>

          <div class="form-group">
            <label for="feedback">Comment (optional)</label>
            <textarea id="feedback" name="feedback" class="form-control" required></textarea>
          </div>
          <button type="submit" class="btn btn-primary" style="width: 100%; background-color: #ffd700; color: #333333; border: none;">
            Submit Feedback
          </button>
        </form>
      </div>
    </div>
  </div>
</div>


<script>
function showSection(section) {
    const sections = ['general-settings', 'change-password', 'service-history', 'repair-status', 'loyalty-status'];
    sections.forEach(sec => {
        document.getElementById(sec).style.display = sec === section ? 'block' : 'none';
    });
}

function cancelAction() {
    document.getElementById("passwordForm").reset();
}

</script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/password-toogle.js"></script>
<script src="js/change-password.js"></script>
<script src="js/update-settings.js"></script>
<script src="js/hamburger.js"></script>
<script src="js/feedback-modal.js"></script>
<script src="js/ongoing-pagination.js"></script>
<script src="js/completed-pagination.js"></script>
</body>
</html>

