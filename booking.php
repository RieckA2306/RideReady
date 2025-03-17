<?php
session_start();
// check if user is loged in 
if (isset($_SESSION["eingeloggt"])) {

    // request for session variable 
    $pickupdate = $_SESSION['pickupdate'] ?? '';
    $returndate = $_SESSION['returndate'] ?? '';
    $account_id=$_SESSION["account_id"];
    // gettig carId from session
    $car_id=$_SESSION['bookingcar_id'];

    // Connection to Database and Start SQL Insert
    include('dbConfig.php');

    try {
        // SQL-Request 
        $sql = "INSERT INTO contract (Start_Date, End_Date, Account_ID, Car_ID) 
                VALUES (:pickupdate, :returndate, :account_id, :car_id)";

        //varaibles for SQL-Request 
        $params = [
            ':pickupdate' => $pickupdate,
            ':returndate' => $returndate,   
            ':account_id' => $account_id,
            ':car_id' => $car_id,
        ];

        $stmt = $pdo->prepare($sql);

        // SQL Execution if succesful direction to my booking
        if ($stmt->execute($params)) {
            // deleting the bookingcar_id so double booking by opening booking.php is not possible
            unset($_SESSION['bookingcar_id']);
            header('Location:MyBookings.php');
        } else {
            echo "Fehler beim Hinzufügen des Vertrags.";
        }
    // error Message for Database errors 
    } catch (PDOException) {
        echo('<script>
            alert("Da ist wohl etwas schief gelaufen. Versuche es nochmal.");
            window.location.href = "Productoverview.php";
        </script>');
   ;
    }
} else {
// if user is not loged in the user is sent to login
    header("Location: loginsite.php");
    exit;
}
?>
