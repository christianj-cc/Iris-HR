<?php
require 'db_auth.php';
require_once '../INCLUDES/security-helper.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $department_name = trim($_POST['department_name']);
    $description = trim($_POST['description']);

    if (!empty($department_name)) {
        $query = "INSERT INTO departments (department_name, description, created_at) VALUES (?, ?, NOW())";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $department_name, $description);

        if ($stmt->execute()) {
            $department_id = $stmt->insert_id; // Get new department ID

            // 🔐 AUDIT LOG 
            logActivity(
                $_SESSION['user_id'],
                'ADD_DEPARTMENT',
                "Added new department: $department_name (ID: $department_id, Description: $description)"
            );

            $_SESSION['message'] = "Department added successfully!";
        } else {
            $_SESSION['error'] = "Error adding department. Please try again.";
        }
    } else {
        $_SESSION['error'] = "Department name is required.";
    }

    // Redirect back to departments page after processing the form
    header("Location: ../ADMIN/departments.php");
    exit();
}
