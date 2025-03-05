<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
ini_set('display_errors', 1);
error_reporting(E_ALL);?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <title>Document</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="P.RideReady.css">
    <style>
        .homepage-body{
            display: flex;
            flex-direction: column;
            margin: auto;
            background-color: #F0F0F0;
            font-family: "Inter", serif;
            margin: 0;
        }
        
        .container {
            background-color: white;
            margin: auto;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            width: 1085px;
            height: auto;
            text-align: right;
            display: flex;  
            justify-content: space-between;
        }

        .pictureandprice-wrapper {
            display: grid;
            justify-content: space-between;
            align-items: center;
            background-color: #002b5e;
            color: white;
            padding: 10px;
            border-radius: 10px;
            margin: 10px;
            margin-top: 10px;
            width: 585px;
            height: 450px; 
        } 

        .picture{
            display: flex;
            flex-direction: column;
            align-items: center; 
            padding: 10px;
            margin: 10px;
            margin-top: 30px;
            margin-left: 30px;
            margin-left: 30px;
            width: 500px; /* Oder eine andere gewünschte Breite */
            height: 300px;
            display: flex;
            justify-content: center;
            align-items: center;
            object-fit: cover;
            overflow: hidden; /* Verhindert, dass das Bild zu groß wird */
        }

        .picture img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 10px
        }

        .price  {
            flex-direction: column;
            background-color: white;
            color:#002b5e;
            padding: 10px;
            border-radius: 10px;
            margin: 10px;
            margin-left: 70px;
            width: 420px;
            height: 50px;
            text-align: left;
        }

        .price h2 {
            font-weight: bold;
            margin: 0;
        }

        .price p {
            text-align: end;
            margin: 5px ;
        }
        
        
        .detail {
            display: grid;
            justify-content: space-between;
            align-items: center;
            background-color: #002b5e;
            color: white;
            padding: 10px;
            border-radius: 10px;
            margin: 10px;
            width: 420px;
            height: 450px;
        }
        
        .CarName{
            display: flex;
            height: 50px;
            width: 80%; 
            overflow: hidden; 
            text-align: start;
            padding: 10px;
        }

        .detailt    {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            text-align: center;
            width: 420px;
            height: 350px;
        } 

        .feature {
            display: flex;
            flex-direction: column;
            align-items: center;
            color: white;
        }

        .feature img {
            width: 50px;
            height: 50px;
            background-color: white;
            border-radius: 10%;
            padding: 10px;
        }

        .feature p {
            margin-top: 5px;
            font-size: 14px;
        }

        .collapsible {
            display: flex;
            background-color: #002b5e;
            color: white;
            cursor: pointer;
            padding: 10px;
            margin: 10px;
            border-radius: 10px;
            width: 605px;
            height: 66px;
            border: none;
            text-align: left;
            outline: none;
            font-size: 15px;
        }
        
        .active, .collapsible:hover {
            background-color: #FFC107;
            color:#002b5e;
        }

        .content {
            display: none;
            overflow: hidden;
            background-color: #80BFFF;
            color: #002b5e;
            padding: 10px;
            border-radius: 10px;
            margin: 10px;
            margin-top: 3px;
            width: 800px;
            height:auto;
        }

        .booking {
            display: flex;
            flex-direction: column;
            align-items: center; 
            justify-content: center; 
            gap:20%;
            background-color: #002b5e;
            padding: 10px;
            border-radius: 10px;
            margin: 10px;
            width: 420px;
            height: 200px;
        }

        .time {
            display: flex;
            width: 80%; 
            border: 1px solid #ccc; 
            border-radius: 10px; 
            overflow: hidden; 
            text-align: center;
        }

        .timebox {
            flex: 1; 
            padding: 10px;
            background-color: white;
        }

        .timebox:not(:last-child) {
            border-right: 1px solid #ccc; 
        }

        .timebox h4 {
            font-size: 12px;
            font-weight: bold;
            margin: 0;
        }

        .timebox p {
            font-size: 14px;
            margin: 5px 0 0;
        }

        .bookingbutton {
            background-color: #FFC107;
            padding: 10px;
            border-radius: 10px;
            margin: 10px;
            margin-bottom: 20px;
            width:70%;
            height: 60px;
        }

    </style>
</head>

<body class="homepage-body">
    <?php 
    include 'P.RideReadyHeader.php';
    ?>
    <?php 
        $pickupdate= $_SESSION['pickupdate'] ?? '';
        $returndate = $_SESSION['returndate'] ?? '';
        $city= $_SESSION['city'] ?? '';
        $ID=$_SERVER['QUERY_STRING'];
        $ID=substr($ID,6);
        $priceperday=14;
    
    

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
        )";
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
                $Type_ID = $auto['Type_ID']; // c.type_id
                $car_id = $auto['car_id'];
                echo $car_id;
                $_SESSION['bookingcar_id']=$car_id;
                echo " ";

            }
        
            } else {
                echo "<p>Keine freien Autos mit angegebenen Parametern für den angegebenen Zeitraum.</p>";
                echo "ID: $ID, City: $city, Pickupdate: $pickupdate, Returndate: $returndate";
            }
    ?>

<div class="container">
    <div>     
        <div class="pictureandprice-wrapper">
            <div class="picture"><img src="Images/Cars/<?php echo htmlspecialchars($carImage); ?>" alt="Car Image"></div>
            <div class="price">  <h2><?php echo number_format($carprice, 2, ',', '.') . "€"; ?> pro Tag</h2><p> Gesamtpreis </p>  </div>
        </div>
        <button type="button" class="collapsible">Buchungdetails</button>
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
                    $date = "2025-03-05"; // Date from database
                    $formattedDatePickup = DateTime::createFromFormat("Y-m-d", $pickupdate)->format("d.m.Y");
                    $formattedDateReturn = DateTime::createFromFormat("Y-m-d", $returndate)->format("d.m.Y");
                ?>

                <div class="timebox">  <h4>Start</h4> <p><?php echo"$formattedDatePickup"?></p></div>
                <div class="timebox">  <h4>Ende</h4> <p><?php echo"$formattedDateReturn"?></p></div>

            </div>
            <button onclick="window.location.href='bookingstaging.php?<?= (int)$car_id ?>'" class="bookingbutton">
            Reservieren
            </button>
        </div>
    </div>
</div> 

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

