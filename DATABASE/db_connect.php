<?php
// DATABASE/db_connect.php
$servername = "localhost";
$username = "root";
$password = "";
$database = "irishr_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection with better error handling
if ($conn->connect_error) {
    error_log("Database connection failed: " . $conn->connect_error);
    die("System temporarily unavailable. Please try again later.");
}

// Set charset to prevent SQL injection
$conn->set_charset("utf8mb4");
