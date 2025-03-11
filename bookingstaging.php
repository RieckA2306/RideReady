<?php
session_start();

$car_id=$_SERVER['QUERY_STRING'];
$_SESSION['bookingcar_id']=$car_id;

// Prüfen, ob der Nutzer eingeloggt ist
if (isset($_SESSION["eingeloggt"])) {
    header('location:booking.php');
    exit();
 

} else {
    header('location:loginsite.php');
    exit();
}

?>

<?php
// Beispielbedingung: Popup nur anzeigen, wenn $showPopup true ist
 // Hier kannst du deine Bedingung setzen

?>
