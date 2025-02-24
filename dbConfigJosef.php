<?php
// Datenbankverbindung
$pdo = new PDO('mysql:host=localhost;dbname=deine_datenbank', 'benutzername', 'passwort');

// Variablen für den Zeitraum
$startDatum = '2025-03-25';
$endDatum = '2025-03-28';

// SQL-Abfrage mit JOIN zur Modell-Tabelle und GPS-Filter
$sql = "SELECT c.car_id 
        FROM Car c
        JOIN Modell m ON c.type_id = m.type_id  -- Verknüpfung mit Modell-Tabelle
        WHERE c.loc_name = 'Berlin'
        AND m.gps = 1  -- Filter für Autos mit GPS
        AND c.car_id NOT IN (
            SELECT car_id 
            FROM Contract 
            WHERE NOT (end_date < ? OR start_date > ?)
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
