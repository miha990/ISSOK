
<?php

include './database/db_connection.php';
include './jwt_helper.php';

session_start();

if (!isset($_SESSION['jwt']) || !decodeJWT($_SESSION['jwt'])) {
    $_SESSION['error'] = "Немате пристап.";
    header("Location: pages/auth/login.php");
    exit;
}

$decoded = decodeJWT($_SESSION['jwt']);
$username = $decoded->username;

$db = connectDatabase();

$query = "SELECT * FROM memberships";
$result = $db->query($query);

if (!$result) {
    die("Error fetching memberships: " . $db->lastErrorMsg());
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Memberships List</title>

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
            text-align: left;
        }
    </style>
</head>

<body>

<div style="display: flex; align-items: center; justify-content: space-between">
    <h1>Memberships List</h1>

    <div>
        <p>Logged in as: <?php echo htmlspecialchars($username); ?></p>

        <a href="pages/create.php">Add Membership</a>

        <a href="handlers/auth/logout_handler.php">Logout</a>
    </div>
</div>

<?php
if (isset($_SESSION['error'])) {
    echo "<p>" . htmlspecialchars($_SESSION['error']) . "</p>";
    unset($_SESSION['error']);
}
?>

<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Member Name</th>
        <th>Type</th>
        <th>Start Date</th>
        <th>Expiration Date</th>
        <th>Price</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>
    </thead>

    <tbody>

    <?php if ($result): ?>

        <?php while ($membership = $result->fetchArray(SQLITE3_ASSOC)): ?>

            <?php

            $start_date = new DateTime($membership['start_date']);

            if ($membership['type'] === 'Monthly') {
                $start_date->modify('+1 month');
            } else {
                $start_date->modify('+1 year');
            }

            $expiration_date = $start_date->format('Y-m-d');
            $today = date('Y-m-d');

            if ($expiration_date >= $today) {
                $status = 'Active';
            } else {
                $status = 'Expired';
            }

            ?>

            <tr>
                <td><?php echo htmlspecialchars($membership['id']); ?></td>

                <td><?php echo htmlspecialchars($membership['member_name']); ?></td>

                <td><?php echo htmlspecialchars($membership['type']); ?></td>

                <td><?php echo htmlspecialchars($membership['start_date']); ?></td>

                <td><?php echo htmlspecialchars($expiration_date); ?></td>

                <td><?php echo htmlspecialchars($membership['price']); ?></td>

                <td><?php echo htmlspecialchars($status); ?></td>

                <td>
                    <form action="handlers/delete_handler.php" method="post" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo $membership['id']; ?>">
                        <button type="submit">Delete</button>
                    </form>

                    <form action="pages/edit.php" method="get" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo $membership['id']; ?>">
                        <button type="submit">Update</button>
                    </form>
                </td>
            </tr>

        <?php endwhile; ?>

    <?php else: ?>

        <tr>
            <td colspan="8">No memberships found.</td>
        </tr>

    <?php endif; ?>

    </tbody>
</table>

</body>
</html>

<?php
$db->close();
?>
