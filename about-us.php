<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>About</title>
    <link rel="icon" href="images/logo.png" type="image/x-icon">
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="css/about.css" rel="stylesheet">
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
        <section class="faq">
            <div class="faq-image">
                <img src="images/abs2.jpg" alt="Engine">
                <h2>About <span>Us</span></h2>
            </div>
        </section>

        <section class="about">
            <div class="about-container">
              <div class="about-text">
                <h1>Grease Monkey Automotive Repair</h1>
                <p>Started during the pandemic in 2020 and is established by the owner named Ryan Salazar. At first, they only did home service repairs because customers were avoiding the virus at that time. They are located at M. De Leon St., Gen. T. De Leon, Valenzuela City, and have 4 Mechanics, 1 Technician, and 1 Sales Manager.</p>
                <p>At this moment, they have established themselves well in the industry. They have expanded their services from just transmission pulldown to include engine repair, oil changes, PMS, and ABS module repair.</p>
              </div>
              <div class="about-image">
                <img src="images/grease.jpg" alt="Grease Monkey Automotive Repair Shop">
              </div>
            </div>
          </section>


        <section class="team-section">
            <h1>Meet The <span class="highlight">Mechanics</span></h1>
            <div class="mechanics-container">
                <div class="mechanic">
                    <img src="images/tech1.png" alt="Mechanic Image">
                    <div class="overlay">
                        <h2>Franken Roxas</h2>
                        <p>Mechanic</p>
                    </div>
                </div>
                <div class="mechanic">
                    <img src="images/tech2.png" alt="Mechanic Image">
                    <div class="overlay">
                        <h2>Raven Zara</h2>
                        <p>Mechanic</p>
                    </div>
                </div>
                <div class="mechanic">
                    <img src="images/tech3.png" alt="Mechanic Image">
                    <div class="overlay">
                        <h2>Carlos Emjay</h2>
                        <p>Mechanic</p>
                    </div>
                </div>
                <div class="mechanic">
                    <img src="images/tech4.jpg" alt="Mechanic Image">
                    <div class="overlay">
                        <h2>Jayc Dala</h2>
                        <p>Mechanic</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="why-we-exist">
            <h1>Why We Exist</h1>
            <p>Our mission is to always prioritize quality repair services above all else. 
                We are dedicated to ensuring that every vehicle that comes through our doors receives the highest level of care and attention. 
                We understand the importance of reliable transportation, and our goal is to keep you safe on the road with services you can trust.
            </p>
            <a href="contact.html" class="contact-us-btn">Contact Us</a>
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
    <script>
        const mechanicsContainer = document.querySelector('.mechanics-container');

        let isHovered = false;

        mechanicsContainer.addEventListener('mouseover', () => {
            isHovered = true;
            mechanicsContainer.style.animationPlayState = 'paused'; 
        });

        mechanicsContainer.addEventListener('mouseout', () => {
            isHovered = false;
            mechanicsContainer.style.animationPlayState = 'running'; 
        });

        function updateAnimation() {
            if (!isHovered) {
                mechanicsContainer.style.animation = 'scroll 20s linear infinite';
            } else {
                mechanicsContainer.style.animation = 'none'; 
            }
            requestAnimationFrame(updateAnimation);
        }

        updateAnimation();
    </script>
    <script src="js/accordion.js"></script>
    <script src="js/hamburger.js"></script>
</body>
</html>   