<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Frequently Asked Questions</title>
    <link rel="icon" href="images/logo.png" type="image/x-icon">
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="css/privacy-policy.css" rel="stylesheet">
    <link href="css/nav-header.css" rel="stylesheet">
    <link href="css/offer.css" rel="stylesheet">
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
                    <li><a href="services/change-oil.html">Change Oil</a></li>
                    <li><a href="services/abs-module.html">ABS Module Repair</a></li>
                    <li><a href="services/engine-repair.html">Engine Repair</a></li>
                    <li><a href="services/transmission.html">Transmission Repair</a></li>
                </ul>
            </li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="faq.php">FAQ</a></li>
            <li><a href="about-us.php">About Us</a></li>
        </ul>

        <?php session_start(); ?>
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
    <main>
        <section class="faq">
            <div class="privacy-image">
                <img src="images/engine1.jpeg" alt="Engine">
                <h2>Privacy <span>Policy</span></h2>
            </div>
            <div class="container">
                <p>We, Grease Monkey prioritize your privacy and are committed to protecting your personal data in compliance with the Data Privacy Act of 2012 (Republic Act No. 10173). This Privacy Policy explains how we collect, use, disclose, and safeguard your personal information when you visit our website.</p>
                <p>By using the Grease Monkey website, you consent to the collection and use of your personal information as described in this policy.</p>
                
                <h2>General</h2>
                <p>We are using third party tools to manage promotional activities, and we'll be sharing the user information with such third-party tools. Any emails and/or SMS sent by Grease Monkey will only be in connection with the provision of agreed services & products and this Privacy Policy.</p>
    
                <h2>Personal and Technical Information</h2>
                <p>In connection to the services offered by Grease Monkey, we may collect personal information that you voluntarily provide to us such as name, email address, contact information, and appointment details. While browsing the Grease Monkey website, it may also collect technical information regarding Internet Protocol (IP) address of the computer, Internet Service Provider (ISP) you are using, and any anonymous statistical data.</p>
    
                <h2>How we use your information?</h2>
                <p>Grease Monkey uses the information provided by you to process and confirm your appointment booking, respond to your inquiries or requests, improve the content and functionality of our website, and lastly to communicate with you about updates, offers, or relevant information (with your consent).</p>
    
                <h2>Cookies</h2>
                <p>A “cookie” is a small piece of information stored by a web server so it can be later read back from that browser. Grease Monkey uses cookies and tracking technology, depending on the features offered. No personal information will be collected via cookies and other tracking technology.</p>
    
                <h2>Retention of Personal Data</h2>
                <p>We retain your personal data only for as long as necessary to fulfill the purposes outlined in this Privacy Policy, or as required by law. Once personal data is no longer needed, it will be securely deleted or anonymized.</p>
    
                <h2>Changes to this privacy policy</h2>
                <p>Grease Monkey has the reserve the right to update or modify this Privacy Policy at any time. Any changes will be posted on this page, and we encourage you to review this policy periodically.</p>
            </div>
        </section>
    </main>
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
    <script src="js/accordion.js"></script>
    <script src="js/hamburger.js"></script>
</body>
</html>   