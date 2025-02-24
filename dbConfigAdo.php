<?php
// Datenbankverbindung
$pdo = new PDO('mysql:host=localhost;
                dbname=ridereadydb', 
                'root', 
                'passwort');

// Variablen für den Zeitraum
$startDatum = '2025-03-25';
$endDatum = '2025-03-28';

// SQL-Abfrage mit JOIN zur Modell-Tabelle und GPS-Filter
$sql = "SELECT car_id 
        FROM Car 
        WHERE loc_name = $city
        AND car_id NOT IN (
            SELECT car_id 
            FROM Contract 
            WHERE (start_date <= $pickupdate AND end_date >= $returndate)
        )";

// Prepared Statement vorbereiten
$stmt = $pdo->prepare($sql);

// Platzhalter mit den Variablen ersetzen und ausführen
$stmt->execute([$startDatum, $endDatum]);

// Ergebnisse abrufen
$freieAutos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Ausgabe der freien Autos
foreach ($freieAutos as $auto) {
    echo "Freies Auto mit GPS: " . $auto['car_id'] . "<br>";
}
?>