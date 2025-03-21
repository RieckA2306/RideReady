<!-- This Site will open if someone pushes the Button "Autos hinzufügen" in the Header -->

<?php
ob_start();
require_once 'Functions.php';
check_if_session_started();
deny_allowance_for_direct_access_just_Admins();

include 'dbConfig.php';

// Gets the Type_Id from the URL, which tells the DB, what car it has to show
$ID = isset($_GET['id']) ? intval($_GET['id']) : null;

if (isset($_GET['id']) && !$ID) {
    die("Fehler: Keine gültige Type_ID angegeben.");
}


// If the Admin Presses the Button to create a new car, the site is reloaded with the Post method.
// This is then processed here and a new car gets added to the Database. A popup tells the Admin about their success/failure
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

// the SQL Request to the Database, to show the Car Details related to the Type_ID
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
$car = $stmt->fetch(PDO::FETCH_ASSOC);

// //If for any reason there is no car related to the ID in the URL, the websites routes you back to the car selection page
// Otherwise the Site will show the details of the car related to the Type_ID 
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
    header('Location: Productoverview_Admin.php');
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
<link rel="stylesheet" href="RideReady.css?v=1.1">
</head>

<body class="homepage-body">
<?php 
    define('ALLOW_HEADER_AND_FOOTER_INCLUDE', true);
    include 'Header.php'; 
    ?>

    <div class="productdetailcontainer">
        <div>
                 <!-- The left side of the Site is added here with the Image, Price and below the collapsibles -->
            <div class="pictureandprice-wrapper">
                <div class="picture"><img src="Images/Cars/<?php echo htmlspecialchars($carImage); ?>" alt="Car Image"></div>
                <div class="price">  <h2><?php echo number_format($carprice, 2, ',', '.') . "€"; ?> pro Tag</h2>
                </div>
            </div>
            <!-- The Collapsibles are included here -->
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
        <!-- The Right side of the Site is included here  -->
        <div>
            <div class="detail">
                <div class="CarName">
                    <h1> <?php echo"$carVendor "."$carname "."$nameExtension";?> </h1>
                </div>  
                <div class="detailt">
                    <!-- The Icons and the according Details from the DB are included -->
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
            <!-- In this part, the selection of the City adn the Submit button to create a new car are added -->
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

    <?php 
    include 'Footer.php';
     ?>
</body>
</html>
