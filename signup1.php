<?php
// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "Access denied: Please submit the form properly.";
    exit;
}

// Validate data
if (!isset($_POST['username'], $_POST['password'], $_POST['confirmPassword'])) {
    echo "Missing form data.";
    exit;
}

$user = trim($_POST['username']);
$pass = $_POST['password'];
$confirmPass = $_POST['confirmPassword'];

if (empty($user) || empty($pass) || empty($confirmPass)) {
    die("All fields are required.");
}

if ($pass !== $confirmPass) {
    die("Error: Passwords do not match.");
}

// Connect to DB
$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "signup";

$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if username exists
$stmt = $conn->prepare("SELECT * FROM gowry WHERE username = ?");
$stmt->bind_param("s", $user);
$stmt->execute();
$result = $stmt->get_result();
if ($result && $result->num_rows > 0) {
    die("Username already taken.");
}
$stmt->close();

// Insert user
$hashedPassword = password_hash($pass, PASSWORD_DEFAULT);
$stmt = $conn->prepare("INSERT INTO gowry (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $user, $hashedPassword);
if ($stmt->execute()) {
    echo "Signup successful!";
} else {
    echo "Database error: " . $stmt->error;
}
$stmt->close();
$conn->close();
?>
