<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');  // Redirect to login page if not logged in
    exit();
}

// Connect to the database
require 'database.php';

// Fetch user details from the database
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = '$user_id'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="navbar">
            <h1>Welcome to Amar Bazaar, <?php echo htmlspecialchars($user['name']); ?>!</h1>
        </div>
    </header>

    <main>
        <div class="welcome-message">
            <h2>Hello, <?php echo htmlspecialchars($user['name']); ?>!</h2>
            <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
            <p>We're glad to have you here.</p>
        </div>

        <div class="logout">
            <a href="logout.php">Logout</a>
        </div>
    </main>

    <footer>
        <div class="footer-content">
            <p>&copy; 2024 Amar bazaar. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
