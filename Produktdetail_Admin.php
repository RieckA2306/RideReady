<!-- This Site will open if someone pushes the Button "Autos hinzufügen" in the Header -->

<?php
ob_start();

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
ini_set('display_errors', 1);
error_reporting(E_ALL);

include 'dbConfigJosef.php';

// Hole die ID aus der URL
$ID = isset($_GET['id']) ? intval($_GET['id']) : null;

if (isset($_GET['id']) && !$ID) {
    die("Fehler: Keine gültige Type_ID angegeben.");
}


// Verarbeitung des Formulars (Einfügen eines neuen Autos)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['city'])) {
    $selectedCity = $_POST['city'];

    if (!empty($selectedCity)) {
        $insertSql = "INSERT INTO Car (Loc_Name, Type_ID) VALUES (:city, :type_id)";
        $insertStmt = $pdo->prepare($insertSql);
        $insertStmt->execute([':city' => $selectedCity, ':type_id' => $ID]);

        echo "<script>alert('Neues Auto erfolgreich hinzugefügt!');</script>";
    } else {
        echo "<script>alert('Bitte eine Stadt auswählen.');</script>";
    }
}


$sql = "SELECT 
            Type_ID,  
            Name,  
            Name_Extension,  
            Vendor_Name,  
            Price,  
            Img_File_Name,  
            Gear,  
            Trunk,  
            Air_Condition,  
            GPS,  
            Min_Age,  
            Type,  
            Drive,  
            Doors,  
            Seats
        FROM model
        WHERE Type_ID = :ID
        LIMIT 1";  // Sorgt dafür, dass nur ein Modell geladen wird
        
$params = [':ID' => $ID];

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$car = $stmt->fetch(PDO::FETCH_ASSOC); // Holt genau EIN Ergebnis

if (!$car) {
    header('Location: add-cars.php');
    exit();
}

if ($car) { // Prüft, ob ein Ergebnis vorhanden ist
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
} else {
    header('Location: P.RideReady.Produktübersicht.php');
    exit();
}


ob_end_flush();
?>

<!DOCTYPE html>
<html lang="de">
<head>
<meta charset="UTF-8">
<title>Neue Autos Hinzufügen</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="P.RideReadyProductoverview.css?v=1.1">
</head>

<body class="homepage-body">
    <?php include 'P.RideReadyHeader.php'; ?>

    <div class="productdetailcontainer">
   <div>     
       <div class="pictureandprice-wrapper">
           <div class="picture"><img src="Images/Cars/<?php echo htmlspecialchars($carImage); ?>" alt="Car Image"></div>
           <div class="price">  <h2><?php echo number_format($carprice, 2, ',', '.') . "€"; ?> pro Tag</h2>
        </div>
       </div>
       <button type="button" class="collapsible">
           <?php echo"Es sind insgesamt Autos dieses Typs im System eingetragen."?>
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
               <p><?php echo"Bitte Auswählen";?></p>
           </div>
       </div>  
   </div>
   

            <form id="StadtAuswahl_NeuesAuto" method="post">
                <div class="creatingNewCars">
                    <input type="hidden" name="type_id" value="<?php echo htmlspecialchars($ID); ?>">
                    <select name="city" id="NewCar_Location">
                        <option value="">Ort auswählen</option>
                        <?php
                        $a_cities = ["Berlin", "Bielefeld", "Bochum", "Bremen", "Dortmund", "Dresden", "Freiburg", "Hamburg", "Köln", "Leipzig", "München", "Nürnberg", "Paderborn", "Rostock"];
                        foreach ($a_cities as $cityOption) {
                            echo "<option value='$cityOption'>$cityOption</option>";
                        }
                        ?>
                    </select>
                    <button type="submit" class="bookingbutton">Neues Auto Eintragen</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var coll = document.querySelectorAll(".collapsible");
            coll.forEach(function(button) {
                button.addEventListener("click", function() {
                    this.classList.toggle("active");
                    var content = this.nextElementSibling;
                    content.style.display = (content.style.display === "block") ? "none" : "block";
                });
            });
        });
    </script>

    <?php include 'P.RideReadyFooter.php'; ?>
</body>
</html>
