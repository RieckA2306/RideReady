<?php

include ('dbConfigJosef.php'); // Stelle sicher, dass $pdo dort richtig definiert ist

session_start(); // Falls noch nicht gestartet

$pickupdate = $_SESSION['pickupdate'] ?? '';
$returndate = $_SESSION['returndate'] ?? '';

try {
    // SQL-Abfrage zum Einfügen eines neuen Contracts
    $sql = "INSERT INTO contract (Start_Date, End_Date, Account_ID, Car_ID) 
            VALUES (:pickupdate, :returndate, :account_id, :car_id)";

    $params = [
        ':pickupdate' => $pickupdate,
        ':returndate' => $returndate,
        ':account_id' => 1, // Korrektur des Schreibfehlers
        ':car_id' => 1,
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

?>
