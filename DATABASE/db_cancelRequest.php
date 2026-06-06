<?php
require 'db_auth.php';
require_once '../INCLUDES/security-helper.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['leave_id'])) {
    $leave_id = $_POST['leave_id'];
    $employee_id = $_SESSION['employee_id'];

    // Get employee name for log
    $empQuery = "SELECT first_name, last_name FROM employees WHERE employee_id = ?";
    $empStmt = $conn->prepare($empQuery);
    $empStmt->bind_param("i", $employee_id);
    $empStmt->execute();
    $empResult = $empStmt->get_result();
    $employee = $empResult->fetch_assoc();
    $employee_name = $employee['first_name'] . ' ' . $employee['last_name'];
    $empStmt->close();

    // Fetch the leave request data
    $fetch_sql = "SELECT * FROM leave_requests WHERE leave_id = ? AND employee_id = ?";
    $fetch_stmt = $conn->prepare($fetch_sql);
    $fetch_stmt->bind_param("ii", $leave_id, $employee_id);
    $fetch_stmt->execute();
    $result = $fetch_stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $leave_type = $row['leave_type'];
        $old_status = $row['status'];

        // Insert the data into the archived_requests table
        $insert_sql = "INSERT INTO archived_requests (leave_id, employee_id, leave_type, message, start_date, end_date, status, admin_message, created_at)
                       VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bind_param(
            "iisssssss",
            $row['leave_id'],
            $row['employee_id'],
            $row['leave_type'],
            $row['message'],
            $row['start_date'],
            $row['end_date'],
            $row['status'],
            $row['admin_message'],
            $row['created_at']
        );

        if ($insert_stmt->execute()) {
            $archive_id = $insert_stmt->insert_id;

            // Delete the record from the leave_requests table
            $delete_sql = "DELETE FROM leave_requests WHERE leave_id = ? AND employee_id = ?";
            $delete_stmt = $conn->prepare($delete_sql);
            $delete_stmt->bind_param("ii", $leave_id, $employee_id);

            if ($delete_stmt->execute()) {
                // 🔐 AUDIT LOG 
                logActivity(
                    $_SESSION['user_id'],
                    'CANCEL_LEAVE_REQUEST',
                    "$employee_name cancelled/archived leave request (Leave ID: $leave_id, Archive ID: $archive_id, Type: $leave_type, Status: $old_status)"
                );

                echo "<script>
                    alert('Leave request archived successfully!');
                    window.location.href = '../USER/request-user.php';
                </script>";
            } else {
                // Log error
                logActivity(
                    $_SESSION['user_id'],
                    'CANCEL_REQUEST_ERROR',
                    "Error deleting request after archiving: " . $delete_stmt->error . " (Leave ID: $leave_id)"
                );

                echo "<script>
                    alert('Error deleting request: " . addslashes($delete_stmt->error) . "');
                    window.history.back();
                </script>";
            }

            $delete_stmt->close();
        } else {
            // Log error
            logActivity(
                $_SESSION['user_id'],
                'CANCEL_REQUEST_ERROR',
                "Error archiving request: " . $insert_stmt->error . " (Leave ID: $leave_id)"
            );

            echo "<script>
                alert('Error archiving request: " . addslashes($insert_stmt->error) . "');
                window.history.back();
            </script>";
        }

        $insert_stmt->close();
    } else {
        // Log not found attempt
        logActivity(
            $_SESSION['user_id'],
            'CANCEL_REQUEST_NOT_FOUND',
            "Attempted to cancel non-existent leave request ID: $leave_id"
        );

        echo "<script>
            alert('Leave request not found.');
            window.history.back();
        </script>";
    }

    $fetch_stmt->close();
    $conn->close();
}
