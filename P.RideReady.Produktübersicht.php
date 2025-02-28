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
    <title>BMW Karten</title>
    <style>
        /* Body nur als generelle Hintergrundgestaltung */
        .produktübersicht-body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            margin: auto;
            background-color: #F0F0F0;
            /* font-family: "Inter", serif; */
            margin: 0;
        }

        /* Wrapper für den Hauptinhalt */
        .produktübersicht-content {
            flex: 1; /* Stellt sicher, dass der Inhalt wächst */
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        /* Container für Karten */
        .produktübersicht-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            max-width: 900px;
            justify-content: center;
            align-items: center;
        }

        .card {
            width: 300px;
            height: 400px;
            background-color: #0a2e6d;
            border-radius: 15px;
            color: white;
            font-weight: bold;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .cardbild {
            position: static;
            width: 300px;
            height: 250px;
            background-size: 100%;
        }

        .cardbild img {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Beibehaltung des Seitenverhältnisses */
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }

        .cardtext {
            width: 300px;
            height: 150px;
            border-bottom-left-radius: 15px;
            border-bottom-right-radius: 15px;
            color: white;
            font-weight: bold;
            padding: 15px;
        }
        .card p {
            margin: 2px 0;
        }

        
    </style>
</head>
<body class="produktübersicht-body">

<?php 
    include 'P.RideReadyHeader.php';
    include 'Filter.php'; ?>
    <!-- Wrapper für den Hauptinhalt -->
     <?php 
    //  connection to Database
     include 'dbConfigJosef.php';
    // setting filter variables

$pickupdate= $_SESSION['pickupdate']??'';
$returndate = $_SESSION['returndate']??'';
$city= $_SESSION['city']??'';
$manufacturer = $_SESSION['manufacturer'] ?? '';
$seats = $_SESSION['seats'] ?? '';
$doors = $_SESSION['doors'] ?? '';
$transmission = $_SESSION['transmission'] ?? '';
$climate = $_SESSION['climate'] ?? '';
$gps = $_SESSION['gps'] ?? '';
$age = $_SESSION['age'] ?? '';
$type = $_SESSION['type'] ?? '';
$drive = $_SESSION['drive'] ?? '';

// 3️⃣ SQL-Abfrage mit Prepared Statements
$sql = "SELECT m.Name, m.Price AS carprice, m.Vendor_Name, m.Img_File_Name, m.Name_Extension
        FROM Car c
        JOIN model m ON c.type_id = m.type_id
        WHERE c.loc_name = :city
        AND c.car_id NOT IN (
            SELECT car_id 
            FROM Contract 
            WHERE NOT (end_date < :pickupdate OR start_date > :returndate)
        )";

// Array für Parameter erstellen
$params = [
    ':city' => $city,
    ':pickupdate' => $pickupdate,
    ':returndate' => $returndate
];

// Dynamische Filter hinzufügen
if (!empty($manufacturer)) {
    $sql .= " AND m.Vendor_Name = :manufacturer";
    $params[':manufacturer'] = $manufacturer;
}

if (!empty($seats)) {
    $sql .= " AND m.Seats = :seats";
    $params[':seats'] = $seats;
}

if (!empty($doors)) {
    $sql .= " AND m.Doors = :doors";
    $params[':doors'] = $doors;
}

if (!empty($transmission)) {
    $sql .= " AND m.Gear = :transmission";
    $params[':transmission'] = $transmission;
}

if (!empty($climate)) {
    $sql .= " AND m.Air_Condition = :climate";
    $params[':climate'] = $climate;
}

if (!empty($gps)) {
    $sql .= " AND m.GPS = :gps";
    $params[':gps'] = $gps;
}

if (!empty($age)) {
    $sql .= " AND m.Min_Age <= :age";
    $params[':age'] = $age;
}

if (!empty($type)) {
    $sql .= " AND m.Type = :type";
    $params[':type'] = $type;
}

if (!empty($drive)) {
    $sql .= " AND m.Drive = :drive";
    $params[':drive'] = $drive;
}

// Prepared Statement vorbereiten und ausführen
$stmt = $pdo->prepare($sql);
$stmt->execute($params);

// Ergebnisse abrufen
$freieAutos = $stmt->fetchAll();
?>
    <div class="produktübersicht-content">
        <div class="produktübersicht-container">
            <?php
             if (count($freieAutos) > 0) {
                // $count=0;
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
            
                    include 'teaser.php';   
                }
                    echo "</ul>";
                } else {
                    echo "<p>Keine freien Autos mit angegebenen Parametern für den angegebenen Zeitraum.</p>";
                }
                
            ?>
        </div>
    </div>

    <!-- Unabhängiger Footer -->
    
    <?php include 'P.RideReadyFooter.php'; ?>
    

</body>
</html>
