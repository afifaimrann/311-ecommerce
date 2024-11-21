<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');  // Redirect to login if not logged in
    exit();
}

// Welcome message
$username = $_SESSION['username']; // Or use other session variables as needed
echo "<h1>Welcome, $username!</h1>";
?>
