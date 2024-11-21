<?php
// Redirect to welcome page if already logged in
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: welcome.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="navbar">
            <h1>Login to Your Account</h1>
        </div>
    </header>

    <main>
        <div class="form-container">
            <form action="index.php" method="POST">  <!-- Use index.php for login -->
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" required>
                </div>
                <div class="form-group">
                    <button type="submit" name="login">Login</button> <!-- Send login data to index.php -->
                </div>
            </form>

            <div class="register-link">
                <p>Don't have an account? <a href="register.php">Register here</a></p>
            </div>
        </div>
    </main>

    <footer>
        <div class="footer-content">
            <p>&copy; 2024 Amar Bazaar. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
