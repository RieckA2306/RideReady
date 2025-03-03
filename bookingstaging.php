<?php
session_start();
// $_SESSION['bookingstart']=1;
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
