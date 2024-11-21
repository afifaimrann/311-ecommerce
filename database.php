<?php 

$db_server = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "amar_bazaar";

// Enable MySQLi exceptions for better error handling
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    // Establish connection
    $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
    // Display a success message (optional)
    echo "Database connected successfully!";
} catch (mysqli_sql_exception $e) {
    // Handle connection error
    echo "Could not connect to the database: " . $e->getMessage();
    exit(); // Stop further execution if connection fails
}

?>
