<?php
// Verbindung zur Datenbank mit PDO herstellen
include "dbConfigJosef.php";
session_start(); // Session starten

$username = $_SESSION['username'] ?? null;

if (!$username) {
    die("Fehler: Kein Benutzername in der Session gefunden.");
}

try {
    // Request of Account_ID from username
    $stmt = $pdo->prepare("SELECT Account_ID FROM user_account WHERE username = :username");
    $stmt->bindParam(":username", $username, PDO::PARAM_STR);
    $stmt->execute();
    $dbResult = $stmt->fetch(PDO::FETCH_ASSOC);

    // if request successful, storing the variables in session
    if ($dbResult ==true ) {
        $_SESSION["eingeloggt"]   = true;
        $_SESSION["username"]     = $username;
        $_SESSION["account_id"]   = $dbResult["Account_ID"]; 

        // if booking is started, heading to booking otherwise to Landingpage
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
    