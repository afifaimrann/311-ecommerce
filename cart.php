<?php
session_start();
include 'database.php';

// Initialize cart if not exists
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Add product to cart
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name']; // Added product name
    $product_price = $_POST['product_price']; // Added product price
    $product_image = $_POST['product_image']; // Added product image
    $quantity = (int) $_POST['quantity']; // Ensure quantity is an integer

    // Validate quantity (default to 1 if invalid)
    if ($quantity < 1) {
        $quantity = 1;
    }

    // Add the product details to the cart
    $item = [
        "id" => $product_id,
        "name" => $product_name,
        "price" => $product_price,
        "quantity" => $quantity,
        "total" => $product_price * $quantity,
        "image" => $product_image // Added image for display
    ];

    $_SESSION['cart'][] = $item; // Add item to session cart
}

// Remove product from cart
if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    unset($_SESSION['cart'][$remove_id]);
    $_SESSION['cart'] = array_values($_SESSION['cart']); // Reindex array
}

// Clear cart
if (isset($_POST['clear_cart'])) {
    $_SESSION['cart'] = [];
    header("Location: index.php"); // Redirect to the front page
    exit();
}

// Calculate total
$total = 0;
foreach ($_SESSION['cart'] as $item) {
    $total += $item['total'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <!-- Link to the CSS file for styling -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Your Cart</h1>
    <table>
        <thead>
            <tr>
                <th>Image</th> <!-- Added for product image -->
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($_SESSION['cart'] as $index => $item): ?>
                <tr>
                    <td><img src="<?= htmlspecialchars($item['image']) ?>" alt="Product Image" style="width: 50px; height: 50px;"></td> <!-- Display product image -->
                    <td><?= htmlspecialchars($item['name']) ?></td>
                    <td><?= number_format($item['price'], 2) ?></td>
                    <td><?= htmlspecialchars($item['quantity']) ?></td>
                    <td><?= number_format($item['total'], 2) ?></td>
                    <td><a href="cart.php?remove=<?= $index ?>">Remove</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <h2>Total: <?= number_format($total, 2) ?></h2>

    <form method="POST">
        <button type="submit" name="clear_cart">Clear Cart</button>
        <button type="submit" name="place_order">Place Order</button>
    </form>
     <!-- Add More Products Button -->
     <a href="index.php"><button type="button">Add More Products</button></a>
</body>
</html>
