<?php
$servername = "localhost"; // your server
$username = "root"; // your database username
$password = ""; // your database password
$dbname = "signup"; // your database name (make sure it matches)

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
