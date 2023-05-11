<?php
session_start();

// Connect to database
$pdo = new PDO('mysql:host=localhost;dbname=mydatabase', 'username', 'password');

// Get form data
$username = $_POST['username'];
$password = $_POST['password'];

// Retrieve user data from database
$stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
$stmt->execute([$username]);
$user = $stmt->fetch();

// Verify password
if ($user && password_verify($password, $user['password'])) {
    // Passwords match, set session variable
    $_SESSION['user_id'] = $user['id'];
    header('Location: mainpage.php');
} else {
    // Passwords don't match, display error message
    echo 'Invalid username or password.';
}
?>
