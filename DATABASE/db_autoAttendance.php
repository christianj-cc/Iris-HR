<?php
require 'db_connect.php';
require_once '../INCLUDES/security-helper.php';

date_default_timezone_set('Asia/Manila');
$today = date('Y-m-d');
$startTime = "08:00:00";
$cutoffTime = "12:00:00";

$current_time = date('H:i:s');

// Track counts for log
$records_updated = 0;
$records_inserted = 0;

// Get all employees
$employeesQuery = "SELECT employee_id, first_name, last_name FROM employees";
$employeesResult = $conn->query($employeesQuery);

if ($employeesResult->num_rows > 0) {
    while ($employee = $employeesResult->fetch_assoc()) {
        $employee_id = $employee['employee_id'];
        $employee_name = $employee['first_name'] . ' ' . $employee['last_name'];

        // Check today's attendance
        $attendanceQuery = "SELECT clock_in, status FROM attendance WHERE employee_id = ? AND date = ?";
        $stmt = $conn->prepare($attendanceQuery);
        $stmt->bind_param("is", $employee_id, $today);
        $stmt->execute();
        $attendanceResult = $stmt->get_result();
        $attendance = $attendanceResult->fetch_assoc();
        $stmt->close();

        if ($attendance) {
            // Employee has an attendance record
            if ($attendance['clock_in'] !== null) {
                $clock_in_time = $attendance['clock_in'];

                if ($clock_in_time <= $startTime) {
                    $status = "Present";
                } else {
                    $status = "Late";
                }

                // Update status in attendance table
                $updateQuery = "UPDATE attendance SET status = ? WHERE employee_id = ? AND date = ?";
                $stmt = $conn->prepare($updateQuery);
                $stmt->bind_param("sis", $status, $employee_id, $today);
                if ($stmt->execute() && $attendance['status'] != $status) {
                    $records_updated++;
                }
                $stmt->close();
            } else {
                // If clock_in is NULL before 12 PM, mark as "Late"
                if ($current_time < $cutoffTime && $attendance['status'] != "Late") {
                    $status = "Late";
                    $updateQuery = "UPDATE attendance SET status = ? WHERE employee_id = ? AND date = ?";
                    $stmt = $conn->prepare($updateQuery);
                    $stmt->bind_param("sis", $status, $employee_id, $today);
                    if ($stmt->execute()) {
                        $records_updated++;
                    }
                    $stmt->close();
                }
                // If clock_in is NULL after 12 PM, mark as "Absent"
                elseif ($current_time >= $cutoffTime && $attendance['status'] != "Absent") {
                    $status = "Absent";
                    $updateQuery = "UPDATE attendance SET status = ? WHERE employee_id = ? AND date = ?";
                    $stmt = $conn->prepare($updateQuery);
                    $stmt->bind_param("sis", $status, $employee_id, $today);
                    if ($stmt->execute()) {
                        $records_updated++;
                    }
                    $stmt->close();
                }
            }
        } else {
            // No attendance record: Create one as "Late" before 12 PM, or "Absent" after 12 PM
            if ($current_time < $cutoffTime) {
                $status = "Late";
            } else {
                $status = "Absent";
            }

            $insertQuery = "INSERT INTO attendance (employee_id, date, status) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($insertQuery);
            $stmt->bind_param("iss", $employee_id, $today, $status);
            if ($stmt->execute()) {
                $records_inserted++;
            }
            $stmt->close();
        }
    }
}

// 🔐 AUDIT LOG (only once at the end)
logActivity(
    $_SESSION['user_id'] ?? 0, // System user if no session
    'AUTO_ATTENDANCE',
    "Auto-attendance run for $today at $current_time. Inserted: $records_inserted new records, Updated: $records_updated records."
);

$conn->close();
