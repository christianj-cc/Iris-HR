<?php
require 'db_auth.php';
require_once '../INCLUDES/security-helper.php';

date_default_timezone_set('Asia/Manila');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["error" => "User not logged in"]);
    exit;
}

$user_id = $_SESSION['user_id'];
$current_date = date("Y-m-d");
$current_time = date("H:i:s");

// Get employee_id and name
$query = "SELECT e.employee_id, e.first_name, e.last_name FROM employees e WHERE e.user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (!$row) {
    echo json_encode(["error" => "Employee not found"]);
    exit;
}

$employee_id = $row['employee_id'];
$employee_name = $row['first_name'] . ' ' . $row['last_name'];

// Check attendance record for today
$query = "SELECT * FROM attendance WHERE employee_id = ? AND date = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("is", $employee_id, $current_date);
$stmt->execute();
$result = $stmt->get_result();
$attendance = $result->fetch_assoc();

if (!$attendance) {
    // No record for today → Clock In
    $query = "INSERT INTO attendance (employee_id, date, clock_in) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iss", $employee_id, $current_date, $current_time);

    if ($stmt->execute()) {
        $attendance_id = $stmt->insert_id;

        // 🔐 AUDIT LOG FOR CLOCK IN
        logActivity(
            $user_id,
            'CLOCK_IN',
            "$employee_name clocked in at $current_time (Attendance ID: $attendance_id)"
        );

        echo json_encode(["status" => "clocked_in", "time" => $current_time]);
    } else {
        echo json_encode(["error" => "Failed to clock in"]);
    }
} elseif ($attendance['clock_in'] === null) {
    // Fix: If clock-in is NULL but there's a record, update it
    $query = "UPDATE attendance SET clock_in = ? WHERE employee_id = ? AND date = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sis", $current_time, $employee_id, $current_date);

    if ($stmt->execute()) {
        // 🔐 AUDIT LOG FOR CLOCK IN (UPDATE)
        logActivity(
            $user_id,
            'CLOCK_IN',
            "$employee_name clocked in at $current_time (Late/Corrected)"
        );

        echo json_encode(["status" => "clocked_in", "time" => $current_time]);
    } else {
        echo json_encode(["error" => "Failed to update clock in"]);
    }
} elseif ($attendance['clock_out'] === null) {
    // Clock Out
    $query = "UPDATE attendance SET clock_out = ? WHERE employee_id = ? AND date = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sis", $current_time, $employee_id, $current_date);

    if ($stmt->execute()) {
        // 🔐 AUDIT LOG FOR CLOCK OUT
        logActivity(
            $user_id,
            'CLOCK_OUT',
            "$employee_name clocked out at $current_time"
        );

        echo json_encode(["status" => "clocked_out", "time" => $current_time]);
    } else {
        echo json_encode(["error" => "Failed to clock out"]);
    }
} else {
    echo json_encode(["status" => "already_clocked_out"]);
}

$conn->close();
exit;
