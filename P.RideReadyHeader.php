<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
ini_set('display_errors', 1);
error_reporting(E_ALL);


// Werte aus dem Formular in die Session speichern
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Nur ausführen, wenn "Suchen" oder "header_reset" gedrückt wurde
    if (isset($_POST['reset']) && $_POST['reset'] === 'header_reset') {
        // Nur die Header-Session-Werte zurücksetzen
        unset($_SESSION['city'], $_SESSION['pickupdate'], $_SESSION['returndate']);
        
        // Auf der aktuellen Seite bleiben
        $currentPage = $_SERVER['HTTP_REFERER'] ?? 'P.RideReady.Landingpage.php';
        header('Location: ' . $currentPage);
        exit();
        
    } elseif (isset($_POST['city']) || isset($_POST['pickupdate']) || isset($_POST['returndate'])) {
        $city = $_POST['city'] ?? '';
        $pickupdate = $_POST['pickupdate'] ?? '';
        $returndate = $_POST['returndate'] ?? '';

        // Überprüfung, ob ALLE Felder ausgefüllt sind
        if (!empty($city) && !empty($pickupdate) && !empty($returndate)) {
            // Nur wenn alle Werte gesetzt sind, werden die Session-Variablen gespeichert
            $_SESSION['city'] = $city;
            $_SESSION['pickupdate'] = $pickupdate;
            $_SESSION['returndate'] = $returndate;
            
            // Umleitung zur Produktübersicht
            header('Location: P.RideReady.Produktübersicht.php');
            exit();
        } else {
            // Keine Werte speichern und auf der aktuellen Seite bleiben
            echo '<script>alert("Bitte füllen Sie alle Felder aus!");</script>';
        }
    }
}

// Standardwerte setzen, falls Session leer ist
$city = $_SESSION['city'] ?? '';
$pickupdate = $_SESSION['pickupdate'] ?? '';
$returndate = $_SESSION['returndate'] ?? '';
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ride Ready - Header</title>
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<?php
    function banner() {
    global $login; 
    if (isset($_SESSION["eingeloggt"])) {

        include "jologin.php";
    } else {
        include "nologin.php";
    }

    }
?>

