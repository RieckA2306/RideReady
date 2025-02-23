<!-- Due to Session_Start in the header the session should start on all pages. Nevertheless to ensure it 100% i added this -->
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Werte aus dem Filterformular in die Session speichern
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['reset'])) {
        // Session-Werte löschen, wenn "Filter zurücksetzen" geklickt wurde
        unset($_SESSION['manufacturer'], $_SESSION['seats'], $_SESSION['doors'], $_SESSION['transmission'], 
              $_SESSION['age'], $_SESSION['type'], $_SESSION['drive'], $_SESSION['climate'], $_SESSION['gps']);
        
        // Auf der Produktübersichtsseite bleiben
        header('Location: P.RideReady.Produktübersicht.php');
        exit();
    } else {
        // Werte aus dem Formular abgreifen
        $manufacturer = $_POST['manufacturer'] ?? '';
        $seats = $_POST['seats'] ?? '';
        $doors = $_POST['doors'] ?? '';
        $transmission = $_POST['transmission'] ?? '';
        $age = $_POST['age'] ?? '';
        $type = $_POST['type'] ?? '';
        $drive = $_POST['drive'] ?? '';
        
        // Checkboxen als true/false speichern
        $climate = isset($_POST['climate']) ? true : false;
        $gps = isset($_POST['gps']) ? true : false;

        // Speichern der Session-Variablen
        $_SESSION['manufacturer'] = $manufacturer;
        $_SESSION['seats'] = $seats;
        $_SESSION['doors'] = $doors;
        $_SESSION['transmission'] = $transmission;
        $_SESSION['age'] = $age;
        $_SESSION['type'] = $type;
        $_SESSION['drive'] = $drive;
        $_SESSION['climate'] = $climate;
        $_SESSION['gps'] = $gps;

        // Auf der Produktübersichtsseite bleiben
        header('Location: P.RideReady.Produktübersicht.php');
        exit();
    }
}

// Standardwerte setzen, falls Session leer ist
$manufacturer = $_SESSION['manufacturer'] ?? '';
$seats = $_SESSION['seats'] ?? '';
$doors = $_SESSION['doors'] ?? '';
$transmission = $_SESSION['transmission'] ?? '';
$age = $_SESSION['age'] ?? '';
$type = $_SESSION['type'] ?? '';
$drive = $_SESSION['drive'] ?? '';
$climate = $_SESSION['climate'] ?? false;
$gps = $_SESSION['gps'] ?? false;
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
<body class="produktübersicht-body">
<header>
<?php include 'P.RideReadyHeader.php'; ?>
</header>
<?php include 'Filter.php'; ?>
    <!-- Wrapper für den Hauptinhalt -->
    <div class="produktübersicht-content">
        <div class="produktübersicht-container">
            <?php
                $cardCount = 10;
        
                for ($i = 0; $i < $cardCount; $i++) {
                    include 'teaser.php';
                    global $x;
                }
            ?>
        </div>
    </div>

    <!-- Unabhängiger Footer -->
    
    <?php include 'P.RideReadyFooter.php'; ?>
    

</body>
</html>
