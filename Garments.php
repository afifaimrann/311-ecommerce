<?php
require 'database.php'; // Include the database connection file
session_start(); // Start session to manage cart

$categoryId = isset($_GET['category_id']) ? (int) $_GET['category_id'] : 0;

if ($categoryId == 0) {
    die("Invalid category.");
}

try {
    $stmtCategory = $conn->prepare("SELECT name FROM categories WHERE id = ?");
    $stmtCategory->bind_param("i", $categoryId);
    $stmtCategory->execute();
    $resultCategory = $stmtCategory->get_result();
    $category = $resultCategory->fetch_assoc();

    if (!$category) {
        die("Category not found.");
    }

    $stmtProducts = $conn->prepare("SELECT p.id, p.name, p.description, p.price, p.image, p.stock_quantity 
                                    FROM products as p 
                                    JOIN categories as c 
                                    ON p.category_id = c.id 
                                    WHERE p.category_id = ?");
    $stmtProducts->bind_param("i", $categoryId); // "i" stands for integer
    $stmtProducts->execute();
    $resultProducts = $stmtProducts->get_result();
    $products = $resultProducts->fetch_all(MYSQLI_ASSOC);
} catch (mysqli_sql_exception $e) {
    echo "Error: " . $e->getMessage();
}

// Handle adding products to cart directly in this file
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $quantity = (int) $_POST['quantity'];

    // Initialize cart if not exists
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Check if product already exists in cart
    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] == $product_id) {
            $item['quantity'] += $quantity; // Update quantity
            $item['total'] = $item['quantity'] * $item['price']; // Update total
            $found = true;
            break;
        }
    }

    // If the product is not in the cart, add it
    if (!$found) {
        $_SESSION['cart'][] = [
            "id" => $product_id,
            "name" => $product_name,
            "price" => $product_price,
            "quantity" => $quantity,
            "total" => $product_price * $quantity,
            "image" => $product_image
        ];
    }

    // Display a success message
    echo "<p style='color: green;'>Product added to cart successfully!</p>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products - <?= htmlspecialchars($category['name']); ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Products in <?= htmlspecialchars($category['name']); ?></h1>

    <div class="product-list">
        <?php
        if (!empty($products)) {
            foreach ($products as $product) {
                echo '<div class="product">';
                echo '  <div class="product-img" style="background-image: url(\'' . htmlspecialchars($product['image']) . '\');"></div>';
                echo '  <h2>' . htmlspecialchars($product['name']) . '</h2>';
                echo '  <p>' . htmlspecialchars($product['description']) . '</p>';
                echo '  <p>Price: $' . htmlspecialchars($product['price']) . '</p>';
                echo '  <p>In stock :' . htmlspecialchars($product['stock_quantity']) . '</p>';
                echo '  <form method="POST" action="">';
                echo '      <input type="hidden" name="product_id" value="' . htmlspecialchars($product['id']) . '">';
                echo '      <input type="hidden" name="product_name" value="' . htmlspecialchars($product['name']) . '">';
                echo '      <input type="hidden" name="product_price" value="' . htmlspecialchars($product['price']) . '">';
                echo '      <input type="hidden" name="product_image" value="' . htmlspecialchars($product['image']) . '">';
                echo '      <input type="number" name="quantity" value="1" min="1" max="' . htmlspecialchars($product['stock_quantity']) . '">';
                echo '      <button type="submit" name="add_to_cart">Add to Cart</button>';
                echo '  </form>';
                echo '</div>';
            }
        } else {
            echo '<p>No products available in this category.</p>';
        }
        ?>
    </div>

    <a href="cart.php">Go to Cart</a>
</body>
</html>
