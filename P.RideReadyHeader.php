<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Werte aus dem Formular in die Session speichern
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['reset'])) {
        // Session-Werte löschen, wenn "Filter zurücksetzen" geklickt wurde
        unset($_SESSION['city'], $_SESSION['abholdatum'], $_SESSION['rueckgabedatum']);
        
        // Umleitung zur Landingpage, um doppeltes Senden des Formulars zu verhindern
        header('Location: P.RideReady.Landingpage.php');
        exit();
    } else {
        $_SESSION['city'] = $_POST['city'] ?? '';
        $_SESSION['abholdatum'] = $_POST['abholdatum'] ?? '';
        $_SESSION['rueckgabedatum'] = $_POST['rueckgabedatum'] ?? '';
        
        // Umleitung zur Produktübersicht, um doppeltes Senden des Formulars zu verhindern
        header('Location: P.RideReady.Produktübersicht.php');
        exit();
    }
}

// Standardwerte setzen, falls Session leer ist
$city = $_SESSION['city'] ?? '';
$abholdatum = $_SESSION['abholdatum'] ?? '';
$rueckgabedatum = $_SESSION['rueckgabedatum'] ?? '';
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
    if ($_SESSION[$login] == false) {

        include "nologin.php";
    } else {
        include "jologin.php";
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
            top: 70%;
            right: 1%;
            display: none;
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
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div class="search-box">
                <select name="city" id="abholort">
                    <option value="">Abholort</option>
                    <?php
                    $cities = ["Berlin", "Bielefeld", "Bochum", "Bremen", "Dortmund", "Dresden", "Freiburg", "Hamburg", "Köln", "Leipzig", "München", "Nürnberg", "Paderborn", "Rostock"];
                    foreach ($cities as $cityOption) {
                        $selected = ($cityOption == $city) ? 'selected' : '';
                        echo "<option value='$cityOption' $selected>$cityOption</option>";
                    }
                    ?>
                </select>

                <input type="text" name="abholdatum" id="abholdatum" placeholder="Abholdatum" value="<?php echo htmlspecialchars($abholdatum); ?>">
                <input type="text" name="rueckgabedatum" id="rueckgabedatum" placeholder="Rückgabedatum" value="<?php echo htmlspecialchars($rueckgabedatum); ?>">

                <button type="submit" id="suchen">Suchen</button>
                <button type="submit" name="reset" value="1">Filter zurücksetzen</button>
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
                onChange: function(selectedDates, dateStr) {
                    let rueckgabeMinDate = new Date(selectedDates[0]);
                    rueckgabeMinDate.setDate(rueckgabeMinDate.getDate() + 1);
                    rueckgabeDatePicker.set("minDate", rueckgabeMinDate);
                }
            });

            let rueckgabeDatePicker = flatpickr("#rueckgabedatum", {
                dateFormat: "d.m.Y",
                minDate: new Date(new Date().setDate(new Date().getDate() + 1)),
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