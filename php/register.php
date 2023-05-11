<?php
// Connect to database
$pdo = new PDO('mysql:host=localhost;dbname=mydatabase', 'username', 'password');

// Get form data
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

// Check if email and username are already in use
$stmt = $pdo->prepare('SELECT COUNT(*) FROM users WHERE email = ? OR username = ?');
$stmt->execute([$email, $username]);
$count = $stmt->fetchColumn();

if ($count > 0) {
    // Email or username already in use
    echo 'That email or username is already in use.';
} else {
    // Insert user data into database
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare('INSERT INTO users (username, email, password) VALUES (?, ?, ?)');
    $stmt->execute([$username, $email, $hash]);
    echo 'User registered successfully.';
}
?>
