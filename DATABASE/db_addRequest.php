<?php
require 'db_auth.php';
require_once '../INCLUDES/security-helper.php';

// Is user logged in and session contains employee_id
if (!isset($_SESSION['employee_id'])) {
    die("Error: User not logged in. Please log in to submit a leave request.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employee_id = $_SESSION['employee_id'];
    $leave_type = $_POST['leave_type'];
    $message = $_POST['message'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $status = "Pending";

    $sql = "INSERT INTO leave_requests (employee_id, leave_type, message, start_date, end_date, status) 
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssss", $employee_id, $leave_type, $message, $start_date, $end_date, $status);

    if ($stmt->execute()) {
        $request_id = $stmt->insert_id; // Get new request ID

        // 🔐 AUDIT LOG 
        logActivity(
            $_SESSION['user_id'],
            'ADD_LEAVE_REQUEST',
            "Employee ID: $employee_id submitted $leave_type leave request (ID: $request_id) from $start_date to $end_date"
        );

        echo "<script>alert('Leave request submitted successfully!'); window.location.href='../USER/request-user.php';</script>";
    } else {
        echo "<script>alert('Error: No rows affected. Possible duplicate entry or failed insert.'); window.location.href='../USER/request-user.php';</script>";
    }

    $stmt->close();
    $conn->close();
}
