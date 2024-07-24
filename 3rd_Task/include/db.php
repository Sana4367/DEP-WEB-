<?php
$servername = "localhost";
$username = "root"; // Change this if you have a different MySQL username
$password = ""; // Change this if you have a password set for MySQL
$dbname = "ecommerce_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
