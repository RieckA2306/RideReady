<?php
// Verbindung zur Datenbank mit PDO herstellen
include "dbConfigJosef.php";
session_start(); // Session starten

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $passwort = $_POST["passwort"];

    try {
        // SQL-Statement vorbereiten
        $stmt = $pdo->prepare("SELECT Account_ID, Password FROM user_account WHERE username = :username");
        
        // Parameter binden
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        
        // Statement ausführen
        $stmt->execute();

        // Ergebnis abrufen
        $dbResult = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dbResult) {
            // Passwort überprüfen
            if (password_verify($passwort, $dbResult["Password"])) {
              header('Location:UserControl.php');
              $_SESSION['username']=$username;
              exit();
            } else {
                echo "Falsches Passwort!";
            }
        } else {
            echo "Benutzer nicht gefunden!";
        }
    } catch (PDOException $e) {
        die("Fehler bei der Datenbankabfrage: " . $e->getMessage());
    }
}
?>
