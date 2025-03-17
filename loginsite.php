<!-- 
 This script will open when a user clicks the "Login" button on overview.php
 or tries to book a car without logging in.
-->

<!DOCTYPE html>
<html lang="de"> <!-- Sets the language of the document to German -->
<head>
    <title>Login</title> <!-- Page title displayed in the browser tab -->

    <!-- Links an external CSS file for styling, with a version parameter to prevent caching issues -->
    <link rel="stylesheet" href="P.RideReadyProductoverview.css?v=1.1">
</head>

<body class="login-body"> <!-- Adds a CSS class for styling the login page -->

    <!-- Includes the header, likely containing navigation or branding -->
    <?php include 'Header.php'; ?>

    <!-- Login form that submits data via POST to login.php -->
    <form class="login-container" action="login.php" method="POST">
        <label>Username:</label>
        <input type="text" name="username" required> <!-- Input field for username -->

        <br>

        <label>Passwort:</label>
        <input type="password" name="passwort" required> <!-- Input field for password -->

        <br>

        <button type="submit">Login</button> <!-- Submit button for login -->

        <!-- Link to registration page for users without an account -->
        <a href="signinsite.php">Noch Kein Konto?</a>
    </form>

    <!-- Includes the footer, likely containing additional links or copyright info -->
    <?php include 'P.RideReadyFooter.php'; ?>

</body>
</html>
