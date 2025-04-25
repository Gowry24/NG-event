<?php
// Start the session (optional if you want to keep user logged in)
session_start();

// Only allow form submission through POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo "Access denied.";
    exit;
}

// Check if form fields are sent
if (!isset($_POST['username'], $_POST['password'])) {
    echo "Please fill in all fields.";
    exit;
}

// Get data from form
$username = trim($_POST['username']);
$password = $_POST['password'];

// Connect to database
$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "signup";

$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and execute query
$sql = "SELECT * FROM gowry WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    // Verify password
    if (password_verify($password, $user['password'])) {
        // Success — login ok
        echo "Login successful! Welcome, " . htmlspecialchars($username);

        // Optionally, save user session
        // $_SESSION['username'] = $username;

        // Redirect to home page or dashboard
        // header("Location: dashboard.php");
        // exit;
    } else {
        echo "Invalid password.";
    }
} else {
    echo "No user found with that username.";
}

$stmt->close();
$conn->close();
?>
