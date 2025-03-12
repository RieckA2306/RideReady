<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=1920">
    <title>Produktübersicht</title>
    <link rel="stylesheet" href="P.RideReadyProductoverview.css">
</head>
<body class="productoverview-body">

<?php 
    include 'P.RideReadyHeader.php';
    include 'Filter.php'; 
?>
    
<?php 
    //  Connection to Database
     include 'dbConfigJosef.php';

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
        GROUP BY m.Name, m.Price, m.Vendor_Name, m.Img_File_Name, m.Name_Extension, c.type_id, m.Seats, m.Doors, m.Gear, m.Air_Condition, m.GPS
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
$freieAutos = $stmt->fetchAll();
?>

    <div class="productoverview-content">
        <div class="productoverview-container">
            <?php
            
             if (count($freieAutos) > 0) {
                foreach ($freieAutos as $auto) {
                    $carname = $auto['Name'];
                    $_SESSION['carname'] = $carname;
                    
                    $carprice = $auto['carprice'];
                    $_SESSION['carprice'] = $carprice;
                    
                    $carVendor = $auto['Vendor_Name'];
                    $_SESSION['Vendor_Name'] = $carVendor;
                    
                    $carImage = $auto['Img_File_Name'];
                    $_SESSION['Img_File_Name'] = $carImage;
            
                    $nameExtension = $auto['Name_Extension'];
                    $_SESSION['Name_Extension'] = $nameExtension;

                    $type_id = $auto['type_id'];
                    $_SESSION['type_id'] = $type_id;

                    $availableCount = $auto['available_count'];

                    // Document for the Cards in the Productoverview
                    include 'teaser.php';   
                }
                    echo "</ul>";
                } else {
                    echo "<p>Keine freien Autos mit angegebenen Parametern für den angegebenen Zeitraum.</p>";
                }
                
            ?>
        </div>
    </div>
    <?php include 'P.RideReadyFooter.php'; ?>
</body>
</html>
