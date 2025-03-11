<?php
// Verbindung zur Datenbank mit PDO herstellen
include "dbConfigJosef.php";
session_start(); // Session starten

$username = $_SESSION['username'] ?? null;

if (!$username) {
    die("Fehler: Kein Benutzername in der Session gefunden.");
}

try {
    // SQL-Statement mit FROM korrigieren
    $stmt = $pdo->prepare("SELECT Account_ID FROM user_account WHERE username = :username");

    // Parameter binden
    $stmt->bindParam(":username", $username, PDO::PARAM_STR);

    // Statement ausführen
    $stmt->execute();

    // Ergebnis abrufen
    $dbResult = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($dbResult !== false) {
        // Session-Variablen setzen
        $_SESSION["eingeloggt"]   = true;
        $_SESSION["username"]     = $username;
        $_SESSION["account_id"]   = $dbResult["Account_ID"]; // Korrekte Schreibweise beachten

        // Weiterleitung
        if (isset($_SESSION['bookingcar_id'])) {
            header("Location: booking.php");
        } else {
            header("Location: P.RideReady.Landingpage.php");
        }
        exit(); // Nach header() immer exit();
    } else {
        die("Fehler: Benutzer nicht gefunden.");
    }
} catch (PDOException $e) {
    die("Fehler bei der Datenbankabfrage: " . $e->getMessage());
}
?>
    