
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="logo.png" type="image/x-icon">
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
    <title>Grease Monkey - Admin Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet"> <!-- Montserrat Font -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="log.css">
</head>
<body>
    <!-- Register Form -->
    <div class="container" id="signup" style="display:none;">
        <!-- Logo Container -->
        <div class="logo-container">
            <img src="logo.png" alt="Grease Monkey Logo"> <!-- Use the uploaded logo -->
            <h2>Grease <span>Monkey</span></h2>
        </div>
        
        <h1 class="form-title">Welcome back!</h1>
        <form method="post" action="register.php" id="registerForm">
            <div class="input-group">
                <input type="text" name="userName" id="userName" required>
                <label for="userName">Username</label>
                <span class="error" id="fNameError"></span>
            </div>
            <div class="input-group">
                <input type="email" name="email" id="email" required>
                <label for="email">Email</label>
                <span class="error" id="emailError"></span>
            </div>
            <!-- Password Field -->
            <div class="input-group">
                <input type="password" name="password" id="password" required minlength="6">
                <label for="password">Password</label>
                <span class="toggle-password" onclick="togglePassword('password')"><i class="fas fa-eye"></i></span>
                <span class="error" id="passwordError"></span>
            </div>
            <!-- Confirm Password Field -->
            <div class="input-group">
                <input type="password" name="confirmPassword" id="confirmPassword" required minlength="6">
                <label for="confirmPassword">Confirm Password</label>
                <span class="toggle-password" onclick="togglePassword('confirmPassword')"><i class="fas fa-eye"></i></span>
                <span class="error" id="confirmPasswordError"></span>
            </div>
            <input type="submit" class="btn" value="Sign Up" name="signUp">
        </form>
        <p>Already have an account? <button id="signInButton">Sign In</button></p>
    </div>

    <!-- Sign In Form -->
    <div class="container" id="signIn">
        <!-- Logo Container -->
        <div class="logo-container">
            <img src="logo.png" alt="Grease Monkey Logo"> <!-- Use the uploaded logo -->
            <h2>Grease <span>Monkey</span></h2>
        </div>
        
        <h1 class="form-title">Get Started</h1>
        <form id="signInForm" method="post" action="login.php">
            <div class="input-group">
                <input type="email" name="email" id="emailSignIn" required>
                <label for="emailSignIn">Email</label>
                <span class="error" id="emailSignInError"></span>
            </div>
            <div class="input-group">
                <input type="password" name="password" id="passwordSignIn" required minlength="6">
                <label for="passwordSignIn">Password</label>
                <span class="toggle-password" onclick="togglePassword('passwordSignIn')"><i class="fas fa-eye"></i></span>
                <span class="error" id="passwordSignInError"></span>
            </div>
            <p class="recover">
                <a href="#" id="forgotPasswordLink">Forgot your password?</a>
            </p>        
            <input type="submit" class="btn" value="Sign In" name="signIn">
        </form>
        <p>Don’t have an account? <button id="signUpButton">Create an account</button></p>
    </div>

    <script>
        const signUpButton = document.getElementById('signUpButton');
        const signInButton = document.getElementById('signInButton');
        const signInForm = document.getElementById('signIn');
        const signUpForm = document.getElementById('signup');

        signUpButton.addEventListener('click', function () {
            signInForm.style.display = "none";
            signUpForm.style.display = "block";
        });

        signInButton.addEventListener('click', function () {
            signInForm.style.display = "block";
            signUpForm.style.display = "none";
        });

        function togglePassword(id) {
            const input = document.getElementById(id);
            const toggle = input.nextElementSibling;
            const icon = toggle.querySelector('i');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
                toggle.classList.add('active');  // Add active class to change the icon color
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
                toggle.classList.remove('active');  // Remove active class when not active
            }
        }

        // Form Validation with real-time feedback
        const inputs = document.querySelectorAll('input');
        inputs.forEach(input => {
            input.addEventListener('input', function () {
                if (input.checkValidity()) {
                    input.classList.remove('invalid');
                    input.classList.add('valid');
                } else {
                    input.classList.remove('valid');
                    input.classList.add('invalid');
                }
            });
        });

        // Password match validation
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('confirmPassword');
        confirmPassword.addEventListener('input', function () {
            if (password.value !== confirmPassword.value) {
                confirmPassword.classList.remove('valid');
                confirmPassword.classList.add('invalid');
            } else {
                confirmPassword.classList.remove('invalid');
                confirmPassword.classList.add('valid');
            }
        });
    </script>
</body>
</html>