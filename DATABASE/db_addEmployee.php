<?php
require 'db_auth.php';
require_once '../INCLUDES/security-helper.php';

// Only enforce the session flag on GET (page load)
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (!isset($_SESSION['action_allowed']['add_employee']) || $_SESSION['action_allowed']['add_employee'] !== true) {
        header("Location: employees.php?error=unauthorized");
        exit();
    }
    unset($_SESSION['action_allowed']['add_employee']); // one-time use for page access
}

// Handle form submission (POST)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_employee'])) {
    require 'db_connect.php';

    // Get and validate input
    $first_name = $conn->real_escape_string($_POST['first_name']);
    $last_name = $conn->real_escape_string($_POST['last_name']);
    $dob = $conn->real_escape_string($_POST['dob']);
    $gender = $conn->real_escape_string($_POST['gender']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $conn->real_escape_string($_POST['address']);
    $position_id = (int)$_POST['position_id'];
    $hire_date = $_POST['hire_date'];
    $employment_status = 'Active';
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Fetch base_salary from positions table
    $query = "SELECT base_salary FROM positions WHERE position_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $position_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $position = $result->fetch_assoc();
    $stmt->close();

    if (!$position) {
        die("Error: Position not found.");
    }

    $base_salary = $position['base_salary'];

    // Handle profile picture upload
    $profile_pic_path = null;
    if (!empty($_FILES['profile_pic']['name'])) {
        $upload_dir = '../ASSETS/UPLOADS/ProfilePictures/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        $file_ext = strtolower(pathinfo($_FILES['profile_pic']['name'], PATHINFO_EXTENSION));
        $allowed_exts = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($file_ext, $allowed_exts)) {
            $new_filename = time() . "_" . basename($_FILES['profile_pic']['name']);
            $upload_path = $upload_dir . $new_filename;
            if (move_uploaded_file($_FILES['profile_pic']['tmp_name'], $upload_path)) {
                $profile_pic_path = $new_filename;
            } else {
                die("Error uploading file. Check folder permissions.");
            }
        } else {
            die("Invalid file type. Allowed types: JPG, JPEG, PNG, GIF.");
        }
    }

    // Start transaction
    $conn->begin_transaction();
    try {
        // Insert into users table
        $sql_users = "INSERT INTO users (email, password, role) VALUES (?, ?, 'employee')";
        $stmt = $conn->prepare($sql_users);
        $stmt->bind_param("ss", $email, $hashed_password);
        $stmt->execute();
        $user_id = $stmt->insert_id;
        $stmt->close();

        // Insert into employees table
        $sql_insert = "INSERT INTO employees 
            (user_id, first_name, last_name, date_of_birth, gender, contact_number, address, position_id, hire_date, employment_status, base_salary, profile_picture, created_at) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

        $stmt = $conn->prepare($sql_insert);
        $stmt->bind_param(
            "issssssissss",
            $user_id,
            $first_name,
            $last_name,
            $dob,
            $gender,
            $phone,
            $address,
            $position_id,
            $hire_date,
            $employment_status,
            $base_salary,
            $profile_pic_path
        );

        $stmt->execute();
        $employee_id = $stmt->insert_id; // <-- Capture the new employee ID
        $stmt->close();

        $conn->commit();

        // Audit log with correct employee ID
        logActivity(
            $_SESSION['user_id'],
            'ADD_EMPLOYEE',
            "Added new employee: $first_name $last_name (ID: $employee_id, Email: $email)"
        );

        header("Location: ../ADMIN/employees.php?success=1");
        exit();
    } catch (Exception $e) {
        $conn->rollback();
        die("Error: " . $e->getMessage());
    }
}
