<?php
// db_config.php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "green_legacy"; // Change to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
