<?php
// DATABASE/db_auth.php
session_start();
require_once 'db_connect.php';

// Security: Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php?error=" . urlencode("Please login to continue"));
    exit();
}

// Security: Check for session hijacking (basic)
if (isset($_SESSION['ip_address']) && $_SESSION['ip_address'] !== $_SERVER['REMOTE_ADDR']) {
    session_destroy();
    header("Location: ../login.php?error=" . urlencode("Security violation detected"));
    exit();
}

// Security: Check session timeout (15 minutes)
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 1800)) {
    session_destroy();
    header("Location: ../login.php?error=" . urlencode("Session expired due to inactivity"));
    exit();
}

// Update last activity time
$_SESSION['last_activity'] = time();

// Set user variables
$user_id = $_SESSION['user_id'];
$employee_id = $_SESSION['employee_id'] ?? null;
$user_role = $_SESSION['role'] ?? '';
