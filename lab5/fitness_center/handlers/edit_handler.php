
<?php

include '../database/db_connection.php';
session_start();
require '../jwt_helper.php';

if (!isset($_SESSION['jwt']) || !decodeJWT($_SESSION['jwt'])) {
    header("Location: ../pages/auth/login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $member_name = $_POST['member_name'] ?? '';
    $type = $_POST['type'] ?? '';
    $start_date = $_POST['start_date'] ?? '';
    $price = (float) ($_POST['price'] ?? 0);

    if (empty($member_name) || empty($type) || empty($start_date) || $price <= 0) {
        echo "All fields are required and price must be greater than 0.";
        exit;
    }

    $db = connectDatabase();

    $stmt = $db->prepare("UPDATE memberships SET member_name = :member_name, type = :type, start_date = :start_date, price = :price WHERE id = :id");

    $stmt->bindValue(':member_name', $member_name);
    $stmt->bindValue(':type', $type);
    $stmt->bindValue(':start_date', $start_date);
    $stmt->bindValue(':price', $price, SQLITE3_FLOAT);
    $stmt->bindValue(':id', $id, SQLITE3_INTEGER);

    $stmt->execute();

    $db->close();

    header("Location: ../index.php");
    exit();

} else {
    echo "Invalid request.";
}

?>
