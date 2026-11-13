
<?php

include '../database/db_connection.php';
include '../jwt_helper.php';

session_start();

if (!isset($_SESSION['jwt']) || !decodeJWT($_SESSION['jwt'])) {
    $_SESSION['error'] = "Немате пристап.";
    header("Location: ../pages/auth/login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {

    $id = (int) $_POST['id'];

    $db = connectDatabase();

    $stmt = $db->prepare("SELECT * FROM memberships WHERE id = :id");
    $stmt->bindValue(':id', $id, SQLITE3_INTEGER);

    $result = $stmt->execute();
    $membership = $result->fetchArray(SQLITE3_ASSOC);

    if ($membership) {

        $start_date = new DateTime($membership['start_date']);

        if ($membership['type'] === 'Monthly') {
            $start_date->modify('+1 month');
        } else {
            $start_date->modify('+1 year');
        }

        $expiration_date = $start_date->format('Y-m-d');
        $today = date('Y-m-d');

        if ($expiration_date >= $today) {

            $_SESSION['error'] = "Активна членарина не може да се избрише.";

        } else {

            $delete_stmt = $db->prepare("DELETE FROM memberships WHERE id = :id");
            $delete_stmt->bindValue(':id', $id, SQLITE3_INTEGER);
            $delete_stmt->execute();

        }

    }

    $db->close();

    header("Location: ../index.php");
    exit;

} else {
    echo "Invalid request.";
}

?>
