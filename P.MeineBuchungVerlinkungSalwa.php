<?php
include 'dbConfigJosef.php';

// SQL-Abfrage vorbereiten
$sql = "SELECT c.Contract_ID AS buchungsnummer, 
               c.Start_Date AS abholdatum, 
               c.End_Date AS rueckgabedatum, 
               m.Name AS fahrzeug, 
               c.Start_Date AS buchungsdatum 
        FROM contract c
        JOIN car ca ON c.Car_ID = ca.Car_ID
        JOIN model m ON ca.Type_ID = m.Type_ID";

if ($result = $conn->query($sql)) {
    if ($result->num_rows > 0) {
        // Iteration durch alle Buchungen
        while ($row = $result->fetch_assoc()) {
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
} else {
    echo "<p>SQL Fehler: " . $conn->error . "</p>";
}

// Verbindung schließen
$conn->close();

// Funktion zum Formatieren des Datums (falls nötig)
function formatDate($date) {
    $timestamp = strtotime($date);
    return date('d.m.Y', $timestamp); // Format: Tag.Monat.Jahr
}
?>

