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
        // checks if user name already exists 
        $stmt = $pdo->prepare("SELECT * FROM contract  WHERE Car_id = :car_id");
        $stmt->bindParam(":car_id", $car_id, PDO::PARAM_STR);
        $stmt->execute();
        $userExists = $stmt->fetchColumn();

        if ($userExists > 0) {
           
            echo  ('<script>
            alert("Das Auto ist nun leider schon vergeben!");
            window.location.href = "Productoverview.php";
             </script>');
        } else 
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
