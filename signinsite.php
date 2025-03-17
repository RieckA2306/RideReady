<!-- This script will open when the user clicks the "Noch kein Konto" (No account yet) button on Loginsite.php -->

<!DOCTYPE html>
<html lang="de"> <!-- Sets the document language to German -->
<head>
    <meta charset="UTF-8"> <!-- Ensures correct character encoding -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Makes the page responsive -->
    <title>Sign In</title>

    <!-- Links an external CSS file with a version parameter to prevent caching issues -->
    <link rel="stylesheet" href="RideReady.css?v=1.1">
</head>

<body class="signin-body">

    <!-- Includes the header section -->
    <?php  define('ALLOW_HEADER_INCLUDE', true);
    include 'Header.php'; ?>


     <!-- User registration form that submits data via POST to signin.php -->
      
    <form class="form-container" action="signin.php" method="POST">
        <input type="text" id="vorname" name="firstname" placeholder="Vorname" required>
        <input type="text" id="nachname" name="lastname" placeholder="Nachname" required>
        <input type="text" id="username" name="username" placeholder="Username" required>
        <input type="email" id="email" name="email" placeholder="Email Adresse" required>
        <input type="password" id="passwort" name="password" placeholder="Passwort" required>
        <button type="submit">Konto erstellen</button>
    </form>

    <!-- Includes the footer section -->
    <?php define('ALLOW_FOOTER_INCLUDE', true);
    include 'Footer.php';
     ?>

</body>
</html>
