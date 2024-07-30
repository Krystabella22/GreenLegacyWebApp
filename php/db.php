<?php
// db.php

// Database connection parameters
$host = 'localhost'; // your database host
$db = 'green_legacy'; // your database name
$user = 'root'; // your database username
$pass = ''; // your database password

// Create a new PDO instance
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}
?>
