
<?php

include '../database/db_connection.php';
session_start();
require '../jwt_helper.php';

if (!isset($_SESSION['jwt']) || !decodeJWT($_SESSION['jwt'])) {
    header("Location: ../pages/auth/login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $member_name = $_POST['member_name'] ?? '';
    $type = $_POST['type'] ?? '';
    $start_date = $_POST['start_date'] ?? '';
    $price = (float) ($_POST['price'] ?? 0);

    if (empty($member_name) || empty($type) || empty($start_date) || $price <= 0) {
        echo "All fields are required and price must be greater than 0.";
        exit;
    }

    $db = connectDatabase();

    $stmt = $db->prepare("INSERT INTO memberships (member_name, type, start_date, price) 
                          VALUES (:member_name, :type, :start_date, :price)");

    $stmt->bindValue(':member_name', $member_name);
    $stmt->bindValue(':type', $type);
    $stmt->bindValue(':start_date', $start_date);
    $stmt->bindValue(':price', $price, SQLITE3_FLOAT);

    if ($stmt->execute()) {
        header("Location: ../index.php");
        exit;
    } else {
        echo "Error adding membership: " . $db->lastErrorMsg();
    }

    $db->close();
} else {
    echo "Invalid request method.";
}

?>
