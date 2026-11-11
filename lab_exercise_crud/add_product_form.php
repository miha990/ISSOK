<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
</head>
<body>
<form action="add_product.php" method="POST">
    <label for="name">Name:</label>
    <input type="text" name="name" id="name" required>
    <br />
    <label for="category">Category:</label>
    <select name="category" id="category" required>
        <option value="">Select category</option>
        <option value="Electronics">Electronics</option>
        <option value="Food">Food</option>
        <option value="Clothing">Clothing</option>
    </select>
    <br />
    <label for="quantity">Quantity:</label>
    <input type="number" name="quantity" id="quantity" required>
    <br />

    <label for="price">Price:</label>
    <input type="number" name="price" id="price" step="0.01" min="0.01" required>
    <br />

    <label for="supplier">Supplier:</label>
    <input type="text" name="supplier" id="supplier" required>
    <br />

    <button type="submit">Add Product</button>
</form>
</body>