<?php
require 'db_auth.php';
require_once '../INCLUDES/security-helper.php';

if (isset($_GET['applicant_id'])) {
    $applicant_id = intval($_GET['applicant_id']);

    // Fetch applicant details
    $query = "SELECT * FROM applicants WHERE applicant_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $applicant_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $applicant = $result->fetch_assoc();
    $stmt->close();

    if (!$applicant) {
        die("Error: Applicant not found.");
    }

    // Extract applicant details
    $job_id = $applicant['job_id'];
    $first_name = $applicant['first_name'];
    $last_name = $applicant['last_name'];
    $email = $applicant['email'];
    $phone = $applicant['phone'];
    $resume = $applicant['resume'];
    $cover_letter = $applicant['cover_letter'];
    $status = "Accepted";

    // Start transaction
    $conn->begin_transaction();
    try {
        // Insert into accepted_applicants
        $query = "INSERT INTO accepted_applicants (applicant_id, job_id, first_name, last_name, email, phone, resume, cover_letter, status, applied_at)
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("iisssssss", $applicant_id, $job_id, $first_name, $last_name, $email, $phone, $resume, $cover_letter, $status);
        $stmt->execute();
        $stmt->close();

        // Update status in applicants table
        $query = "UPDATE applicants SET status = ? WHERE applicant_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("si", $status, $applicant_id);
        $stmt->execute();
        $stmt->close();

        // Commit transaction
        $conn->commit();

        // 🔐 AUDIT LOG 
        logActivity(
            $_SESSION['user_id'],
            'ACCEPT_APPLICANT',
            "Accepted applicant: $first_name $last_name (ID: $applicant_id) for Job ID: $job_id"
        );

        header("Location: ../ADMIN/recruitment-applicants.php?success=accepted");
        exit();
    } catch (Exception $e) {
        $conn->rollback();
        die("Error: " . $e->getMessage());
    }
} else {
    die("Error: No applicant ID provided.");
}
