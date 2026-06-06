<?php
require 'db_auth.php';

date_default_timezone_set('Asia/Manila');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["error" => "User not logged in"]);
    exit;
}

$user_id = $_SESSION['user_id'];
$current_date = date("Y-m-d");

// Get employee_id
$query = "SELECT employee_id FROM employees WHERE user_id = ?";
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

// Check today's attendance
$query = "SELECT clock_in, clock_out FROM attendance WHERE employee_id = ? AND date = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("is", $employee_id, $current_date);
$stmt->execute();
$result = $stmt->get_result();
$attendance = $result->fetch_assoc();

if ($attendance) {
    if ($attendance['clock_out'] !== null) {
        echo json_encode(["clock_status" => "completed", "clock_in" => $attendance['clock_in'], "clock_out" => $attendance['clock_out']]);
    } 
    elseif ($attendance['clock_in'] === null) {
        // Record exists, but no clock-in → should prompt "Clock In" button
        echo json_encode(["clock_status" => "clock_in"]);
    }
    else {
        echo json_encode(["clock_status" => "clock_out", "clock_in" => $attendance['clock_in']]);
    }
} else {
    // This case should NEVER happen if auto-attendance works correctly
    echo json_encode(["error" => "No attendance record found"]);
}

$conn->close();
exit;
