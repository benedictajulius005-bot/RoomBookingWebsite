<?php

$host = "localhost";      // Usually localhost
$username = "root";       // Default for XAMPP
$password = "";           // Leave empty in XAMPP
$database = "hostel_db";   // Your database name

$conn = mysqli_connect("localhost", "root", "", "hostel_db",3307);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// echo "Connected successfully"; // Uncomment to test

?>