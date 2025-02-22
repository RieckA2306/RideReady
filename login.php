<?php
session_start();
$conn = new mysqli("localhost", "root", "", "benutzer");

if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $benutzername = $_POST["benutzername"];
    $passwort = $_POST["passwort"];

    // Benutzer in der Datenbank suchen
    $stmt = $conn->prepare("SELECT passwort_hash FROM benutzer WHERE benutzername = ?");
    $stmt->bind_param("s", $benutzername);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($passwort_hash);
        $stmt->fetch();

        // Passwort überprüfen
        if (password_verify($passwort, $passwort_hash)) {
            $_SESSION["eingeloggt"] = true;
            $_SESSION["benutzername"] = $benutzername;
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
