<?php
require 'db_auth.php';
require_once '../INCLUDES/security-helper.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $position_name = trim($_POST['position_name']);
    $department_id = $_POST['department_id'];
    $base_salary = $_POST['base_salary'];
    $description = trim($_POST['description']);

    // Check if position already exists
    $check_stmt = $conn->prepare("SELECT position_id FROM positions WHERE position_name = ? AND department_id = ?");
    $check_stmt->bind_param("si", $position_name, $department_id);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Position already exists!'); window.location.href='../ADMIN/positions.php';</script>";
    } else {
        // Insert new position
        $stmt = $conn->prepare("INSERT INTO positions (position_name, department_id, base_salary, description, created_at) VALUES (?, ?, ?, ?, NOW())");
        $stmt->bind_param("sids", $position_name, $department_id, $base_salary, $description);

        if ($stmt->execute()) {
            $position_id = $stmt->insert_id; // Get new position ID

            // 🔐 AUDIT LOG 
            logActivity(
                $_SESSION['user_id'],
                'ADD_POSITION',
                "Added new position: $position_name (ID: $position_id, Dept ID: $department_id, Salary: ₱$base_salary)"
            );

            header("Location: ../ADMIN/positions.php?message=" . urlencode("Position adding successful"));
            exit();
        } else {
            header("Location: ../ADMIN/positions.php?message=" . urlencode("Error updating position"));
            exit();
        }

        $stmt->close();
    }

    $check_stmt->close();
    $conn->close();
}
