
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>signin</title>
    <link rel="stylesheet" href="P.RideReadyProductoverview.css?v=1.1">

</head>

<body class="signin-body">
    <?php include 'P.RideReadyHeader.php'; ?>
    <form class="form-container" action="signin.php" method="POST">
        <input type="text" id="vorname" name="firstname" placeholder="Vorname" required     >
        <input type="text" id="nachname" name="lastname" placeholder="Nachname" required>
        <input type="text" id="username" name="username" placeholder="Username" required>
        <input type="email" id="email" name="email" placeholder="Email Adresse" required>
        <input type="password" id="passwort" name="password" placeholder="Passwort" required>
        <button type="submit">Konto erstellen</button>
    </form>
    <?php include 'P.RideReadyFooter.php'; ?>
</body>
</html>