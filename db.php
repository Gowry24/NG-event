<?php
$host = "localhost";    // or your server IP
$dbname = "signup";
$user = "root";         // default XAMPP/WAMP username
$pass = "";             // leave empty if no password

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