<style>
        /* Allgemeines Styling */
        .header-body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: white;
        }
        
        
        /* Header Styling */
        .header {
            display: flex;
            align-items: center; /* Vertikale Zentrierung */
            justify-content: space-between;
            padding: 20px;
            background-color: #123472;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .logo img {
            height: 40px; /* Platzhalter für dein Logo */
        }
        
        .search-box {
            display: flex;
            gap: 10px;
            background: white;
            padding: 10px;
            border-radius: 5px;
            margin-right: 130px;
        }

        .search-box select, .search-box input, .search-box button {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        
        .search-box button {
            background-color: #80BFFF;
            color: white;
            border: none;
            cursor: pointer;
        }
        
        .search-box button:hover {
            background-color: #123472;
        }
        /* Ändert die Hintergrundfarbe des ausgewählten Datums */
        .flatpickr-day.selected, 
        .flatpickr-day.selected:hover {
            background: #80BFFF !important;
            border-color: #80BFFF !important;
            color: white !important;
        }

        /* Falls mehrere Tage in einem Bereich ausgewählt werden können */
        .flatpickr-day.inRange {
        background: #B3DAFF !important;
        color: white !important;

        
            }
            .hamburger-button {
            background-color: white;
            border: none;
            border-radius: 8px;
            width: 40px;
            height: 40px;
            cursor: pointer;
        }

        .hamburger-button span {
            display: block;
            width: 20px;
            height: 3px;
            background-color: #999;
            margin: 4px auto;
        }
        /* css Style for the Banner/menu */
        .menu {
            width: 300px;
            border: 2px solid black;
            border-radius: 10px;
            padding: 10px;
            background-color: white;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            position: absolute;
            top: 10%;
            right: 1%;
            display: none;
            z-index: 1000;
            text-align: left;
        }
        .menu a {
            display: block;
            text-decoration: none;
            color: black;
            padding: 5px 0;
        }

        .menu button {
            width: 100%;
            padding: 10px;
            background-color: #FFC107;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            font-weight: bold;
        }

</style>
</head>
<body class="header-body">
    <div class="header">
        <div class="logo">
            <a href="P.RideReady.Landingpage.php">
                <p class="Header-Footer-logo">
                    <img src="Images/logo.png" alt="Ride Ready Logo">
                </p>
            </a>
        </div>

        <!-- Formular auf POST-Methode umgestellt -->
        <form id="reservierungsFormular" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div class="search-box">
                <select name="city" id="abholort">
                    <option value="">Abholort</option>
                    <?php
                    $a_cities = ["Berlin", "Bielefeld", "Bochum", "Bremen", "Dortmund", "Dresden", "Freiburg", "Hamburg", "Köln", "Leipzig", "München", "Nürnberg", "Paderborn", "Rostock"];
                    foreach ($a_cities as $cityOption) {
                        $selected = ($cityOption == $city) ? 'selected' : '';
                        echo "<option value='$cityOption' $selected>$cityOption</option>";
                    }
                    ?>
                </select>

                <!-- Sichtbare Datumseingaben für Benutzerfreundlichkeit -->
                <input type="text" id="abholdatum" placeholder="Abholdatum" 
                       value="<?php echo htmlspecialchars($pickupdate ? date('d.m.Y', strtotime($pickupdate)) : ''); ?>" autocomplete="off">
                <input type="text" id="rueckgabedatum" placeholder="Rückgabedatum" 
                       value="<?php echo htmlspecialchars($returndate ? date('d.m.Y', strtotime($returndate)) : ''); ?>" autocomplete="off">

                <!-- Versteckte Input-Felder für die tatsächliche Formularübermittlung -->
                <input type="hidden" name="pickupdate" id="hiddenPickupdate">
                <input type="hidden" name="returndate" id="hiddenReturndate">

                <button type="submit" id="suchen">Suchen</button>
                <button type="submit" name="reset" value="header_reset">Filter zurücksetzen</button>
            </div>
        </form>

        <button class="hamburger-button" onclick="toggleMenu()">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>
    
    <?php 
    banner();
    ?>
    
    <!-- Flatpickr JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let abholDatePicker = flatpickr("#abholdatum", {
                dateFormat: "d.m.Y",
                minDate: "today",
                defaultDate: "<?php echo !empty($pickupdate) ? date('d.m.Y', strtotime($pickupdate)) : ''; ?>",
                onChange: function(selectedDates, dateStr) {
                    if (selectedDates.length > 0) {
                        let rueckgabeMinDate = new Date(selectedDates[0]);
                        rueckgabeDatePicker.set("minDate", rueckgabeMinDate);
                    }
                }
            });

            let rueckgabeDatePicker = flatpickr("#rueckgabedatum", {
                dateFormat: "d.m.Y",
                minDate: "today",
                defaultDate: "<?php echo !empty($returndate) ? date('d.m.Y', strtotime($returndate)) : ''; ?>"
            });

            // Konvertierung der Datumsformate in versteckte Felder für das Korrekte Datum Format
            document.querySelector("#reservierungsFormular").addEventListener("submit", function(e) {
                // Abholdatum in verstecktes Feld schreiben
                let abholInput = document.querySelector("#abholdatum");
                let hiddenAbholInput = document.querySelector("#hiddenPickupdate");
                let abholDate = flatpickr.parseDate(abholInput.value, "d.m.Y");
                hiddenAbholInput.value = flatpickr.formatDate(abholDate, "Y-m-d");

                // Rückgabedatum in verstecktes Feld schreiben
                let rueckgabeInput = document.querySelector("#rueckgabedatum");
                let hiddenRueckgabeInput = document.querySelector("#hiddenReturndate");
                let rueckgabeDate = flatpickr.parseDate(rueckgabeInput.value, "d.m.Y");
                hiddenRueckgabeInput.value = flatpickr.formatDate(rueckgabeDate, "Y-m-d");
            });
        });
    </script>
    
    <!-- Script für das Menü -->
    <script>
        function toggleMenu() {
            var menu = document.getElementById("menu");
            if (menu.style.display === "none" || menu.style.display === "") {
                menu.style.display = "block";
            } else {
                menu.style.display = "none";
            }
        }
    </script>
</body>
</html>