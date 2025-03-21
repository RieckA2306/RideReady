<?php
require_once 'Functions.php';
check_if_session_started();

// If data comes via POST, store it in the session (for click on the Teaser from the Landingpage)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['city'])) {
        $_SESSION['city'] = $_POST['city'];
    }
    if (isset($_POST['pickupdate'])) {
        $_SESSION['pickupdate'] = $_POST['pickupdate'];
    }
    if (isset($_POST['returndate'])) {
        $_SESSION['returndate'] = $_POST['returndate'];
    }
    if (isset($_POST['type'])) {
        $_SESSION['type'] = $_POST['type'];
    }
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=1920">
    <title>Produktübersicht</title>
    <link rel="stylesheet" href="RideReady.css">
</head>
<body class="productoverview-body">

<?php 
    define('ALLOW_HEADER_AND_FOOTER_INCLUDE', true);
    include 'Header.php'; 
    include 'Productoverview_Filter.php'; 
?>
    
<?php 
    //  Connection to Database
     include 'dbConfig.php';

    // Retrieve filter variables from the sessions
$pickupdate= $_SESSION['pickupdate'] ?? '';
$returndate = $_SESSION['returndate'] ?? '';
$city= $_SESSION['city'] ?? '';
$manufacturer = $_SESSION['manufacturer'] ?? '';
$seats = $_SESSION['seats'] ?? '';
$doors = $_SESSION['doors'] ?? '';
$transmission = $_SESSION['transmission'] ?? '';
$climate = $_SESSION['climate'] ?? '';
$gps = $_SESSION['gps'] ?? '';
$age = $_SESSION['age'] ?? '';
$type = $_SESSION['type'] ?? '';
$drive = $_SESSION['drive'] ?? '';
$priceuntil = $_SESSION['price'] ?? '';
$sorting = $_SESSION['sorting'] ?? '';


$sql = "SELECT m.Name, m.Price AS carprice, m.Vendor_Name, m.Img_File_Name, m.Name_Extension, c.type_id, COUNT(c.car_id) AS available_count
        FROM Car c
        JOIN model m ON c.type_id = m.type_id
        WHERE c.loc_name = :city
        AND c.car_id NOT IN (
            SELECT car_id 
            FROM Contract 
            WHERE NOT (end_date < :pickupdate OR start_date > :returndate)
        )
        GROUP BY m.Name, m.Price, m.Vendor_Name, m.Img_File_Name, m.Name_Extension, c.type_id, m.Seats, m.Doors, m.Gear, m.Air_Condition, m.GPS, m.Min_Age, m.Type, m.Drive
        HAVING COUNT(c.car_id) > 0"; // only cars with availability are considered


// Create array for parameters
$params = [
    ':city' => $city,
    ':pickupdate' => $pickupdate,
    ':returndate' => $returndate
];

// Filters that Add to the SQL-Query
require_once 'Functions.php';
sqlfilters($manufacturer, 'manufacturer', 'm.Vendor_Name', $sql, $params);
sqlfilters($seats, 'seats', 'm.Seats', $sql, $params);
sqlfilters($doors, 'doors', 'm.Doors', $sql, $params);
sqlfilters($transmission, 'transmission', 'm.Gear', $sql, $params);
sqlfilters($climate, 'climate', 'm.Air_Condition', $sql, $params);
sqlfilters($gps, 'gps', 'm.GPS', $sql, $params);

// Operator is different (<=) (Can´t call the Function here)
if (!empty($age)) {
    $sql .= " AND m.Min_Age <= :age";
    $params[':age'] = $age;
}

sqlfilters($type, 'type', 'm.Type', $sql, $params);
sqlfilters($drive, 'drive', 'm.Drive', $sql, $params);

// Add the Pricefilter
if (!empty($priceuntil)) {
    $maxPrice = intval(str_replace('€', '', $priceuntil)); // "300€" => 300
    $sql .= " AND m.Price <= :priceuntil";
    $params[':priceuntil'] = $maxPrice;
}

// Add the sort Pricefilter
if (!empty($sorting)) {
    if ($sorting === 'Preis aufsteigend') {
        $sql .= " ORDER BY m.Price ASC";
    } elseif ($sorting === 'Preis absteigend') {
        $sql .= " ORDER BY m.Price DESC";
    }
}

// Prepare and execute prepared statement
$stmt = $pdo->prepare($sql);
$stmt->execute($params);


// Retrieve results
$freeCars = $stmt->fetchAll();
?>

    <div class="productoverview-content">
        <div class="productoverview-container">
            <?php
            
             if (count($freeCars) > 0) {
                foreach ($freeCars as $car) {
                    $carname = $car['Name'];
                    $_SESSION['carname'] = $carname;
                    
                    $carprice = $car['carprice'];
                    $_SESSION['carprice'] = $carprice;
                    
                    $carVendor = $car['Vendor_Name'];
                    $_SESSION['Vendor_Name'] = $carVendor;
                    
                    $carImage = $car['Img_File_Name'];
                    $_SESSION['Img_File_Name'] = $carImage;
            
                    $nameExtension = $car['Name_Extension'];
                    $_SESSION['Name_Extension'] = $nameExtension;

                    $type_id = $car['type_id'];
                    $_SESSION['type_id'] = $type_id;

                    $availableCount = $car['available_count'];

                    // Document for the Cards in the Productoverview
                    include 'Productoverview_Teaser.php';   
                }
                    echo "</ul>";
                } else {
                    echo "<p>Keine freien Autos mit angegebenen Parametern für den angegebenen Zeitraum.</p>";
                }
                
            ?>
        </div>
    </div>
    <?php 
    include 'Footer.php';
     ?>
</body>
</html>
