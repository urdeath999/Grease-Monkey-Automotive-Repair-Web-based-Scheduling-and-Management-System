<!DOCTYPE html> 
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="images/logo.png" type="image/x-icon">
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/signin.css" />
    <title>Sign In</title>
  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
        <form method="POST" action="signin.php" class="sign-in-form">
          <h2 class="title">Sign In</h2>
  
          <div class="input-field">
            <input type="text" name="username" placeholder="Username" autocomplete="username" required />
            <div class="error-message" id="signin-username-error"></div>
          </div>
  
          <div class="input-field">
            <input type="password" name="password" id="sign-in-password" placeholder="Password" autocomplete="current-password" required />
            <span class="password-toggle">
              <i class="fas fa-eye"></i>
            </span>
            <div class="error-message" id="signin-password-error"></div>
          </div>
  
          <input type="submit" value="Login" class="btn solid" />
  
          <p class="social-text">Or Sign in with</p>
          <div class="social-media">
            <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="social-icon"><i class="fab fa-google"></i></a>
          </div>
        </form>

        <form method="POST" action="signup.php" class="sign-up-form">
          <h2 class="title">Sign Up</h2>

          <div class="input-field">
            <input type="text" name="username" placeholder="Username" autocomplete="username" required />
            <div class="error-message" id="signup-username-error"></div>
          </div>

          <div class="input-field">
            <input type="email" name="email" placeholder="Email" autocomplete="email" required />
            <div class="error-message" id="signup-email-error"></div>
          </div>

          <div class="input-field">
            <input type="password" name="password" id="sign-up-password" placeholder="Password" autocomplete="new-password" required />
            <span class="password-toggle">
              <i class="fas fa-eye"></i>
            </span>
            <div class="error-message" id="signup-password-error"></div>
          </div>

          <input type="submit" class="btn" value="Sign up" />

          <p class="social-text">Or Sign up with</p>
          <div class="social-media">
            <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="social-icon"><i class="fab fa-google"></i></a>
          </div>
        </form>
      </div>
    </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>New to Grease Monkey?</h3>
            <p>Sign up to schedule your car's next check-up and receive updates</p>
            <button class="btn transparent" id="sign-up-btn">Sign up</button>
          </div>
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>Already a customer?</h3>
            <p>Sign in to view your car's repair history or schedule a new appointment.</p>
            <button class="btn transparent" id="sign-in-btn">Sign in</button>
          </div>
        </div>
      </div>
    </div>
    <script src="js/toogle.js"></script>
    <script src="js/form-validation.js"></script>
  </body>
</html>
