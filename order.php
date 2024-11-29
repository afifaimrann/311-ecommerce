<?php
session_start();
include 'database.php'; // Include the database connection

// Redirect to login page if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: signin.php');
    exit();
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capture order details from form
    $user_id = $_SESSION['user_id'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $delivery_area = $_POST['delivery_area'];

    // Calculate shipping charges based on delivery area
    $shipping_charge = ($delivery_area == "Dhaka") ? 80 : 130;

    // Calculate total amount (you will need to calculate the total cart amount)
    $total_amount = $_SESSION['cart_total'] + $shipping_charge; // Assuming cart_total is stored in session

    // Insert order into the orders table
    $stmt = $conn->prepare("INSERT INTO orders (user_id, email, phone, total_amount, shipping_address, status) 
                            VALUES (?, ?, ?, ?, ?, 'Pending')");
    $stmt->bind_param("issds", $user_id, $email, $phone, $total_amount, $address);
    if ($stmt->execute()) {
        echo "Order placed successfully!"; // Success message
        // Optionally clear cart here
        unset($_SESSION['cart']);
    } else {
        echo "Error placing order!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .order-container {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        .order-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .order-container input, .order-container textarea, .order-container select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .order-container button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .order-container button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="order-container">
        <h2>Order Details</h2>

        <!-- Order Form -->
        <form method="POST" action="order.php">
            <label>Email:</label>
            <input type="email" name="email" value="<?php echo $_SESSION['email']; ?>" required><br>

            <label>Phone:</label>
            <input type="text" name="phone" required><br>

            <label>Shipping Address:</label>
            <textarea name="address" required></textarea><br>

            <label>Delivery Area:</label>
            <select name="delivery_area" required>
                <option value="Dhaka">Inside Dhaka</option>
                <option value="Outside Dhaka">Outside Dhaka</option>
            </select><br>

            <button type="submit">Place Order</button>
        </form>
    </div>
</body>
</html>
