    <?php
    include 'config.php';
    session_start(); 

    // Check if the user is logged in
    if (!isset($_SESSION['username'])) {
        echo json_encode(['status' => 'error', 'message' => 'User not logged in.']);
        exit();
    }

    // Retrieve the user ID from the session
    $userId = $_SESSION['user_id']; // Assuming user_id is stored in the session upon login

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $appointmentDate = $_POST['appointment_date'];
        $appointmentTime = $_POST['appointment_time'];
        $serviceType = trim($_POST['service_type']);
        $phone = trim($_POST['phone']);
        $vehicleDetails = trim($_POST['vehicle_details']); // New field for vehicle details

        // Phone number validation
        if (!preg_match('/^\(?\d{4}\)?[\s-]?\d{3}[\s-]?\d{4}$/', $phone)) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid phone number format.']);
            exit();
        }    

        // Date validation
        $currentDate = date("Y-m-d");
        if ($appointmentDate < $currentDate) {
            echo json_encode(['status' => 'error', 'message' => 'Appointment date cannot be in the past']);
            exit();
        }

        // Time validation
        $openingTime = "09:00";
        $closingTime = "17:00"; // Adjusted closing time to match your form
        $appointmentTime24 = date("H:i", strtotime($appointmentTime));

        if ($appointmentTime24 < $openingTime || $appointmentTime24 > $closingTime) {
            echo json_encode(['status' => 'error', 'message' => 'Appointment time must be between 9:00 AM and 5:00 PM']);
            exit();
        }

        // Check required fields
        if (empty($appointmentDate) || empty($appointmentTime) || empty($serviceType) || empty($phone)) {
            echo json_encode(['status' => 'error', 'message' => 'Please fill in all required fields']);
            exit();
        }

        // Insert appointment into the database
        $sql = "INSERT INTO appointments (user_id, appointment_date, appointment_time, service_type, phone, vehicle_details, status) VALUES (?, ?, ?, ?, ?, ?, 'Pending')";
        $stmt = $conn->prepare($sql);
        $response = [];

        if ($stmt) {
            // Bind user_id along with other parameters
            $stmt->bind_param("isssss", $userId, $appointmentDate, $appointmentTime, $serviceType, $phone, $vehicleDetails);
            if ($stmt->execute()) {
                $response = ['status' => 'success', 'message' => 'Appointment booked successfully!'];
            } else {
                $response = ['status' => 'error', 'message' => 'Error: ' . $stmt->error];
            }
        } else {
            $response = ['status' => 'error', 'message' => 'Error: Could not prepare the SQL statement.'];
        }

        echo json_encode($response);

        $stmt->close();
        $conn->close();
    }
    ?>
