<?php
session_start();


$Contract_ID=$_SERVER['QUERY_STRING'];


    include('dbConfigJosef.php');



if ($Contract_ID) {
    try {
        // SQL DELETE-Anweisung vorbereiten
        $stmt = $pdo->prepare("DELETE FROM contract WHERE Contract_ID = :contract_id");

        // Statement mit Parameter binden und ausführen
        $stmt->bindParam(':contract_id', $Contract_ID, PDO::PARAM_INT);
        $stmt->execute();

        // Überprüfen, ob eine Reihe gelöscht wurde
        if ($stmt->rowCount() > 0) {
            echo "Datensatz mit Contract_ID " . htmlspecialchars($Contract_ID) . " erfolgreich gelöscht.";
        } else {
            echo "Kein Eintrag mit dieser Contract_ID gefunden.";
        }
    } catch (PDOException $e) {
        echo "Fehler beim Löschen: " . $e->getMessage();
    }
} else {
    echo "Keine gültige Contract_ID übergeben.";
}
?>
