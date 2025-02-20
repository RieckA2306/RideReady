<?php
session_start();
if (!isset($_SESSION["eingeloggt"])) {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <title>Dashboard</title>
</head>
<body>
<?php include 'P.RideReadyHeader.php'; ?>
    <h2>Willkommen, <?php echo htmlspecialchars($_SESSION["benutzername"]); ?>!</h2>
    <a href="logout.php">Logout</a>
</body>
</html>
