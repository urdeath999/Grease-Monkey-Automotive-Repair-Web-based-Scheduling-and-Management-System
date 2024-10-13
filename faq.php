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
    <link href="css/faq.css" rel="stylesheet">
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
            <div class="faq-image">
                <img src="images/engine1.jpeg" alt="Engine">
                <h2>Frequently Asked <span>Questions</span></h2>
            </div>
        
            <div class="faq-content">
                <div class="accordion-container">
                    <div class="accordion-item">
                        <button class="accordion-header">What is Grease Monkey?</button>
                        <div class="accordion-content">
                            <p>Grease Monkey is an automotive repair that specializes in repairing Ford cars.</p>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <button class="accordion-header">What services do you offer?</button>
                        <div class="accordion-content">
                            <p>We offer various automotive services including oil change, brake repair, engine diagnostics, transmission repair and more.</p>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <button class="accordion-header">How do I schedule an appointment?</button>
                        <div class="accordion-content">
                            <p>You can schedule an appointment by visiting our website and clicking the “Make an Appointment” button. You can also make an appointment at the Service webpage by clicking the “Book Now” button</p>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <button class="accordion-header">How long do your services usually take?</button>
                        <div class="accordion-content">
                            <p>Service time varies depending on the complexity of the job.</p>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <button class="accordion-header">What if I’m having trouble booking an appointment online?</button>
                        <div class="accordion-content">
                            <p>If you're having trouble booking an appointment, feel free to contact us directly through phone or email. You can find our contact details at the Contact Us section.</p>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <button class="accordion-header">How can I contact customer support?</button>
                        <div class="accordion-content">
                            <p>You can contact our customer support team Get In Touch feature of our website</p>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <button class="accordion-header">What should I do if I need urgent assistance?</button>
                        <div class="accordion-content">
                            <p>For urgent assistance, call our hotline immediately. We're available during shop opening hours.</p>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <button class="accordion-header">Why didn’t I receive a confirmation email?</button>
                        <div class="accordion-content">
                            <p>Check your spam folder or contact customer support if you didn't receive a confirmation email within 15 minutes.</p>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <button class="accordion-header">Do you offer any discounts or promotions?</button>
                        <div class="accordion-content">
                            <p>Yes, we offer discounts for new customers that will avail their first repair service from the website.</p>
                        </div>
                    </div>
                </div>
                <div class="image-container">
                    <img src="images/car1.png" alt="Automotive Repair Image" />
                </div>
            </div>
        </section>
        
    <section class="brand-we-serve">
        <div class="brand-we-serve-header">
            <h2>Brand We Serve</h2>
            <div class="brand-we-serve-line"></div>
        </div>
        <img src="images/ford.png" alt="Ford Logo" class="ford-image">
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