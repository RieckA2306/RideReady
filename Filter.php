<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Werte aus dem Filterformular in die Session speichern
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['reset']) && $_POST['reset'] === '1') {
        // Nur die Produktfilter-Session-Variablen zurücksetzen, Header-Variablen behalten!
        $_SESSION['manufacturer'] = '';
        $_SESSION['seats'] = '';
        $_SESSION['doors'] = '';
        $_SESSION['transmission'] = '';
        $_SESSION['age'] = '';
        $_SESSION['type'] = '';
        $_SESSION['drive'] = '';
        $_SESSION['climate'] = false;
        $_SESSION['gps'] = false;

        // Header-Session-Variablen (city, pickupdate, returndate) bleiben unberührt

        // Seite neu laden, um Standardwerte anzuzeigen
        echo "<script>window.location.href='P.RideReady.Produktübersicht.php';</script>";
        exit();
    } elseif (isset($_POST['filter'])) {
        // Produktfilter-Session-Variablen setzen, unabhängig davon, ob Felder ausgefüllt sind
        $_SESSION['manufacturer'] = $_POST['manufacturer'] ?? '';
        $_SESSION['seats'] = $_POST['seats'] ?? '';
        $_SESSION['doors'] = $_POST['doors'] ?? '';
        $_SESSION['transmission'] = $_POST['transmission'] ?? '';
        $_SESSION['age'] = $_POST['age'] ?? '';
        $_SESSION['type'] = $_POST['type'] ?? '';
        $_SESSION['drive'] = $_POST['drive'] ?? '';
        
        // Checkboxen als true/false speichern
        $_SESSION['climate'] = isset($_POST['climate']) ? true : false;
        $_SESSION['gps'] = isset($_POST['gps']) ? true : false;

        // Auf der Produktübersichtsseite bleiben
        echo "<script>window.location.href='P.RideReady.Produktübersicht.php';</script>";
        exit();
    }
}

// Standardwerte setzen, falls Session leer ist oder zurückgesetzt wurde
$manufacturer = $_SESSION['manufacturer'] ?? '';
$seats = $_SESSION['seats'] ?? '';
$doors = $_SESSION['doors'] ?? '';
$transmission = $_SESSION['transmission'] ?? '';
$age = $_SESSION['age'] ?? '';
$type = $_SESSION['type'] ?? '';
$drive = $_SESSION['drive'] ?? '';
$climate = $_SESSION['climate'] ?? false;
$gps = $_SESSION['gps'] ?? false;

// Header-Session-Variablen (bleiben unberührt)
$city = $_SESSION['city'] ?? 'Kein Abholort gesetzt';
$pickupdate = $_SESSION['pickupdate'] ?? 'Kein Abholdatum gesetzt';
$returndate = $_SESSION['returndate'] ?? 'Kein Rückgabedatum gesetzt';
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produktübersicht</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e5e5e5;
            margin: 0;
            padding: 0;
            width: auto;
        }

        .filter-bar {
            background-color: #f9f9f9;
            padding: 20px;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 15px;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
            width: 90%;
            max-width: 1200px;
            align-items: center;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .filter-bar select, .filter-bar input, .filter-bar button {
            padding: 10px;
            font-size: 14px;
            border-radius: 5px;
            border: 1px solid #ccc;
            width: 150px;
            text-align: center;
        }

        .filter-bar button {
            background-color: #80BFFF;
            color: white;
            border: none;
            cursor: pointer;
        }

        .filter-bar button:hover {
            background-color: #123472;
        }

        .form-wrapper {
            display: contents;
        }
    </style>
</head>
<body>
    <div class="filter-bar">
        <form method="post" action="P.RideReady.Produktübersicht.php" class="form-wrapper">
            <?php
                require_once 'Functions.php';

                // Alle Arrays an einer Stelle definiert:
                $a_manufacturers = ["Audi", "BMW", "Mercedes", "Volkswagen"];
                $a_seats = ["2", "4", "5", "7", "9"];
                $a_doors = ["2", "4", "5"];
                $a_transmission = ["Automatik", "Manuell"];
                $a_age = ["Neu", "1 Jahr", "2 Jahre", "3 Jahre+"];
                $a_type = ["SUV", "Kombi", "Limousine", "Cabrio"];
                $a_drive = ["Frontantrieb", "Heckantrieb", "Allrad"];

                // Dynamische Funktionsaufrufe:
                renderFilterGroup('Hersteller', 'manufacturer', $a_manufacturers, $manufacturer);
                renderFilterGroup('Sitze', 'seats', $a_seats, $seats);
                renderFilterGroup('Türen', 'doors', $a_doors, $doors);
                renderFilterGroup('Getriebe', 'transmission', $a_transmission, $transmission);
            ?> 
                <div class="filter-group">
                    <label for="climate">Klima:</label>
                    <input type="checkbox" name="climate" id="climate" 
                        <?php echo ($climate) ? 'checked' : ''; ?>>
                </div>

                <div class="filter-group">
                    <label for="gps">GPS:</label>
                    <input type="checkbox" name="gps" id="gps" 
                        <?php echo ($gps) ? 'checked' : ''; ?>>
                </div>
            
            <?php
                renderFilterGroup('Alter', 'age', $a_age, $age);
                renderFilterGroup('Typ', 'type', $a_type, $type);
                renderFilterGroup('Antrieb', 'drive', $a_drive, $drive);
            ?>  

            <!-- Buttons für Filtern und Zurücksetzen -->
            <div class="filter-group">
                <button type="submit" name="filter">Filtern</button>
            </div>
            <div class="filter-group">
                <button type="submit" name="reset" value="1">Filter zurücksetzen</button>
            </div>
        </form>
    </div>
</body>
</html>
