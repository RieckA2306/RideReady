<html>
    <head>
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
            background-image: url(bmw.png);
            background-size: 100%;
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
<?php

$servername = $_SERVER['SERVER_NAME'];
$username = "RideReadyAdmin";
$password = "1234";
$dbname = "ridereadydb";

// Variablen für den Zeitraum
$startDatum = '2025-03-25';
$endDatum = '2025-03-28';


try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
} catch (PDOException $e) {
    die("Datenbankverbindung fehlgeschlagen: " . $e->getMessage());
}

// 2️⃣ Variablen für den Zeitraum (dynamisch anpassbar)
$startDatum = '2026-03-25';
$endDatum = '2026-03-28';
session_start();
$city= $_SESSION['city'];


// 3️⃣ SQL-Abfrage mit Prepared Statements
$sql = "SELECT m.Name, m.Price AS carprice, m.Vendor_Name
        FROM Car c
        JOIN model m ON c.type_id = m.type_id
        WHERE c.loc_name = '$city'
        AND c.car_id NOT IN (
            SELECT car_id 
            FROM Contract 
            WHERE NOT (end_date < ? OR start_date > ?)
        )";

// 4️⃣ Prepared Statement vorbereiten und ausführen
$stmt = $pdo->prepare($sql);
$stmt->execute([$startDatum, $endDatum]);

// 5️⃣ Ergebnisse abrufen
$freieAutos = $stmt->fetchAll();
?>
 <?php include "P.RideReadyHeader.php"?>
<div class="produktübersicht-content">
<div class="produktübersicht-container">
<?php
// 6️⃣ Ergebnisse ausgeben
if (count($freieAutos) > 0) {
$count=0;
    foreach ($freieAutos as $auto) {
        $carname = $auto['Name'];
        $_SESSION['carname'] = $carname;
        $carprice = $auto['carprice'];
        $_SESSION['carprice'] = $carprice;
        $carVendor = $auto['Vendor_Name'];
        $_SESSION['Vendor_Name'] = $carVendor;
        $count=$count+1;
        $_SESSION['count']=$count;
        include 'teasertest.php';   
    }
    echo "</ul>";
} else {
    echo "<p>Keine freien Autos mit angegebenen Parametern für den angegebenen Zeitraum.</p>";
}

?>
</div>
</div>
<?php include "P.RideReadyFooter.php"?>