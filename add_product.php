<?php
// Include the database connection file
include 'db_connection.php';

// Check if the request method is POST to handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form values from the POST request, with basic validation
    $name = $_POST['name'] ?? '';
    $category = $_POST['category'] ?? '';
    $price = $_POST['price'] ?? '';
    $quantity = $_POST['quantity'] ?? '';
    $supplier = $_POST['supplier'] ?? '';

    // Validate required fields
    if (
        empty($name) ||
        empty($category) ||
        $quantity === '' ||
        $price === '' ||
        empty($supplier) ||
        !in_array($category, ['Electronics', 'Food', 'Clothing'], true) ||
        filter_var($quantity, FILTER_VALIDATE_INT) === false ||
        (int)$quantity < 0 ||
        !is_numeric($price) ||
        (float)$price <= 0
    ) {
        echo "Please fill in all required fields correctly.";
        exit;
    }


    // Connect to the SQLite database
    $db = connectDatabase();

    // Prepare and execute the insert statement
    $stmt = $db->prepare("INSERT INTO products (name, category , quantity ,price , supplier) VALUES (:name, :category, :quantity, :price, :supplier)");
    $stmt->bindValue(':name', $name, SQLITE3_TEXT);
    $stmt->bindValue(':category', $category, SQLITE3_TEXT);
    $stmt->bindValue(':quantity', $quantity, SQLITE3_INTEGER);
    $stmt->bindValue(':price', (float)$price, SQLITE3_FLOAT);
    $stmt->bindValue(':supplier', $supplier, SQLITE3_TEXT);

    // Execute the statement and check for success
    if ($stmt->execute()) {
        // Redirect back to the view page
        header("Location: index.php");
    } else {
        echo "Error adding product: " . $db->lastErrorMsg();
    }

    // Close the database connection
    $db->close();
} else {
    // If not a POST request, display an error message
    echo "Invalid request method. Please submit the form to add a product.";
}
?>