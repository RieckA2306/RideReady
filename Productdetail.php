<?php
ob_start();
require_once 'Functions.php';
check_if_session_started();
?>
<!DOCTYPE html>
<html lang="de">
<head>
<meta charset="UTF-8">
<title>Detailseite</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="RideReady.css?v=1.1">

</head>
<?php 
    // Taking the Variables from the Session and the Type ID from the URL 
    $pickupdate= $_SESSION['pickupdate'] ?? '';
    $returndate = $_SESSION['returndate'] ?? '';
    $city= $_SESSION['city'] ?? '';
    $ID = $_SERVER['QUERY_STRING'];
    $ID = filter_var($ID, FILTER_VALIDATE_INT);// To make sure no sql injections can be used here
    
    // Gaining access to the Database 
    include 'dbConfig.php';

    // Grabbing all the information we need for the Detailspage from the DatabaseS
    $sql = "SELECT 
            m.Type_ID, m.Name, m.Name_Extension, m.Vendor_Name, 
            m.Price, m.Img_File_Name, m.Gear, m.Trunk, 
            m.Air_Condition, m.GPS, m.Min_Age, m.Type, 
            m.Drive, m.Doors, m.Seats, c.car_id
            FROM Car AS c
            JOIN model AS m ON c.type_id = m.type_id
            WHERE c.loc_name = :city
            AND c.type_id = :ID
            AND c.car_id NOT IN (
            SELECT car_id FROM Contract 
            WHERE NOT (end_date < :pickupdate OR start_date > :returndate)
            )
            ORDER BY RAND() LIMIT 1";

    $params = [
        ':ID' =>$ID,
        ':city' => $city,
        ':pickupdate' => $pickupdate,
        ':returndate' => $returndate ];

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        $car = $stmt->fetch();
    } catch (PDOException $e) {
        die("Fehler bei der Datenbankabfrage: " . $e->getMessage());
    }
    // Making sure, the Database found a car with the given Parameters, and setting the Variables accordingly.
    if ($car) {
        $carname = $car['Name'];
        $carprice = $car['Price'];
        $carVendor = $car['Vendor_Name'];
        $carImage = $car['Img_File_Name'];
        $nameExtension = $car['Name_Extension'];
        $Gear = $car['Gear'];
        $Trunk = $car['Trunk'];
        $Air_Condition = $car['Air_Condition'];
        $GPS = $car['GPS'];
        $Min_Age = $car['Min_Age'];
        $Type = $car['Type'];
        $Drive = $car['Drive'];
        $Doors = $car['Doors'];
        $Seats = $car['Seats'];
        $car_id = $car['car_id'];
        $_SESSION['bookingcar_id'] = $car_id;
    } else {
        //If No car was found -> return to car selection
        header('Location: Productoverview.php');
        exit;
    }
        
        // convertion of the pickupdate and the returndate into an Intervall 
        // and calcalculation of the overallprice
    
        $dateDifference = (new DateTime($pickupdate))->diff(new DateTime($returndate))->days + 1;
        $formattedCarPrice = number_format($carprice, 2, ',', '.');
        $overallprice = number_format($carprice * $dateDifference, 2, ',', '.');

        // creating the content for the booking Button:
        $bookingcontent = "$dateDifference Tag(e) Reservieren";
        if (!isset($_SESSION["isloggedin"])) {
            $bookingcontent = "Login und $bookingcontent";
        }

        ob_end_flush();
?>

<body class="homepage-body">
<?php 
    define('ALLOW_HEADER_AND_FOOTER_INCLUDE', true);
    include 'Header.php'; 
    ?>
   
    <div class="productdetailcontainer">
        <div>     
            <div class="pictureandprice-wrapper">
                <div class="picture"><img src="Images/Cars/<?php echo htmlspecialchars($carImage); ?>"></div>
                <div class="price">    
                    <h2><?php echo "$formattedCarPrice € pro Tag"; ?></h2>
                    <p>Dein Gesamtpreis für <?php echo $dateDifference; ?> Tage beträgt <?php echo $overallprice; ?> €</p>

                </div>
            </div>
            <button type="button" class="collapsible"><h3>Versicherung</h3></button>
            <div class="content">
                <p>Unsere Mietfahrzeuge sind umfassend versichert, sodass du sorgenfrei unterwegs bist. Optional bieten wir Vollkasko- und Diebstahlschutz für maximale Sicherheit. Im Schadensfall kümmern wir uns schnell und unkompliziert um die Abwicklung.</p>
            </div>
            <button type="button" class="collapsible"><h3>Pannenhilfe</h3></button>
            <div class="content">
                <p>Solltest du eine Panne haben, stehen wir dir rund um die Uhr zur Verfügung. Unser Pannendienst bringt dich schnellstmöglich wieder auf die Straße. Falls eine Reparatur vor Ort nicht möglich ist, organisieren wir einen Ersatzwagen. Unsere Hotline ist jederzeit für dich erreichbar – wir helfen sofort..</p>
            </div>
            <button type="button" class="collapsible"><h3>Stornierung</h3></button>
            <div class="content">
                <p>Falls sich deine Pläne ändern, kannst du deine Buchung flexibel stornieren. Kostenlose Stornierungen sind bis 24 Stunden vor Mietbeginn möglich. Für kurzfristige Absagen bieten wir faire Erstattungsbedingungen. Setze dich einfach mit uns in Verbindung – wir finden eine Lösung.</p>
            </div>

        </div>
        <div>
            <div class="detail">
                <div class="CarName">
                    <h1>
                        <?php echo htmlspecialchars("$carVendor $carname $nameExtension"); ?>
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
                        $formattedDatePickup = !empty($pickupdate) ? DateTime::createFromFormat("Y-m-d", $pickupdate)->format("d.m.Y") : "Unbekannt";
                        $formattedDateReturn = !empty($returndate) ? DateTime::createFromFormat("Y-m-d", $returndate)->format("d.m.Y") : "Unbekannt";
                    ?>

                    <div class="timebox">  <h4>Start</h4> <p><?php echo"$formattedDatePickup"?></p></div>
                    <div class="timebox">  <h4>Ende</h4> <p><?php echo"$formattedDateReturn"?></p></div>

                </div>
                <button onclick="window.location.href='BookingPreparation.php?<?= (int)$car_id ?>'" class="bookingbutton">
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
                        content.style.display = "none";
                    } else {
                        content.style.display = "block"; 
                    }
                });
            });
        });
    </script>
    <?php 
    
    include 'Footer.php';
     
    ?>
</body>
</html>

