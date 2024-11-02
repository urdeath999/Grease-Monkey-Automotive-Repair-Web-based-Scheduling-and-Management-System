<?php
session_start();
include 'config.php';

if (!isset($_SESSION['username'])) {
    header('Location: users.php');
    exit();
}

$voucher_code = $_POST['voucher_code'] ?? '';
if (empty($voucher_code)) {
    $_SESSION['message'] = 'Invalid voucher code.';
    header('Location: account.php');
    exit();
}

// Redeem the voucher using user ID
$sql = "UPDATE vouchers SET is_redeemed = 1 WHERE code = ? AND user_id = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    // Bind the parameters before executing
    $user_id = $_SESSION['user_id']; // Get the user ID from session
    $stmt->bind_param('si', $voucher_code, $user_id); // Change 'ss' to 'si'

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            $_SESSION['message'] = 'Voucher successfully redeemed!';
        } else {
            // Further checks
            $check_sql = "SELECT * FROM vouchers WHERE code = ? AND user_id = ?";
            $check_stmt = $conn->prepare($check_sql);
            $check_stmt->bind_param('si', $voucher_code, $user_id); // Use user_id instead of email
            $check_stmt->execute();
            $result = $check_stmt->get_result();

            if ($result->num_rows > 0) {
                $voucher = $result->fetch_assoc();
                if ($voucher['is_redeemed']) {
                    $_SESSION['message'] = 'Voucher has already been redeemed.';
                } elseif (strtotime($voucher['expiration_date']) < time()) {
                    $_SESSION['message'] = 'Voucher has expired.';
                } else {
                    $_SESSION['message'] = 'Voucher could not be redeemed for an unknown reason.';
                }
            } else {
                $_SESSION['message'] = 'Voucher code does not exist.';
            }
        }
    } else {
        $_SESSION['message'] = 'Error executing query: ' . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    $_SESSION['message'] = 'Error preparing statement: ' . $conn->error;
}

// Redirect back to the account page
header('Location: account.php');
exit();

