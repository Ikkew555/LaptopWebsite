<?php
ini_set('memory_limit', '256M');  // Set memory limit here if needed

$host = "feenix-mariadb.swin.edu.au";  // Your database host
$user = "s105230475";       // Your database username
$password = "240400";       // Your database password
$dbname = "s105230475_db";  // Your database name

// Create a database connection
$conn = mysqli_connect($host, $user, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
