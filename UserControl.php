<?php
include "dbConfig.php";
require_once 'Functions.php';
check_if_session_started();
// get username from session
$username = $_SESSION['username'] ?? null;

// check if user is already loged in 
if (!$username) {
    die("Fehler: Kein Benutzername in der Session gefunden. Gehe zurück zum Login!");
}

try {
    // Request of Account_ID from username
    $stmt = $pdo->prepare("SELECT Account_ID FROM user_account WHERE username = :username");
    $stmt->bindParam(":username", $username, PDO::PARAM_STR);
    $stmt->execute();
    $dbResult = $stmt->fetch(PDO::FETCH_ASSOC);

    // if request successful, storing the variables in session
    if ($dbResult ==true ) {
        $_SESSION["isloggedin"]   = true;
        $_SESSION["username"]     = $username;
        $_SESSION["account_id"]   = $dbResult["Account_ID"]; 

        // if booking is started, heading to booking otherwise to Landingpage
        if (isset($_SESSION['bookingcar_id'])) {
            header("Location: booking.php");
        } else {
            header("Location: Landingpage.php");
        }
        exit(); 
    } else {
        die("Fehler: Benutzer nicht gefunden.");
    }
} catch (PDOException $e) {
    die("Fehler bei der Datenbankabfrage: " . $e->getMessage());
}
?>
    