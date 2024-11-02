<?php
include 'config.php';
session_start();

if (isset($_POST['voucher_code'])) {
    $voucher_code = $_POST['voucher_code'];

    // Prepare and execute the SQL statement
    $stmt = $conn->prepare("SELECT discount, is_redeemed FROM vouchers WHERE code = ? AND expiration_date > CURDATE()");
    $stmt->bind_param("s", $voucher_code);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Voucher found
        $voucher = $result->fetch_assoc();
        
        if ($voucher['is_redeemed'] == 0) {
            // Voucher is valid and not redeemed
            echo json_encode(['valid' => true, 'discount' => $voucher['discount']]);
        } else {
            // Voucher has already been redeemed
            echo json_encode(['valid' => false, 'message' => 'This voucher has already been redeemed.']);
        }
    } else {
        // Voucher not found or expired
        echo json_encode(['valid' => false, 'message' => 'Invalid or expired voucher code.']);
    }

    $stmt->close();
}

$conn->close();
?>
