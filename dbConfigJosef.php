<?php

$servername = $_SERVER['SERVER_NAME'];
$username = "RideReadyAdmin";
$password = "1234";
$dbname = "ridereadydb";

// Variablen für den Zeitraum
$startDatum = '2025-03-25';
$endDatum = '2025-03-28';


try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
} catch (PDOException $e) {
    die("Datenbankverbindung fehlgeschlagen: " . $e->getMessage());
}

// 2️⃣ Variablen für den Zeitraum (dynamisch anpassbar)
$startDatum = '2025-03-25';
$endDatum = '2025-03-28';

// 3️⃣ SQL-Abfrage mit Prepared Statements
$sql = "SELECT c.car_id 
        FROM Car c
        JOIN model m ON c.type_id = m.type_id
        WHERE c.loc_name = 'Berlin'
        AND m.gps = 1
        AND c.car_id NOT IN (
            SELECT car_id 
            FROM Contract 
            WHERE NOT (end_date < ? OR start_date > ?)
        )";

// 4️⃣ Prepared Statement vorbereiten und ausführen
$stmt = $pdo->prepare($sql);
$stmt->execute([$startDatum, $endDatum]);

// 5️⃣ Ergebnisse abrufen
$freieAutos = $stmt->fetchAll();

// 6️⃣ Ergebnisse ausgeben
if (count($freieAutos) > 0) {
    echo "<h3>Freie Autos mit GPS in Berlin:</h3><ul>";
    foreach ($freieAutos as $auto) {
        echo "<li>Auto-ID: " . htmlspecialchars($auto['car_id']) . "</li>";
    }
    echo "</ul>";
} else {
    echo "<p>Keine freien Autos mit angegebenen Parametern für den angegebenen Zeitraum.</p>";
}
?>

