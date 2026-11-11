<?php
include 'db_connection.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $db = connectDatabase();

    // Fetch the current details of the product
    $stmt = $db->prepare("SELECT * FROM products WHERE id = :id");
    $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
    $result = $stmt->execute();
    $product = $result->fetchArray(SQLITE3_ASSOC);

    $db->close();
} else {
    die("Invalid product ID.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Product</title>
</head>
<body>
<h1>Update Product</h1>

<?php if ($product): ?>
    <form action="update_product.php" method="post">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($product['id']); ?>">
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required><br><br>
        <label for="category">Category:</label>
        <select name="category" id="category" required>
            <option value="Electronics" <?php if ($product['category'] == 'Electronics') echo 'selected'; ?>>Electronics</option>
            <option value="Food" <?php if ($product['category'] == 'Food') echo 'selected'; ?>>Food</option>
            <option value="Clothing" <?php if ($product['category'] == 'Clothing') echo 'selected'; ?>>Clothing</option>
        </select>
        <br><br>
        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" id="quantity"
               value="<?php echo htmlspecialchars($product['quantity']); ?>" min="0" required>
        <br><br>

        <label for="price">Price:</label>
        <input type="number" name="price" id="price"
               value="<?php echo htmlspecialchars($product['price']); ?>" step="0.01" min="0.01" required>
        <br><br>

        <label for="supplier">Supplier:</label>
        <input type="text" name="supplier" id="supplier"
               value="<?php echo htmlspecialchars($product['supplier']); ?>" required>
        <br><br>
        <button type="submit">Update Product</button>
    </form>
<?php else: ?>
    <p>Product not found.</p>
<?php endif; ?>
</body>
</html>