<?php
session_start();

// Datenbankverbindung herstellen
$servername = "localhost"; 
$username = "Adorjan";
$password = "1234";
$dbname = "ridereadydb";

// Session-Variablen abfragen
$city = $_SESSION['city'] ?? '';
$pickupdate = $_SESSION['pickupdate'] ?? '';
$returndate = $_SESSION['returndate'] ?? '';

try {
    // PDO-Verbindung herstellen
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // SQL-Abfrage direkt mit eingebauten Variablen (ohne Prepared Statements)
    $sql = "SELECT car_id
            FROM Car
            WHERE loc_name = '$city'
            AND car_id NOT IN (
                SELECT car_id
                FROM Contract
                WHERE (start_date <= '$returndate' AND end_date >= '$pickupdate')
            )";

    // Abfrage ausführen
    $stmt = $pdo->query($sql);
    $freieAutos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Ergebnisse ausgeben
    if (count($freieAutos) > 0) {
        echo "<h3>Verfügbare Autos in " . htmlspecialchars($city) . ":</h3><ul>";
        foreach ($freieAutos as $auto) {
            echo "<li>Auto-ID: " . htmlspecialchars($auto['car_id']) . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>Keine verfügbaren Autos für den angegebenen Zeitraum.</p>";
    }

} catch (PDOException $e) {
    echo "Fehler bei der Datenbankabfrage: " . $e->getMessage();
}

// Verbindung schließen (optional bei PDO, da PHP das automatisch macht)
$pdo = null;
?>