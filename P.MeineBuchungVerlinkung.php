
<?php
include 'dbConfigJosef.php'; // Stellt sicher, dass die $pdo-Verbindung vorhanden ist

// Sicherstellen, dass der Benutzer eingeloggt ist und eine Benutzer-ID vorhanden ist
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['account_id'])) {
    echo "<p>Bitte melden Sie sich an, um Ihre Buchungen zu sehen.</p>";
    exit;
}

$user_id = $_SESSION['account_id']; // ID des aktuellen Benutzers




try {
    // SQL-Abfrage um die Buchungen aus contract anzuzeigen
    $sql = "SELECT c.Contract_ID AS buchungsnummer, 
                   c.Start_Date AS abholdatum, 
                   c.End_Date AS rueckgabedatum, 
                   m.Name AS fahrzeug, 
                   c.DateOfBooking AS buchungsdatum 
            FROM contract c
            JOIN car ca ON c.Car_ID = ca.Car_ID
            JOIN model m ON ca.Type_ID = m.Type_ID
            WHERE c.Account_ID = :user_id";



    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $buchungen = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($buchungen) {
        foreach ($buchungen as $row) {
            echo '<div class="card">';
            echo '<div class="bookingnumber-div"><p>' . htmlspecialchars($row["buchungsnummer"]) . '</p></div>';
            echo '<div class="pickup-retunr-dates-div"><p>' .htmlspecialchars($row["abholdatum"]) . '</p></div>';
            echo '<div class="pickup-retunr-dates-div"><p>' . htmlspecialchars($row["rueckgabedatum"]) . '</p></div>';
            echo '<div class="booked-vehicle-div"><p>' . htmlspecialchars($row["fahrzeug"]) . '</p></div>';
            echo '<div class="booked-on-div"><p>' . htmlspecialchars($row["buchungsdatum"]) . '</p></div>';
            echo '</div>';
        }
    } else {
        echo "<p>Keine Buchungen gefunden :(</p>";
    }
} catch (PDOException $e) {
    echo "<p>SQL Fehler: " . $e->getMessage() . "</p>";
}
?>

