<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $name = trim($_POST['name'] ?? '');
    $category = $_POST['category'] ?? '';
    $quantity = $_POST['quantity'] ?? '';
    $price = $_POST['price'] ?? '';
    $supplier = $_POST['supplier'] ?? '';
    $db = connectDatabase();

    // Update student details
    $stmt = $db->prepare("UPDATE products SET name = :name,
             category = :category,
             quantity = :quantity,
             price = :price,
             supplier = :supplier
         WHERE id = :id");

    $stmt->bindValue(':name', $name, SQLITE3_TEXT);
    $stmt->bindValue(':category', $category, SQLITE3_TEXT);
    $stmt->bindValue(':quantity', (int)$quantity, SQLITE3_INTEGER);
    $stmt->bindValue(':price', (float)$price, SQLITE3_FLOAT);
    $stmt->bindValue(':supplier', $supplier, SQLITE3_TEXT);
    $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
    $stmt->execute();

    // Close the database connection
    $db->close();

    // Redirect back to the view page
    header("Location: index.php");
    exit();
} else {
    echo "Invalid request.";
}
?>