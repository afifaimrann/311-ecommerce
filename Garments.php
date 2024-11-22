<?php
require 'database.php'; // Include the database connection file
session_start(); // Start session to manage cart (CHANGED: Added session start here)
$categoryId = isset($_GET['category_id']) ? (int) $_GET['category_id'] : 0;

if ($categoryId == 0) {
    die("Invalid category.");
}
try{
    $stmtCategory = $conn->prepare("SELECT name FROM categories WHERE id = ?");
    $stmtCategory->bind_param("i", $categoryId);
    $stmtCategory->execute();
    $resultCategory=$stmtCategory->get_result();
    $category = $resultCategory->fetch_assoc();

    if (!$category) {
        die("Category not found.");
    }
    $stmtProducts = $conn->prepare("SELECT p.id,p.name,p.description,p.price,p.image,p.stock_quantity FROM products as p join categories as c on p.category_id=c.id WHERE p.category_id = ?");
    $stmtProducts->bind_param("i", $categoryId); // "i" stands for integer
    $stmtProducts->execute();
    $resultProducts = $stmtProducts->get_result();
    $products = $resultProducts->fetch_all(MYSQLI_ASSOC);
} catch (mysqli_sql_exception $e) {
    echo "Error: " . $e->getMessage();
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
            
                echo '  <form method="POST" action="add_to_cart.php">';
                echo '      <input type="hidden" name="product_id" value="' . htmlspecialchars($product['id']) . '">';
                echo '      <input type="hidden" name="product_name" value="' . htmlspecialchars($product['name']) . '">';
                echo '      <input type="hidden" name="product_price" value="' . htmlspecialchars($product['price']) . '">';
                echo '      <input type="hidden" name="product_image" value="' . htmlspecialchars($product['image']) . '">';
                echo '      <input type="number" name="quantity" value="1" min="1" max="' . htmlspecialchars($product['stock_quantity']) . '">';
                echo '      <button type="submit">Add to Cart</button>';
                echo '  </form>';
                echo '</div>';

            }
        } else {
            echo '<p>No products available in this category.</p>';
        }
        ?>
    </div>
</body>
</html>
