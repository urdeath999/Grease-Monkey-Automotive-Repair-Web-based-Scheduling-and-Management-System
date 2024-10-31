<?php
session_start();

// Check if the user is already logged in or if the OTP is not set
if (!isset($_SESSION['user_id']) || !isset($_SESSION['otp'])) {
    header("Location: login.php"); // Redirect to login if session is invalid
    exit();
}

// Check if the form is submitted
if (isset($_POST['verifyOtp'])) {
    // Get the OTP from the form
    $enteredOtp = $_POST['otp'];

    // Check if the OTP matches and is not expired
    if ($enteredOtp == $_SESSION['otp'] && time() < $_SESSION['otp_expiration']) {
        // OTP is correct and valid, log the user in
        // Optionally, you can set session variables for user details
        $_SESSION['loggedin'] = true; // User is logged in
        // Redirect to the user dashboard
        header("Location: dashboard.php"); // Change to your dashboard page
        exit();
    } else {
        $error = "Invalid or expired OTP. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <link rel="stylesheet" href="styles.css"> <!-- Your CSS file -->
</head>
<body>
    <div class="container">
        <h1>OTP Verification</h1>
        <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>
        <form method="post" action="">
            <div class="input-group">
                <input type="text" name="otp" required>
                <label for="otp">Enter your OTP</label>
            </div>
            <input type="submit" class="btn" value="Verify OTP" name="verifyOtp">
        </form>
        <p>If you didn't receive an OTP, <a href="resend_otp.php">click here to resend</a>.</p>
    </div>
</body>
</html>
