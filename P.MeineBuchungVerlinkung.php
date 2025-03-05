<?php
include 'dbConfigJosef.php'; // Stellt sicher, dass die $pdo-Verbindung vorhanden ist

try {
    // SQL-Abfrage vorbereiten und ausführen
    $sql = "SELECT c.Contract_ID AS buchungsnummer, 
                   c.Start_Date AS abholdatum, 
                   c.End_Date AS rueckgabedatum, 
                   m.Name AS fahrzeug, 
                   c.Start_Date AS buchungsdatum 
            FROM contract c
            JOIN car ca ON c.Car_ID = ca.Car_ID
            JOIN model m ON ca.Type_ID = m.Type_ID";
    
    $stmt = $pdo->prepare($sql);  // PDO-Statement vorbereiten
    $stmt->execute();             // Statement ausführen
    $buchungen = $stmt->fetchAll(PDO::FETCH_ASSOC); // Alle Ergebnisse als assoziatives Array abrufen

    if ($buchungen) {
        foreach ($buchungen as $row) {
            // Ausgabe der Buchungsdaten
            echo '<div class="card">';
            echo '<div class="bookingnumber-div"><p>' . htmlspecialchars($row["buchungsnummer"]) . '</p></div>';
            echo '<div class="pickup-retunr-dates-div"><p>' . formatDate($row["abholdatum"]) . '</p></div>';
            echo '<div class="pickup-retunr-dates-div"><p>' . formatDate($row["rueckgabedatum"]) . '</p></div>';
            echo '<div class="booked-vehicle-div"><p>' . htmlspecialchars($row["fahrzeug"]) . '</p></div>';
            echo '<div class="booked-on-div"><p>' . formatDate($row["buchungsdatum"]) . '</p></div>';
            echo '</div>';
        }
    } else {
        echo "<p>Keine Buchungen gefunden :(</p>";
    }
} catch (PDOException $e) {
    echo "<p>SQL Fehler: " . $e->getMessage() . "</p>";
}

// Funktion zum Formatieren des Datums (falls nötig)
function formatDate($date) {
    $timestamp = strtotime($date);
    return date('d.m.Y', $timestamp); // Format: Tag.Monat.Jahr
}
?>
