<?php
require 'db_auth.php';
require_once '../INCLUDES/security-helper.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Error: Invalid request method.");
}

$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
    die("Error: You must be logged in to apply.");
}

$job_id = $_POST['job_id'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];

// Define separate directories for resumes and cover letters
$resume_dir = "../ASSETS/UPLOADS/Resumes/";
$cover_letter_dir = "../ASSETS/UPLOADS/CoverLetters/";

// Ensure directories exist
if (!file_exists($resume_dir)) {
    mkdir($resume_dir, 0777, true);
}
if (!file_exists($cover_letter_dir)) {
    mkdir($cover_letter_dir, 0777, true);
}

function uploadFile($file, $upload_dir, $type)
{
    $file_name = basename($file['name']);
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $allowed_ext = ['pdf'];

    if (!in_array($file_ext, $allowed_ext)) {
        die("Error: Only PDF files are allowed for $type.");
    }

    $new_file_name = uniqid() . "_" . $file_name;
    $file_path = $upload_dir . $new_file_name;

    if (move_uploaded_file($file['tmp_name'], $file_path)) {
        return $file_path;
    } else {
        die("Error: Failed to upload $type.");
    }
}

// Upload resume and cover letter to respective directories
$resume_path = uploadFile($_FILES['resume'], $resume_dir, "resume");
$cover_letter_path = uploadFile($_FILES['cover_letter'], $cover_letter_dir, "cover letter");

// Insert into applications table
$sql = "INSERT INTO applicants (job_id, first_name, last_name, email, phone, resume, cover_letter, status, applied_at) 
        VALUES (?, ?, ?, ?, ?, ?, ?, 'Pending', NOW())";

$stmt = $conn->prepare($sql);
$stmt->bind_param("issssss", $job_id, $first_name, $last_name, $email, $phone, $resume_path, $cover_letter_path);

if ($stmt->execute()) {
    $applicant_id = $stmt->insert_id; // Get new applicant ID

    // 🔐 AUDIT LOG 
    logActivity(
        $user_id,
        'JOB_APPLICATION',
        "User applied for Job ID: $job_id - $first_name $last_name (Applicant ID: $applicant_id)"
    );

    echo "<script>alert('Application submitted successfully!'); window.location.href='../USER/recruitment-user.php';</script>";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
