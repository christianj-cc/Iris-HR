<?php
require 'db_auth.php';
require_once '../INCLUDES/security-helper.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_position = isset($_POST['new_position']) && !empty(trim($_POST['new_position'])) ? trim($_POST['new_position']) : null;
    $job_title = isset($_POST['job_title']) && !empty(trim($_POST['job_title'])) ? trim($_POST['job_title']) : null;
    $department_id = isset($_POST['department_id']) ? trim($_POST['department_id']) : null;
    $new_department = isset($_POST['new_department']) && !empty(trim($_POST['new_department'])) ? trim($_POST['new_department']) : null;
    $salary = isset($_POST['salary']) ? floatval($_POST['salary']) : null;
    $vacancies = isset($_POST['vacancies']) ? intval($_POST['vacancies']) : null;
    $job_summary = isset($_POST['job_summary']) ? trim($_POST['job_summary']) : null;
    $responsibilities = isset($_POST['responsibilities']) ? trim($_POST['responsibilities']) : null;
    $requirements = isset($_POST['requirements']) ? trim($_POST['requirements']) : null;
    $qualifications = isset($_POST['qualifications']) ? trim($_POST['qualifications']) : null;
    $application_deadline = isset($_POST['application_deadline']) ? trim($_POST['application_deadline']) : null;
    $contact = isset($_POST['contact']) ? trim($_POST['contact']) : null;
    $status = "Open";

    // Handle New Department Entry
    if (!empty($new_department)) {
        $insert_department = $conn->prepare("INSERT INTO departments (department_name) VALUES (?)");
        $insert_department->bind_param("s", $new_department);

        if (!$insert_department->execute()) {
            die("Error inserting department: " . $insert_department->error);
        }

        $department_id = $insert_department->insert_id;
        $insert_department->close();

        // 🔐 LOG NEW DEPARTMENT CREATION
        logActivity(
            $_SESSION['user_id'],
            'ADD_DEPARTMENT_FROM_JOB',
            "Added new department while posting job: $new_department (ID: $department_id)"
        );
    }

    $position_id = null;

    // Handle New Position Entry
    if (!empty($new_position)) {
        // Insert new position
        $insert_position = $conn->prepare("INSERT INTO positions (position_name, department_id, base_salary, description, created_at) VALUES (?, ?, ?, ?, NOW())");
        $insert_position->bind_param("sids", $new_position, $department_id, $salary, $job_summary);

        if (!$insert_position->execute()) {
            die("Error inserting position: " . $insert_position->error);
        }

        $position_id = $insert_position->insert_id;
        $job_title = $new_position;
        $insert_position->close();

        // 🔐 AUDIT LOG FOR NEW POSITION CREATION
        logActivity(
            $_SESSION['user_id'],
            'ADD_POSITION_FROM_JOB',
            "Added new position while posting job: $new_position (ID: $position_id, Dept: $department_id)"
        );
    } else {
        // Fetch position_id and department_id from existing position
        $stmt = $conn->prepare("SELECT position_id, department_id, base_salary FROM positions WHERE position_name = ?");
        $stmt->bind_param("s", $job_title);
        $stmt->execute();
        $stmt->bind_result($position_id, $department_id, $existing_salary);
        $stmt->fetch();
        $stmt->close();

        if (!$position_id) {
            die("Error: Selected position does not exist.");
        }

        if (!$salary) {
            $salary = $existing_salary;
        }
    }

    if (!$job_title) {
        die("Error: Job Title cannot be empty.");
    }

    // Insert job posting
    $stmt = $conn->prepare("INSERT INTO job_postings 
        (job_title, position_id, department, salary, vacancies, job_summary, responsibilities, requirements, qualifications, application_deadline, contact, status, created_at) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");

    $stmt->bind_param(
        "siidssssssss",
        $job_title,
        $position_id,
        $department_id,
        $salary,
        $vacancies,
        $job_summary,
        $responsibilities,
        $requirements,
        $qualifications,
        $application_deadline,
        $contact,
        $status
    );

    if (!$stmt->execute()) {
        die("Error inserting job posting: " . $stmt->error);
    }

    $job_id = $stmt->insert_id; // Get new job ID

    // 🔐 AUDIT LOG FOR JOB POSTING CREATION
    logActivity(
        $_SESSION['user_id'],
        'ADD_JOB_POSTING',
        "Posted new job: $job_title (ID: $job_id, Position ID: $position_id, Vacancies: $vacancies)"
    );

    echo "<script>alert('Job posted successfully!'); window.location.href='../ADMIN/recruitment.php';</script>";

    $stmt->close();
    $conn->close();
}
