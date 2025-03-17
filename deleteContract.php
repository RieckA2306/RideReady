<!-- This code is executed if the button "Löschen" on AllBookings_Admin.php is pushed  -->
<?php
session_start();
// getting Contract ID that is supposed to be deleted
$Contract_ID=$_SERVER['QUERY_STRING'];
    include('dbConfig.php');
if ($Contract_ID) {
    try {
        // SQL Delete-Statement
        $stmt = $pdo->prepare("DELETE FROM contract WHERE Contract_ID = :contract_id");
        $stmt->bindParam(':contract_id', $Contract_ID, PDO::PARAM_INT);
        $stmt->execute();

        // check if ID is deleted 
        if ($stmt->rowCount() > 0) {
            echo  ('<script>
            alert("Diese Buchung wurde erfolgreich storniert.");
            window.location.href = "AllBookings_Admin.php";
        </script>');
        } else {
            // in case someone refreshes the Site no error will occur 
            echo  ('<script>
            alert("Kein Eintrag mit dieser Contract_ID gefunde.");
            window.location.href = "AllBookings_Admin.php";
        </script>');
        }
        // in case there is a Database error 
    } catch (PDOException $e) {
        echo "Fehler beim Löschen: " . $e->getMessage();
    }
} else {
    // in case there is not a valid contract_id (should not happen)
    echo "Keine gültige Contract_ID übergeben.";
}
?>
