<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ABS Module Repair - Grease Monkey</title>
    <link rel="icon" href="../images/logo.png" type="image/x-icon">
    <link rel="shortcut icon" href="../images/logo.png" type="image/x-icon">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="../css/services.css" rel="stylesheet">
    <link href="../css/nav-header.css" rel="stylesheet">
    <link href="../css/appointment-form.css" rel="stylesheet">
    <link href="../css/footer.css" rel="stylesheet">
    <link href="../css/offer.css" rel="stylesheet">
</head>
<body>
    <header>
    <nav class="navbar">
        <div class="logo">
            <a href="../main.php">
                <img src="../images/logo.png" alt="Grease Monkey Logo" class="logo-image">
            </a>
            <span class="logo-text">Grease <span class="highlight">Monkey</span></span>
        </div>
        <div class="hamburger" onclick="toggleNav()">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <ul class="nav-links" id="nav-links">
            <li><a href="../main.php">Home</a></li>
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropdown-toggle" onclick="toggleDropdown(event)">
                    Services <i class="fas fa-chevron-down chevron-icon"></i>
                </a>
                <ul class="dropdown-menu" id="services-dropdown">
                    <li><a href="../services/change-oil.php">Change Oil</a></li>
                    <li><a href="../services/abs-module.php">ABS Module Repair</a></li>
                    <li><a href="../services/engine-repair.php">Engine Repair</a></li>
                    <li><a href="../services/transmission.php">Transmission Repair</a></li>
                </ul>
            </li>
            <li><a href="../contact.php">Contact</a></li>
            <li><a href="../faq.php">FAQ</a></li>
            <li><a href="../about-us.php">About Us</a></li>
        </ul>

        <?php session_start(); ?>
        <?php if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true): ?>
            <a href="../users.php" class="auth-btn" id="auth-btn">
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
        <section class="slider-container">
            <button class="prev" onclick="changeSlide(-1)" aria-label="Previous slide">&lt;</button>

            <div class="slider">
                <div class="slide">
                    <img src="../images/abs.jpg" alt="Service Image 1">
                </div>
                <div class="slide">
                    <img src="../images/abs2.jpg" alt="Service Image 2">
                </div>
                <div class="slide">
                    <img src="../images/abs3.jpg" alt="Service Image 5">
                </div>
            </div>

            <button class="next" onclick="changeSlide(1)" aria-label="Next slide">&gt;</button>
        
            <div class="bullets">
                <div class="dot" onclick="currentSlide(1)"></div>
                <div class="dot" onclick="currentSlide(2)"></div>
                <div class="dot" onclick="currentSlide(3)"></div>
            </div>
        </section>

        <div class="slider-content">
            <h2>ABS Module Repair</h2>
            <p>Replacing the defective IC on board with a new functioning one.</p>
            <div class="discount-offer">Get 5% off on your first service!</div>
            <div class="appointment-btn" onclick="openModal()">
                <span class="appointment-btn-text">Book Now!</span>
            </div>  
        </div>
        
        <section class="how-it-works">
            <h2>How It Works</h2>
            <div class="how-it-works-line"></div>           
            
            <div class="how-it-works-steps">
        
                <div class="number-step">
                    <img src="../images/number1.png" alt="Number Image One" class="number">
                    <img src="../images/calendar.png" alt="Calendar Icon" class="icon">
                    <h3>Schedule An Appointment</h3>
                    <p>Schedule your repair service with us at your convenience.</p>
                </div>
        
    
                <div class="number-step">
                    <img src="../images/number2.png" alt="Number Image Two" class="number">
                    <img src="../images/file.png" alt="File Icon" class="icon">
                    <h3>Doorstep Service</h3>
                    <p>Our mechanics will come at your doorstep with all the equipment.</p>
                </div>
        
               
                <div class="number-step">
                    <img src="../images/number3.png" alt="Number Image Three" class="number">
                    <img src="../images/sports-car.png" alt="Sports Car Icon" class="icon">
                    <h3>Treatment</h3>
                    <p>Get your old engine removed and replaced with new engine oil.</p>
                </div>
            </div>
        </section>

    
        <section class="gallery-container">
            <h2>Gallery</h2>
            <div class="gallery-line"></div>
        
            <div class="gallery">
                <div class="gallery-item">
                    <img src="../images/abs4.jpg" alt="Gallery Image 1" class="gallery-image" onclick="openLightbox(this)">
                </div>
                <div class="gallery-item">
                    <img src="../images/abs5.jpg" alt="Gallery Image 2" class="gallery-image" onclick="openLightbox(this)">
                </div>
                <div class="gallery-item">
                    <img src="../images/abs6.jpg" alt="Gallery Image 3" class="gallery-image" onclick="openLightbox(this)">
                </div>
            </div>
            <div id="lightboxModal" class="lightbox-modal">
                <span class="close" onclick="closeLightbox()">&times;</span>
                <img class="lightbox-content" id="lightboxImage">
                <div class="caption" id="lightboxCaption"></div>
            </div>
        </section>        
    
        
        <section class="brand-we-serve">
                <div class="brand-we-serve-header">
                    <h2>Brand We Serve</h2>
                    <div class="brand-we-serve-line"></div>
                </div>
                <img src="../images/ford.png" alt="Ford Logo" class="ford-image">
        </section>     
    </main>

    <footer class="footer-container">
        <div class="footer-content">
            <div class="footer-left">
                <div class="footer-logo-container">
                    <img src="../images/logo.png" alt="Grease Monkey Logo" class="footer-logo">
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
                    <li><a href="../main.php">Home</a></li>
                    <li><a href="../about-us.php">About Us</a></li>
                    <li><a href="../contact.php">Contact</a></li>
                    <li><a href="../faq.php">FAQ</a></li>
                    <li><a href="../privacy-policy.php">Privacy Policy</a></li>
                </ul>
            </div>
    
            <div class="footer-right">
                <h3>Services</h3>
                <ul>
                    <li><a href="../services/change-oil.php">Oil Change</a></li>
                    <li><a href="../services/abs-module.php">ABS Module Repair</a></li>
                    <li><a href="../services/engine-repair.php">Engine Repair</a></li>
                    <li><a href="../services/transmission.php">Transmission Repair</a></li>
                </ul>
            </div>
    
            <div class="footer-account <?php echo isset($_SESSION['username']) ? 'visible' : ''; ?>"> <!-- Added PHP class logic -->
                <h3>Account</h3>
                <ul>
                    <li>
                        <?php if (isset($_SESSION['username'])): ?>
                            <span class="welcome-message">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</span>
                        <?php else: ?>
                            <span class="welcome-message">Welcome, Guest!</span>
                        <?php endif; ?>
                    </li>
                    <li><a href="../account.php">Profile</a></li>
                    <li><a href="../logout.php">Sign Out</a></li>
                </ul>
            </div>
        </div>
    
        <div class="footer-copyright">
            <p>© 2024 Grease Monkey. All rights reserved</p>
        </div>
    </footer>

    <div id="appointmentModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Appointment Form</h2>
        <p class="discount-note">New customers will receive a 5% discount on their first service!</p>
        
        <form id="appointmentForm" action="../submit-appointment.php" method="POST">
            <label for="firstName">First Name</label>
            <input type="text" id="firstName" name="first_name" placeholder="First Name" required>
            <label for="lastName">Last Name</label>
            <input type="text" id="lastName" name="last_name" placeholder="Last Name" required>
            <label for="address">Address</label>
            <input type="text" id="address" name="address" placeholder="Address" required>
            <div class="date-time">
                <label for="date">Date</label>
                <input type="date" id="date" name="appointment_date" min="<?= date('Y-m-d'); ?>" required>
                <label for="time">Time</label>
                <input type="time" id="time" name="appointment_time" min="09:00" max="17:00" required>
            </div>
            <label for="serviceType">Type of Service</label>
            <select id="serviceType" name="service_type" required>
                <option value="">Type of Service</option>
                <option value="changeOil">Change Oil</option>
                <option value="absModuleRepair">ABS Module Repair</option>
                <option value="engineRepair">Engine Repair</option>
                <option value="transmission">Transmission</option>
            </select>
            <label for="phone">Phone Number</label>
            <input type="tel" id="phone" name="phone" pattern="\+?\(?\d{1,4}\)?[\s-]?\d{1,4}[\s-]?\d{3,4}[\s-]?\d{3,4}" placeholder="Phone Number" required>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Email" required>
            <div class="checkbox-container">
                <input type="checkbox" id="agree" name="agree" required>
                <label for="agree">I agree that my submitted data is being collected and stored as explained 
                <a href="../privacy-policy.php">here</a>!</label>
            </div>
            <button type="submit" class="submit-btn" aria-label="Submit Appointment Form">SUBMIT</button>
        </form>
    </div>
</div>
    <script src="../js/appointment.js"></script>
    <script src="../js/appointment-redirect.js"></script>
    <script src="../js/slider.js"></script>
    <script src="../js/hamburger.js"></script>
</body>
</html>