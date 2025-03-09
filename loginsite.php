<!DOCTYPE html>
<html lang="de">
<head>
    <title>Login</title>
    <link rel="stylesheet" href="P.RideReadyProductoverview.css?v=1.1">

</head>
<body class="login-body">
<?php include 'P.RideReadyHeader.php'; ?>
    <form class="login-container" action="login.php" method="POST">
        <label>Username:</label>
        <input type="text" name="username" required>
        <br>
        <label>Passwort:</label>
        <input type="password" name="passwort" required>
        <br>
        <button type="submit">Login</button>
        <a href="signinsite.php">Noch Kein Konto?</a>
    </form>
    <?php include 'P.RideReadyFooter.php'; ?>
</body>
</html>
