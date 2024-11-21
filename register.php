<?php
// Start the session
session_start();

// Include the database connection file
require 'database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['register'])) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $password_hashed = password_hash($password, PASSWORD_DEFAULT);  // Hash the password

        // Check if the email already exists
        $check_email_query = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $check_email_query);

        if (mysqli_num_rows($result) > 0) {
            echo "<p style='color: red;'>Email already exists. Please use a different one.</p>";
        } else {
            // Insert the new user into the database
            $query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password_hashed')";
            if (mysqli_query($conn, $query)) {
                $_SESSION['user_id'] = mysqli_insert_id($conn); // Store the user id in the session
                header('Location: welcome.php'); // Redirect to the welcome page
                exit();
            } else {
                echo "<p style='color: red;'>Error in registration. Please try again.</p>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="navbar">
            <h1>Register for Your Account</h1>
        </div>
    </header>

    <main>
        <div class="form-container">
            <form method="POST" action="register.php">
                <h2>Register</h2>
                <input type="text" name="name" placeholder="Full Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" name="register">Register</button>
            </form>

            <p>Already have an account? <a href="login.php">Login here</a></p>
        </div>
    </main>

    <footer>
        <div class="footer-content">
            <p>&copy; 2024 Amar Bazaar. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
