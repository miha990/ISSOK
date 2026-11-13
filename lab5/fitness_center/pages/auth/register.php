
<?php

session_start();
require '../../jwt_helper.php';

if (isset($_SESSION['jwt']) && decodeJWT($_SESSION['jwt'])) {
    header("Location: ../../index.php");
    exit;
}

?>

<div>
    <h2>Register</h2>

    <form action="../../handlers/auth/register_handler.php" method="POST">

        <div class="mb-4">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" required>
        </div>

        <div class="mb-4">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" minlength="6" required>
        </div>

        <div class="mb-4">
            <label for="confirm_password">Confirm password</label>
            <input type="password" name="confirm_password" id="confirm_password" required>
        </div>

        <button type="submit">Register</button>

        <p>
            <a href="login.php">Login here</a>
        </p>

    </form>
</div>
