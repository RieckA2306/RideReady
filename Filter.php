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

// Save values ​​from the form to the session
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['reset']) && $_POST['reset'] === 'product_reset') {
        // Reset filter: Instead of deleting the session variables completely, they are set to default values ​​to avoid undefined array key warnings.
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

// Reverse mapping for display
$driveDisplay = array_flip($driveMapping);
$transmissionDisplay = array_flip($transmissionMapping);

// Prepare filter values ​​for display
$manufacturer = $_SESSION['manufacturer'] ?? '';
$seats = $_SESSION['seats'] ?? '';
$doors = $_SESSION['doors'] ?? '';
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
    <link rel="stylesheet" href="P.RideReadyProductoverview.css">
</head>
<body>
    <div class="filter-bar">
    <form method="post" action="P.RideReady.Produktübersicht.php" class="form-wrapper">
            <?php
                require_once 'Functions.php';

                // Define all Arrays for the Filteroptions:
                $a_manufacturers = ["Audi", "BMW", "Ford", "Jaguar", "Maserati", "Mercedes-AMG", "Mercedes-Benz", "Opel", "Range Rover", "Skoda", "Volkswagen"];
                $a_seats = ["2", "4", "5", "7", "8", "9"];
                $a_doors = ["2", "3", "4", "5"];
                $a_transmission = ["Automatik", "Manuell"];
                $a_age = ["18+", "21+", "25+"];
                $a_type = ["Cabrio", "Combi", "Coupé" , "Limousine", "Mehrsitzer", "SUV"];
                $a_drive = ["Verbrenner", "Elektro"];
                $a_priceuntil = ["100€", "150€", "200€", "250€","300€", "400€", "500€", "600€", "700€", "800€"];
                $a_sorting = ["Preis aufsteigend", "Preis absteigend",];

                // Call the create Filter Function:
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


            <!-- Buttons to set/reset Filters -->
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
