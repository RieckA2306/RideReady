<?php
require_once 'Functions.php';
check_if_session_started();
deny_allowance_for_direct_access();

// Save values ​​from the form to the session
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Execute only if "Filter zurücksetzen" was pressed
    if (isset($_POST['reset']) && $_POST['reset'] === 'header_reset') {
        // Reset only the header session values
        unset($_SESSION['city'], $_SESSION['pickupdate'], $_SESSION['returndate']);
        
        // Stay on the current page
        $currentPage = $_SERVER['HTTP_REFERER'] ?? 'Landingpage.php';
        header('Location: ' . $currentPage);
        exit();
        
    } elseif (isset($_POST['city']) || isset($_POST['pickupdate']) || isset($_POST['returndate'])) {
        $city = $_POST['city'] ?? '';
        $pickupdate = $_POST['pickupdate'] ?? '';
        $returndate = $_POST['returndate'] ?? '';

        // Check whether ALL fields are filled out
        if (!empty($city) && !empty($pickupdate) && !empty($returndate)) {
            // The session variables are only saved if all values ​​are set
            $_SESSION['city'] = $city;
            $_SESSION['pickupdate'] = $pickupdate;
            $_SESSION['returndate'] = $returndate;
            
            // Redirect to Productoverview
            header('Location: Productoverview.php');
            exit();
        } elseif (isset($_SESSION['username']) && $_SESSION['username'] === "Admin") {
            // Admin Testing Mode
        } else {
            // Don't save any values ​​and stay on the current page
            echo '<script>alert("Bitte füllen Sie alle Felder aus!");</script>';
        }
    }
}

// set default values
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
    <link rel="stylesheet" href="RideReady.css?v=1.1">

<?php
    function banner() {
    global $login; 
    if (isset($_SESSION["isloggedin"])) {

        include "Header_Menu_LoggedIn.php";
    } else {
        include "Header_Menu.php";
    }
    }
?>

<style>
</style>
</head>
<body class="header-body">
    <div class="header">
        <div class="Header-logo">
            <a href="Landingpage.php">
                <p class="Header-Footer-logo">
                    <img src="Images/logo.png" alt="Ride Ready Logo">
                </p>
            </a>
        </div>
        
        <!-- Start of the Searchbar -->
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

                <!-- Visible date entries for ease of use -->
                <input type="text" id="abholdatum" placeholder="Abholdatum" 
                       value="<?php echo htmlspecialchars($pickupdate ? date('d.m.Y', strtotime($pickupdate)) : ''); ?>" autocomplete="off">
                <input type="text" id="rueckgabedatum" placeholder="Rückgabedatum" 
                       value="<?php echo htmlspecialchars($returndate ? date('d.m.Y', strtotime($returndate)) : ''); ?>" autocomplete="off">

                <!-- Hidden input fields for actual form submission -->
                <input type="hidden" name="pickupdate" id="hiddenPickupdate">
                <input type="hidden" name="returndate" id="hiddenReturndate">

                <button type="submit" id="suchen">Suchen</button>
                <button type="submit" name="reset" value="header_reset">Filter zurücksetzen</button>
            </div>
        </form>
        <!-- Check if you are an Admin -->
        <?php
            if (isset($_SESSION['username']) && $_SESSION['username'] === 'Admin') {
                echo '
                <div class="add-cars-admin">
                    <a href="Productoverview_Admin.php">Autos hinzufügen</a>
                </div>
                <div class="cancel-bookings-admin">
                    <a href="AllBookings_Admin.php">Buchungen stornieren</a>
                </div>
                </a>';
            } else {
                // Just Placeholders that the bar does not slip to the right
                echo '
                <div class="add-cars-no-admin">
                </div>
                <div class="cancel-bookings-no-admin">
                </div>';
            }
        ?>

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

            // Conversion of date formats into hidden fields for the correct date format
            document.querySelector("#reservierungsFormular").addEventListener("submit", function(e) {
                // Write pickup date in hidden field
                let abholInput = document.querySelector("#abholdatum");
                let hiddenAbholInput = document.querySelector("#hiddenPickupdate");
                let abholDate = flatpickr.parseDate(abholInput.value, "d.m.Y");
                hiddenAbholInput.value = flatpickr.formatDate(abholDate, "Y-m-d");

                // Write return date in hidden field
                let rueckgabeInput = document.querySelector("#rueckgabedatum");
                let hiddenRueckgabeInput = document.querySelector("#hiddenReturndate");
                let rueckgabeDate = flatpickr.parseDate(rueckgabeInput.value, "d.m.Y");
                hiddenRueckgabeInput.value = flatpickr.formatDate(rueckgabeDate, "Y-m-d");
            });
        });
    </script>

    <!-- Script for the Menu Button -->
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