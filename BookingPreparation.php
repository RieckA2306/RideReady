<?php
session_start();
// getting the right car_ID from URL and put it in a session 
// if bookingcar_id is set the booking proccess is started 
$car_id=$_SERVER['QUERY_STRING'];
$_SESSION['bookingcar_id']=$car_id;

// check if customer is already loged in if yes user is sent to login otherwise to booking 
if (isset($_SESSION["eingeloggt"])) {
    header('location:UserControl.php');
    exit();
 

} else {
    header('location:loginsite.php');
    exit();
}

?>

