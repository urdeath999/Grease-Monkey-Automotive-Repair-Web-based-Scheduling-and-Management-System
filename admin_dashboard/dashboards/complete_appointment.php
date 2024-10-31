<?php
session_start();
require '../config.php';

// Check if the user is authenticated
if (!isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit();
}

// Check if the appointment ID is set
if (isset($_POST['complete_appointment'])) {
    $appointment_id = $_POST['appointment_id'];

    // Update the status to 'Completed'
    $update_query = "UPDATE appointments SET status = 'Completed' WHERE id = ?";
    $stmt = mysqli_prepare($conn, $update_query);
    mysqli_stmt_bind_param($stmt, 'i', $appointment_id);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['message'] = "Appointment #$appointment_id marked as completed.";

        // Retrieve the user's ID associated with this appointment
        $get_user_query = "SELECT user_id FROM appointments WHERE id = ?";
        $stmt_get_user = mysqli_prepare($conn, $get_user_query);
        mysqli_stmt_bind_param($stmt_get_user, 'i', $appointment_id);
        mysqli_stmt_execute($stmt_get_user);
        mysqli_stmt_bind_result($stmt_get_user, $user_id);
        mysqli_stmt_fetch($stmt_get_user);
        mysqli_stmt_close($stmt_get_user);

        // Update the user's completed service count
        $update_service_count_query = "UPDATE users SET completed_service_count = completed_service_count + 1 WHERE id = ?";
        $stmt_update_count = mysqli_prepare($conn, $update_service_count_query);
        mysqli_stmt_bind_param($stmt_update_count, 'i', $user_id);
        mysqli_stmt_execute($stmt_update_count);
        mysqli_stmt_close($stmt_update_count);

        // Check the user's completed service count
        $check_service_count_query = "SELECT completed_service_count FROM users WHERE id = ?";
        $stmt_check_count = mysqli_prepare($conn, $check_service_count_query);
        mysqli_stmt_bind_param($stmt_check_count, 'i', $user_id);
        mysqli_stmt_execute($stmt_check_count);
        mysqli_stmt_bind_result($stmt_check_count, $completed_service_count);
        mysqli_stmt_fetch($stmt_check_count);
        mysqli_stmt_close($stmt_check_count);

        // Check if the user already has a voucher
        $check_voucher_query = "SELECT COUNT(*) FROM vouchers WHERE user_id = ? AND discount = 5 AND is_redeemed = 0";
        $stmt_check_voucher = mysqli_prepare($conn, $check_voucher_query);
        mysqli_stmt_bind_param($stmt_check_voucher, 'i', $user_id);
        mysqli_stmt_execute($stmt_check_voucher);
        mysqli_stmt_bind_result($stmt_check_voucher, $voucher_count);
        mysqli_stmt_fetch($stmt_check_voucher);
        mysqli_stmt_close($stmt_check_voucher);

        // Generate a voucher only if they have completed 10 services and do not already have an unredeemed voucher
        if ($completed_service_count % 10 === 0 && $voucher_count === 0) {
            // Generate a voucher
            $voucher_code = strtoupper(substr(md5(uniqid(rand(), true)), 0, 10));
            $discount = 5; // 5% discount
            $expiration_date = date('Y-m-d', strtotime('+30 days'));

            // Insert the voucher into the vouchers table
            $insert_voucher_query = "INSERT INTO vouchers (user_id, code, discount, expiration_date, is_redeemed) VALUES (?, ?, ?, ?, 0)";
            $stmt_insert_voucher = mysqli_prepare($conn, $insert_voucher_query);
            mysqli_stmt_bind_param($stmt_insert_voucher, 'issi', $user_id, $voucher_code, $discount, $expiration_date);
            mysqli_stmt_execute($stmt_insert_voucher);
            mysqli_stmt_close($stmt_insert_voucher);

            // Notify the user
            $_SESSION['message'] .= " A new 5% voucher has been generated for you: $voucher_code.";
        }

    } else {
        $_SESSION['message'] = "Failed to complete appointment #$appointment_id. Please try again.";
    }

    mysqli_stmt_close($stmt);
    header('Location: dash.php'); // Redirect back to the dashboard after completion
    exit();
} else {
    $_SESSION['message'] = "No appointment selected for completion.";
    header('Location: dash.php'); // Redirect back to the dashboard if no ID is passed
    exit();
}
?>
