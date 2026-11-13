
<?php

include '../database/db_connection.php';
require '../jwt_helper.php';

session_start();

if (!isset($_SESSION['jwt']) || !decodeJWT($_SESSION['jwt'])) {
    header("Location: ../pages/auth/login.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $db = connectDatabase();

    $stmt = $db->prepare("SELECT * FROM memberships WHERE id = :id");
    $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
    $result = $stmt->execute();
    $membership = $result->fetchArray(SQLITE3_ASSOC);

    $db->close();
} else {
    die("Invalid membership ID.");
}

?>

<h1>Update Membership</h1>

<?php if ($membership): ?>

    <form action="../handlers/edit_handler.php" method="POST">

        <input type="hidden" name="id" value="<?php echo htmlspecialchars($membership['id']); ?>">

        <label for="member_name">Member name:</label>
        <input type="text" name="member_name" id="member_name" value="<?php echo htmlspecialchars($membership['member_name']); ?>" required>
        <br>

        <label for="type">Membership type:</label>
        <select name="type" id="type" required>
            <option <?php echo $membership['type'] === 'Monthly' ? 'selected' : ''; ?> value="Monthly">Monthly</option>
            <option <?php echo $membership['type'] === 'Yearly' ? 'selected' : ''; ?> value="Yearly">Yearly</option>
        </select>
        <br>

        <label for="start_date">Start date:</label>
        <input type="date" name="start_date" id="start_date" value="<?php echo htmlspecialchars($membership['start_date']); ?>" required>
        <br>

        <label for="price">Price:</label>
        <input type="number" name="price" id="price" step="0.01" min="0.01" value="<?php echo htmlspecialchars($membership['price']); ?>" required>
        <br>

        <button type="submit">Update Membership</button>

    </form>

<?php else: ?>

    <p>Membership not found.</p>

<?php endif; ?>
