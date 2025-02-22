<?php
session_start();
$servername=$_SERVER['SERVER_NAME'];
$serverusername="root";
// $serverpassword="123456";
$dbname="benutzer";
$conn = new mysqli("$servername", "$serverusername", "", "$dbname");

if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $passwort = $_POST["passwort"];

    // Benutzer in der Datenbank suchen
    $stmt = $conn->prepare("SELECT passwort_hash FROM benutzer WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($passwort_hash);
        $stmt->fetch();

        // Passwort überprüfen
        if (password_verify($passwort, $passwort_hash)) {
            $_SESSION["eingeloggt"] = true;
            $_SESSION["username"] = $username;
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Falsches Passwort!";
        }
    } else {
        echo "Benutzer nicht gefunden!";
    }
}
?>
