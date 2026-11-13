
<?php
session_start();
require '../jwt_helper.php';

if (!isset($_SESSION['jwt']) || !decodeJWT($_SESSION['jwt'])) {
    header("Location: ../pages/auth/login.php");
    exit;
}
?>

<form action="../handlers/create_handler.php" method="POST">
    <label for="member_name">Member name:</label>
    <input type="text" name="member_name" id="member_name" required>
    <br />

    <label for="type">Membership type:</label>
    <select name="type" id="type" required>
        <option value="Monthly">Monthly</option>
        <option value="Yearly">Yearly</option>
    </select>
    <br />

    <label for="start_date">Start date:</label>
    <input type="date" name="start_date" id="start_date" required>
    <br />

    <label for="price">Price:</label>
    <input type="number" name="price" id="price" step="0.01" min="0.01" required>
    <br />

    <button type="submit">Add Membership</button>
</form>
