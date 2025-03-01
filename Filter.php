<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Mapping Arrays for Antrieb and Getriebe to save them in English for the SQL Query
$driveMapping = [
    "Elektro" => "Electric",
    "Verbrenner" => "Combuster"
];

$transmissionMapping = [
    "Automatik" => "automatic",
    "Manuell" => "manually"
];

// Werte aus dem Formular in die Session speichern
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['reset']) && $_POST['reset'] === 'product_reset') {
        // Filter zurücksetzen: Statt die Session-Variablen komplett zu löschen, 
        // werden sie auf Standardwerte gesetzt, um Undefined-Array-Key-Warnungen zu vermeiden.
        $_SESSION['manufacturer'] = '';
        $_SESSION['seats'] = '';
        $_SESSION['doors'] = '';
        $_SESSION['transmission'] = '';
        $_SESSION['climate'] = false;
        $_SESSION['gps'] = false;
        $_SESSION['age'] = '';
        $_SESSION['type'] = '';
        $_SESSION['drive'] = '';
        $_SESSION['price'] = '';
        $_SESSION['sorting'] = '';

        // Stay on that Page (window.location is needed as a workaround because there is some unknown conflict with the header)
        echo '<script>window.location.href="P.RideReady.Produktübersicht.php";</script>';
        exit();

    } elseif (isset($_POST['filter'])) {
        $_SESSION['manufacturer'] = $_POST['manufacturer'] ?? '';
        $_SESSION['seats'] = $_POST['seats'] ?? '';
        $_SESSION['doors'] = $_POST['doors'] ?? '';

        // Translation of the values is applied here
        $_SESSION['transmission'] = $transmissionMapping[$_POST['transmission']] ?? '';
        $_SESSION['drive'] = $driveMapping[$_POST['drive']] ?? '';

        $_SESSION['climate'] = isset($_POST['climate']) ? true : false;
        $_SESSION['gps'] = isset($_POST['gps']) ? true : false;
        $_SESSION['age'] = $_POST['age'] ?? '';
        $_SESSION['type'] = $_POST['type'] ?? '';
        $_SESSION['price'] = $_POST['price'] ?? '';
        $_SESSION['sorting'] = $_POST['sorting'] ?? '';

        echo '<script>window.location.href="P.RideReady.Produktübersicht.php";</script>';
        exit();
    }
}

// Umkehr-Mapping für die Anzeige
$driveDisplay = array_flip($driveMapping);
$transmissionDisplay = array_flip($transmissionMapping);

// Filterwerte für die Anzeige vorbereiten
$manufacturer = $_SESSION['manufacturer'] ?? '';
$seats = $_SESSION['seats'] ?? '';
$doors = $_SESSION['doors'] ?? '';

// Sicherstellung, dass keine Undefined-Array-Key-Warnung entsteht
$transmission = isset($_SESSION['transmission']) ? $transmissionDisplay[$_SESSION['transmission']] ?? '' : '';
$climate = $_SESSION['climate'] ?? false;
$gps = $_SESSION['gps'] ?? false;
$age = $_SESSION['age'] ?? '';
$type = $_SESSION['type'] ?? '';
$drive = isset($_SESSION['drive']) ? $driveDisplay[$_SESSION['drive']] ?? '' : '';
$priceuntil = $_SESSION['price'] ?? '';
$sorting = $_SESSION['sorting'] ?? '';
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produktübersicht</title>
    <link rel="stylesheet" href="P.RideReady.css">
    <style>
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
                $a_manufacturers = ["Audi", "BMW", "Ford", "Jaguar", "Maserati", "Mercedes-AMG", "Mercedes-Benz", "Opel", "Range Rover", "Skoda", "Volkswagen"]; // Bei Mercedes AMG vllt die Daten nochmla anpassen
                $a_seats = ["2", "4", "5", "7", "8", "9"];
                $a_doors = ["2", "3", "4", "5"];
                $a_transmission = ["Automatik", "Manuell"];
                $a_age = ["18+", "21+", "25+"];
                $a_type = ["Cabrio", "Combi", "Coupé" , "Limousine", "Mehrsitzer", "SUV"];
                $a_drive = ["Verbrenner", "Elektro"];
                $a_priceuntil = ["100€", "150€", "200€", "250€","300€", "400€", "500€", "600€", "700€", "800€"];
                $a_sorting = ["Preis aufsteigend", "Preis absteigend",];

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
                renderFilterGroup('Preis bis', 'price', $a_priceuntil, $priceuntil);
                renderFilterGroup('Sortierung', 'sorting', $a_sorting, $sorting);
            ?>  


            <!-- Buttons für Filtern und Zurücksetzen -->
            <div class="filter-group">
                <button type="submit" name="filter">Filtern</button>
            </div>
            <div class="filter-group">
                <button type="submit" name="reset" value="product_reset">Filter zurücksetzen</button>
            </div>
        </form>
    </div>
</body>
</html>
