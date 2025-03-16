<?php
ob_start();

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Document</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="P.RideReadyProductoverview.css?v=1.1">

</head>
<?php 
        $pickupdate= $_SESSION['pickupdate'] ?? '';
        $returndate = $_SESSION['returndate'] ?? '';
        $city= $_SESSION['city'] ?? '';
        $ID=$_SERVER['QUERY_STRING'];
        // $ID=substr($ID,6);
        $Numbererofcars=0;
        


      
        

        include 'dbConfigJosef.php';

        $sql = "SELECT 
        m.Type_ID,  
        m.Name,  
        m.Name_Extension,  
        m.Vendor_Name,  
        m.Price,  
        m.Img_File_Name,  
        m.Gear,  
        m.Trunk,  
        m.Air_Condition,  
        m.GPS,  
        m.Min_Age,  
        m.Type,  
        m.Drive,  
        m.Doors,  
        m.Seats,
        c.type_id,
        c.car_id
    

        FROM Car c
        JOIN model m ON c.type_id = m.type_id
        WHERE c.loc_name = :city
        And c.type_id=:ID
        AND c.car_id NOT IN (
            SELECT car_id 
            FROM Contract 
            WHERE NOT (end_date < :pickupdate OR start_date > :returndate)
        )
        ORDER BY RAND() LIMIT 1";
        $params = [
            ':ID' =>$ID,
            ':city' => $city,
            ':pickupdate' => $pickupdate,
            ':returndate' => $returndate
        ];
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        $car = $stmt->fetchAll();

        if (count($car) > 0) {
        
            foreach ($car as $auto) {
                $carname = $auto['Name'];
                $carprice = $auto['Price'];
                $carVendor = $auto['Vendor_Name'];
                $carImage = $auto['Img_File_Name'];
                $nameExtension = $auto['Name_Extension'];
                $type_id = $auto['type_id'];   
                $Gear = $auto['Gear'];
                $Trunk = $auto['Trunk'];
                $Air_Condition = $auto['Air_Condition'];
                $GPS = $auto['GPS'];
                $Min_Age = $auto['Min_Age'];
                $Type = $auto['Type'];
                $Drive = $auto['Drive'];
                $Doors = $auto['Doors'];
                $Seats = $auto['Seats'];
                $Type_ID = $auto['Type_ID']; 
                $car_id = $auto['car_id'];
                echo $car_id;
                $_SESSION['bookingcar_id']=$car_id;
                $Numbererofcars=$Numbererofcars+1;
                echo " ";

            }
        
        } else {
            header('Location:P.RideReady.Produktübersicht.php');
                
        }
          
        // convertion of the pickupdate and the returndate into an Intervall 
        // and calcalculation of the overallprice
    
        $istartDate = new DateTime($pickupdate);
        $iendDate = new DateTime($returndate);
        $dateDifference = $istartDate->diff($iendDate);
        $dateDifference = (int) $dateDifference->days;
        $dateDifference=$dateDifference+1;
        $overallprice=number_format($carprice*$dateDifference,2,',','.');

        // creating the content for the booking Button:
        $bookingcontent="$dateDifference"." Tag(e) Reservieren";
        if (isset($_SESSION["eingeloggt"])) {
            //no content change
        }else
        {
        $bookingcontent="Login und "." $bookingcontent";
        }
        ob_end_flush();
    ?>

<body class="homepage-body">
    <?php include 'P.RideReadyHeader.php'; ?>
   
<div class="productdetailcontainer">
    <div>     
        <div class="pictureandprice-wrapper">
            <div class="picture"><img src="Images/Cars/<?php echo htmlspecialchars($carImage); ?>" alt="Car Image"></div>
            <div class="price">  <h2><?php echo number_format($carprice, 2, ',', '.') . "€"; ?> pro Tag</h2>
            <p>
                <?php echo("Dein Gesamtpreis für "."$dateDifference". " dein Zeitraum ist "."$overallprice"." €");?> 
            </p> 
         </div>
        </div>
        <button type="button" class="collapsible">
            <?php echo"Es sind nur noch  " ."$Numbererofcars"." Autos verfügbar. Klicke für mehr Information."?>
        </button>
        <div class="content">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        </div>
        <button type="button" class="collapsible">Open Collapsible</button>
        <div class="content">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        </div>
        <button type="button" class="collapsible">Open Collapsible</button>
        <div class="content">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        </div>

    </div>
    <div>
    <div class="detail">
        <div class="CarName">
            <h1>
                <?php
                echo"$carVendor "."$carname "."$nameExtension";
                ?>
            </h1>
    </div>  
    <div class="detailt">
        <div class="feature">
                <img src="Images\Icons\Seats.jpg">
                <p> <?php echo"$Seats"." Sitzplätze"?></p>
            </div>
            <div class="feature">
                <img src="images/Icons/Doors.jpg">
                <p><?php echo"$Doors"." Türen"?></p>
            </div>
            <div class="feature">
                <img src="images/Icons/Gear.jpg">
                <?php if($Gear=="manually"){
                    echo"Manuelle Schaltung"; } 
                    else{
                    echo"Automatik";
                } ?>
            </div>
            <div class="feature">
                <img src="images/Icons/Fuel.jpg">
                <?php if($Drive=="Combuster"){
                    echo"Verbrenner"; } 
                    else{
                    echo"Elektroantrieb";
                } ?>
                
            </div>
            <div class="feature">
                <img src="images/Icons/AirConditioning.jpg">
                <?php if($Air_Condition==1){
                    echo"Enthält Klimaanlage"; } 
                    else{
                    echo"Keine Klimaanlage";
                } ?>

            </div>
            <div class="feature">
                <img src="images/Icons/GPS.jpg">
                <?php if($GPS==1){
                    echo"Enthält GPS"; } 
                    else{
                    echo"Kein GPS";
                } ?>
            </div>
            <div class="feature">
                <img src="images/Icons/Age.jpg">
                <p><?php echo"Mindestalter: "."$Min_Age"?></p>
            </div>
            <div class="feature">
                <img src="images/Icons/suitcase.jpg">
                <p><?php echo"$Trunk"." Koffer"?></p>
            </div>
            <div class="feature">
                <img src="images/Icons/Location.jpg">
                <p><?php echo"$city"?></p>
            </div>

        </div>    
    </div>
        <div class="booking">
            <div class="time">
                <?php 
                    $formattedDatePickup = DateTime::createFromFormat("Y-m-d", $pickupdate)->format("d.m.Y");
                    $formattedDateReturn = DateTime::createFromFormat("Y-m-d", $returndate)->format("d.m.Y");
                ?>

                <div class="timebox">  <h4>Start</h4> <p><?php echo"$formattedDatePickup"?></p></div>
                <div class="timebox">  <h4>Ende</h4> <p><?php echo"$formattedDateReturn"?></p></div>

            </div>
            <button onclick="window.location.href='bookingstaging.php?<?= (int)$car_id ?>'" class="bookingbutton">
           <?php echo  $bookingcontent?>
            </button>
        </div>
    </div>
</div> 
<!-- Dynamic script for collapsible -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var coll = document.querySelectorAll(".collapsible");
        
        coll.forEach(function(button) {
            button.addEventListener("click", function() {
                this.classList.toggle("active");
                var content = this.nextElementSibling;
                if (content.style.display === "block") {
                    content.style.display = "none"; // Schließen
                } else {
                    content.style.display = "block"; // Öffnen
                }
            });
        });
    });
</script>
<?php 
include 'P.RideReadyFooter.php'; 
?>
</body>
</html>

