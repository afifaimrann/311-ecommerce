
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Form</title>
</head>
<body>
<form method="POST" action="order.php">
    <label for="phone">Phone:</label>
    <input type="text" id="phone" name="phone" required>
    <br>
    <label for="address">Address:</label>
    <input type="text" id="address" name="address" required>
    <br>
    <label for="delivery_area">Delivery Area:</label>
    <select id="delivery_area" name="delivery_area" required>
        <option value="Dhaka">Dhaka</option>
        <option value="Outside Dhaka">Outside Dhaka</option>
    </select>
    <br>
    <button type="submit">Place Order</button>
</form>
</body>
</html>