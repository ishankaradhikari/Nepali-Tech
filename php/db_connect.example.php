# Database Configuration Template
# Copy this file to create your local configuration
# IMPORTANT: Do not commit the actual config with credentials!

<?php
// Database connection parameters
// UPDATE THESE WITH YOUR LOCAL SETUP

$host = "localhost";           // Database host
$username = "root";            // Database username
$password = "";                // Database password (usually empty for local XAMPP)
$database = "nepali_e_market"; // Database name

// Create database connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set character set to UTF-8
$conn->set_charset("utf8mb4");

?>
