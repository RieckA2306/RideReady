<?php
include 'dbconfigsalwa.php';

$sql = "SELECT c.Contract_ID AS buchungsnummer, 
               c.Start_Date AS abholdatum, 
               c.End_Date AS rueckgabedatum, 
               m.Name AS fahrzeug, 
               c.Start_Date AS buchungsdatum 
        FROM contract c
        JOIN car ca ON c.Car_ID = ca.Car_ID
        JOIN model m ON ca.Type_ID = m.Type_ID";

$result = $conn->query($sql);


if (!$result) {
    die("SQL Fehler: " . $conn->error);
}

if ($result->num_rows > 0) {
    //itterating over the infos
    while ($row = $result->fetch_assoc()) {
        echo '<div class="card">';
        echo '<div class="bookingnumber-div"><p>' . htmlspecialchars($row["buchungsnummer"]) . '</p></div>';
        echo '<div class="pickup-retunr-dates-div"><p>' . htmlspecialchars($row["abholdatum"]) . '</p></div>';
        echo '<div class="pickup-retunr-dates-div"><p>' . htmlspecialchars($row["rueckgabedatum"]) . '</p></div>';
        echo '<div class="booked-vehicle-div"><p>' . htmlspecialchars($row["fahrzeug"]) . '</p></div>';
        echo '<div class="booked-on-div"><p>' . htmlspecialchars($row["buchungsdatum"]) . '</p></div>';
        echo '</div>';
    }
} else {
    echo "<p>Keine Buchungen gefunden:(</p>";
}

$conn->close();
?>
