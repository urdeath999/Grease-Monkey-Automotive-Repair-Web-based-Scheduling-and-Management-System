<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact Us</title>
    <link rel="icon" href="images/logo.png" type="image/x-icon">
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="css/contact.css" rel="stylesheet">
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
    <section class="contact-us">
        <div class="contact-image">
            <img src="images/abs.jpg" alt="Car Engine">
            <h2>Contact <span>Us</span></h2>
        </div>
        <div class="contact-info">
            <div class="location">
                <i class="fas fa-map-marker-alt"></i>
                <p>2193 Mateo de Leon St., Valenzuela, Philippines</p>
            </div>
            
            <div class="hours">
                <i class="fas fa-clock"></i>
                <p>9:00 AM - 6:00 PM</p>
            </div>

            <div class="phone">
                <i class="fas fa-phone"></i>
                <p>09562741979</p>
            </div>
        </div>
    </section>

    <section class="container">
        <div class="map-container">
            <div style="max-width:100%;list-style:none; transition: none;overflow:hidden;width:100%;height:100%;">
                <div id="my-map-display" style="height:100%; width:100%;max-width:100%;">
                    <iframe style="height:100%;width:100%;border:0;" frameborder="0" 
                        src="https://www.google.com/maps/embed/v1/place?q=2193+Mateo+de+Leon+St.,+Valenzuela,+Philippines&key=AIzaSyBFw0Qbyq9zTFTd-tUY6dZWTgaQzuU17R8">
                    </iframe>
                </div>
                <style>
                    #my-map-display img {
                        max-height: none;
                        max-width: none!important;
                        background: none!important;
                    }
                </style>
            </div>
        </div>

        <div class="form-container">
            <h2>Get In <span class="highlight">Touch</span></h2>
            <form id="contact-form">
                <div class="form-row">
                    <input type="text" name="firstName" placeholder="First Name" required>
                    <input type="text" name="lastName" placeholder="Last Name" required>
                </div>
                <input type="email" name="email" placeholder="Email" required>
                <textarea name="message" rows="5" placeholder="Message" required></textarea>
                <div class="checkbox-row">
                    <input type="checkbox" id="dataConsent" required>
                    <label for="dataConsent">I agree that my submitted data is being collected and stored as explained <a href="privacy-policy.php">here</a>.</label>
                </div>
                <button type="submit">SUBMIT</button>
            </form>
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
                <a href="https://web.facebook.com/profile.php?id=61554345268520&_rdc=1&_rdr" class="social-icon"><i class="fab fa-facebook-f"></i></a>
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
<script src="js/hamburger.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>
<script>
    (function(){
        emailjs.init("6Z7sULpo9csR31jlT");  
    })();

    document.getElementById('contact-form').addEventListener('submit', function(event) {
        event.preventDefault(); 
        const firstName = document.querySelector('input[name="firstName"]').value;
        const lastName = document.querySelector('input[name="lastName"]').value;
        const email = document.querySelector('input[name="email"]').value;
        const message = document.querySelector('textarea[name="message"]').value;

        const consentGiven = document.getElementById('dataConsent').checked;
        if (!consentGiven) {
            alert('You must agree to the data consent to submit the form.');
            return;
        }

        emailjs.send("service_3gojfdu", "template_lmux7xv", {
            firstName: firstName,
            lastName: lastName,
            email: email,
            message: message
        })
        .then(function(response) {
            console.log('SUCCESS!', response.status, response.text);
            alert('Message sent successfully!');
            document.getElementById('contact-form').reset(); 
        }, function(error) {
            console.log('FAILED...', error);
            alert('Failed to send message. Please try again later.');
        });
    });
</script>
</body>
</html>