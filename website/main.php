<?php
session_start(); 

if (isset($_POST['login'])) {
    $_SESSION['user_id'] = $userId; 
    $_SESSION['username'] = $username; 
    $_SESSION['user_logged_in'] = true; 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grease Monkey</title>
    <link rel="icon" href="images/logo.png" type="image/x-icon">
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css"rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/offer.css" rel="stylesheet">
    <link href="css/nav-header.css" rel="stylesheet">
    <link href="css/appointment-form.css" rel="stylesheet">
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
    <main>
        <section class="hero">
            <div class="content-wrapper">
                <h1 class="welcome-text">Welcome To Grease Monkey</h1>
                <h2 class="headline">Quality Above All</h2>
                <p class="subheadline">Your trusted car repair shop!</p>
                <div class="appointment-btn" onclick="openModal()">
                    <span class="appointment-btn-text">MAKE AN APPOINTMENT</span>
                </div>
                <img src="images/car1.png" alt="Car Repair" class="car-repair-image">
            </div>
            <div class="scroll-indicator">
                <span class="arrow-down">↓</span>
            </div>
        </section>

        <section class="about-us">
            <div class="about-images">
                <img src="images/tech1.png" alt="Team Member 1" class="about-image top-left-radius">
                <img src="images/tech2.png" alt="Team Member 2" class="about-image">
                <img src="images/tech3.png" alt="Team Member 3" class="about-image">
                <img src="images/tech4.jpg" alt="Team Member 4" class="about-image bottom-right-radius">
            </div>
            <div class="about-content">
                <h3 class="about-heading">The Most Experienced Mechanics You Ever Met</h3>
                <p class="about-description">
                    Started during the pandemic in 2020 and established by the owner named Ryan Salazar. At first, they only did home service repair because customers at that time were scared to go outside to avoid the so-called virus. They are located at M. De Leon St., Gen. T. De Leon, Valenzuela City and have 4 Mechanics, 1 Technician, and 1 Sales Manager.
                </p>
                <a href="about-us.php" class="about-us-btn">MORE ABOUT US</a>
            </div>
        </section>

        <section class="services-overview">
            <div class="services-header">
                <h2 class="our-services">
                    Our Services
                </h2>
                <div class="services-line"></div>
                <h1 class="explore-services">Explore Our Services</h1>
                <p class="services-description">
                    Grease Monkey offers full-service auto repair and maintenance such as changing oil, ABS repair module, engine repair, and transmission.
                </p>
            </div>
            <div class="services-container">
              <div class="service-card">
                <img src="images/oilred.jpeg" alt="Change Oil" class="service-image">
                <div class="service-info">
                  <h3 class="service-title">Change Oil</h3>
                  <p class="service-text">Draining old engine oil and replacing it with a new clear one.</p>
                  <a href="services/change-oil.php" class="service-link">Read More &rarr;</a>
                </div>
              </div>
              <div class="service-card">
                <img src="images/abs.jpg" alt="ABS Repair Module" class="service-image">
                <div class="service-info">
                  <h3 class="service-title">ABS Module</h3>
                  <p class="service-text">Replacing the defective IC on board with a new functioning one.</p>
                  <a href="services/abs-module.php" class="service-link">Read More &rarr;</a>
                </div>
              </div>
              <div class="service-card">
                <img src="images/img1.jpeg" alt="Engine Repair" class="service-image">
                <div class="service-info">
                  <h3 class="service-title">Engine Repair</h3>
                  <p class="service-text">Diagnosing the problem of your engine then proceeding to fix.</p>
                  <a href="services/engine-repair.php" class="service-link">Read More &rarr;</a>
                </div>
              </div>
              <div class="service-card">
                <img src="images/trans.jpeg" alt="Transmission Repair" class="service-image">
                <div class="service-info">
                  <h3 class="service-title">Transmission</h3>
                  <p class="service-text">Fixing and maintaining transmission components for smooth shifts.</p>
                  <a href="services/transmission.php" class="service-link">Read More &rarr;</a>
                </div>
              </div>
            </div>
          </section>

        <section class="work-process">
            <div class="work-process-header">
                <h2>Work Process</h2>
                <div class="work-process-line"></div>
                <p>We Ensure To Complete Every Step Carefully</p>
            </div>
            <div class="work-process-steps">
                <div class="process-step">
                    <div class="process-number">01</div>
                    <h3>Choose</h3>
                    <p>Choose Your Service From Our Wide Range Of Offerings</p>
                </div>
                <div class="process-step">
                    <div class="process-number">02</div>
                    <h3>Book</h3>
                    <p>Make An Appointment With Us</p>
                </div>
                <div class="process-step">
                    <div class="process-number">03</div>
                    <h3>Fair Pricing</h3>
                    <p>Always Get A Fair Quote</p>
                </div>
                <div class="process-step">
                    <div class="process-number">04</div>
                    <h3>Home Service</h3>
                    <p>Get A Repair Service At Home</p>
                </div>
            </div>
        </section>

        <section class="testimonial-section">
            <div class="testimonial-header">
                <h3>Testimonial</h3>
                <h2>Don't Believe Me<br>Check What Client<br>Think Of Us</h2>
                <div class="testimonial-pagination">
                    <button id="prev-btn" class="testimonial-nav">&#10094;</button> 
                    <button id="next-btn" class="testimonial-nav">&#10095;</button> 
                </div>
            </div>
            <div class="testimonial-container" id="testimonial-container"></div>
        </section>

        <section class="faq-section">
            <div class="faq-header">
                <h2>Grease Monkey Automotive Repair</h2>
                <h3>Frequently Asked Questions</h3>
            </div>
            <div class="faq-container">
                <div class="faq-content">
                    <div class="accordion">
                        <div class="faq-item">
                            <h4 class="faq-question">What is Grease Monkey Automotive Repair?</h4>
                            <p class="faq-answer">Grease Monkey Automotive Repair is a trusted service provider specializing in vehicle maintenance and repairs. Our team of skilled mechanics offers comprehensive services to keep your car running smoothly and safely.</p>
                        </div>

                        <div class="faq-item">
                            <h4 class="faq-question">Do you offer home service repairs?</h4>
                            <p class="faq-answer">Yes, we offer home service repairs for select services. Contact us to check if your service request qualifies for home service.</p>
                        </div>

                        <div class="faq-item">
                            <h4 class="faq-question">How can I schedule an appointment?</h4>
                            <p class="faq-answer">Simply click the "Make an Appointment" button on our website, fill in the necessary details, and submit the form to book your slot.</p>
                        </div>

                        <div class="faq-item">
                            <h4 class="faq-question">How do I book an appointment?</h4>
                            <p class="faq-answer">You can easily book an appointment by clicking the "Make An Appointment" button on our homepage, choosing your preferred date and time, and submitting the form with your details.</p>
                        </div>

                        <div class="faq-item">
                            <h4 class="faq-question">Do I need to sign in to book an appointment?</h4>
                            <p class="faq-answer">Yes, signing in is required to schedule an appointment. You can view our services without signing in, but booking will prompt you to log in or create an account if you haven’t done so.</p>
                        </div>

                        <div class="faq-item">
                            <h4 class="faq-question">Is there a way to track my repair progress?</h4>
                            <p class="faq-answer">Absolutely! Once you book a service, you can check the status of your repair by logging into your accoun and visiting the Profile located at the bottom of the website</p>
                        </div>
                    </div>
                    <div class="faq-image">
                        <img src="images/faq image.jpg" alt="FAQ Image" />
                    </div>
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

    <div id="cookieBanner" style="display: none;">
        <p>We use cookies to ensure the best experience on our website. 
            <a href="privacy-policy.php" style="color: #ffcc00;">Learn more</a>
        </p>
        <button onclick="acceptCookies()">Accept</button>
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
<div id="appointmentModal" class="modal">
    <div class="modal-content">
        <h2>Create An Appointment</h2>
        <p class="discount-note">Earn a 5% discount on your next service after completing 5 repair services!</p>

        <form id="appointmentForm" action="submit-appointment.php" method="POST">
            <label for="phone">Contact # <span style="color: red;">*</span></label>
            <input type="tel" id="phone" name="phone" pattern="\+?\(?\d{1,4}\)?[\s-]?\d{1,4}[\s-]?\d{3,4}[\s-]?\d{3,4}" placeholder="Phone Number" required>

            <div class="date-time">
                <label for="date">Date <span style="color: red;">*</span></label>
                <input type="date" id="date" name="appointment_date" min="<?= date('Y-m-d'); ?>" required>
                
                <label for="time">Time <span style="color: red;">*</span></label>
                <input type="time" id="time" name="appointment_time" min="09:00" max="17:00" required>
            </div>

            <label for="serviceType">Type of Service <span style="color: red;">*</span></label>
            <select id="serviceType" name="service_type" required>
                <option value="">Type of Service</option>
                <option value="Change Oil">Change Oil</option>
                <option value="ABS Module Repair">ABS Module Repair</option>
                <option value="Engine Repair">Engine Repair</option>
                <option value="Transmission">Transmission</option>
            </select>

            <label for="vehicleDetails">Vehicle Details</label>
            <textarea id="vehicleDetails" name="vehicle_details" placeholder="Additional details about your vehicle"></textarea>

            <div class="checkbox-container">
                <input type="checkbox" id="agree" name="agree" required>
                <label for="agree">I agree that my submitted data is being collected and stored as explained 
                <a href="privacy-policy.php">here</a></label>
            </div>

            <div class="button-container">
                <button type="submit" class="submit-btn" aria-label="Submit Appointment Form">Create</button>
                <button type="button" class="close-btn" onclick="closeModal()">Close</button>
            </div>
        </form>
    </div>
</div>
    <script>
        // Show the cookie banner if not accepted
        document.addEventListener('DOMContentLoaded', () => {
    // Show the cookie banner if cookies haven't been accepted
    if (!localStorage.getItem('cookiesAccepted')) {
        document.getElementById('cookieBanner').style.display = 'block';
    }

    // Set cookie acceptance and hide the banner
    window.acceptCookies = function() {
        localStorage.setItem('cookiesAccepted', 'true');
        document.getElementById('cookieBanner').style.display = 'none';
    };

    // Set the active link for the current page
    const navLinks = document.querySelectorAll('.nav-links a');
    const currentURL = window.location.href;

    navLinks.forEach(link => {
        if (link.href === currentURL) {
            link.classList.add('active');
        }
    });
});
    </script>
    <script src="js/appointment-redirect2.js"></script>          
    <script src="js/appointment.js"></script>
    <script src="js/hamburger.js"></script>
    <script src="js/testimonial.js"></script>
    <script src="js/accordion2.js"></script>
</body>
</html>