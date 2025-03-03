<?php
session_start();
// $_SESSION['bookingstart']=1;
$car_id=$_SESSION['bookingcar_id'];

// Prüfen, ob der Nutzer eingeloggt ist
if (isset($_SESSION["eingeloggt"])) {
    // Datenbank-Konfiguration einbinden
    include('dbConfigJosef.php');

    // Session-Variablen abfragen (zur Sicherheit mit Null coalescing operator)
    $pickupdate = $_SESSION['pickupdate'] ?? '';
    $returndate = $_SESSION['returndate'] ?? '';
  
    echo"$car_id";
    $account_id=$_SESSION["account_id"];
    try {
        // SQL-Abfrage zum Einfügen eines neuen Vertrags
        $sql = "INSERT INTO contract (Start_Date, End_Date, Account_ID, Car_ID) 
                VALUES (:pickupdate, :returndate, :account_id, :car_id)";

        // Parameter-Array
        $params = [
            ':pickupdate' => $pickupdate,
            ':returndate' => $returndate,   
            ':account_id' => $account_id,
            ':car_id' => $car_id,
        ];

        // Prepared Statement erstellen
        $stmt = $pdo->prepare($sql);

        // SQL ausführen
        if ($stmt->execute($params)) {
            echo "Neue Verträge wurden erfolgreich hinzugefügt.";
            
        } else {
            echo "Fehler beim Hinzufügen des Vertrags.";
        }

    } catch (PDOException $e) {
        die("Datenbankfehler: " . $e->getMessage());
    }
} else {
    // Weiterleitung, wenn der Nutzer nicht eingeloggt ist
    header("Location: loginsite.php");
    exit;
}
?>
