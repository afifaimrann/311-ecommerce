<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: signin.php');  
    exit();
}

// Welcome message
$username = $_SESSION['username']; 
echo "<h1>Welcome, $username!</h1>";
?>
