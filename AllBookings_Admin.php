<?php
require_once 'Functions.php';
check_if_session_started();
deny_allowance_for_direct_access_just_Admins();

// Prüfen, ob der Benutzer eingeloggt ist und Admin-Rechte hat
if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'Admin') {
    die('Zugriff verweigert. Diese Seite ist nur für Administratoren.');
}
?>
<!-- This Site will open if someone pushes the Button "Buchung Stornieren in the Header -->
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=1920">
    <title>Meine Buchungen</title>


    <link rel="stylesheet" href="RideReady.css?v=1.1">

<body class="Booking-body">

    <?php  
    define('ALLOW_HEADER_INCLUDE', true);
    include 'Header.php';
     ?>

    <div class="Booking-content">
        <div class="table-container">
            <!-- Headline of rows -->
            <div class="header-row">
                <div class="header-box">Vertrag Stornieren</div>
                <div class="header-box">Buchungsnummer</div>
                <div class="header-box">Abholdatum</div>
                <div class="header-box">Rückgabedatum</div>
                <div class="header-box">Gebuchtes Fahrzeug</div>
                <div class="header-box">Buchungsdatum</div>
            </div>

     
            <?php 
            include 'dbConfig.php';
  
            if (!isset($_SESSION['account_id'])) {
                echo "<p>Bitte melden Sie sich an, um Ihre Buchungen zu sehen.</p>";
                exit;
            }

            $user_id = $_SESSION['account_id'];

            // Pagination settings and variables 
            $limit = 5; // Number of rows 
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $offset = ($page - 1) * $limit;

            try {
                // counting all bookings and setting number of pages
                $stmt = $pdo->prepare("SELECT COUNT(*) FROM contract");
                $stmt->execute();
                $totalRows = $stmt->fetchColumn();
                $totalPages = ceil($totalRows / $limit);

                // SQL Request for current site 
                $sql = "SELECT c.Contract_ID, 
                               c.Start_Date,  
                               c.End_Date,
                               CONCAT(m.Vendor_Name, ' ', m.Name, ' ', IFNULL(m.Name_Extension, '')) AS ConcatName, 
                               c.DateOfBooking
                        FROM contract c
                        JOIN car ca ON c.Car_ID = ca.Car_ID
                        JOIN model m ON ca.Type_ID = m.Type_ID
                        LIMIT :limit OFFSET :offset";

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
                $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
                $stmt->execute();
                $booking = $stmt->fetchAll(PDO::FETCH_ASSOC);

                // creating a Delete-Button for every car_ID. The Delete-Button executes deletContract.php
                // printing Bookingdata from Array 
                if ($booking) {
                    foreach ($booking as $row) {
                        echo '<div class="data-row">';
                        echo '<div class="entry-box"><a href="deleteContract.php?'. urlencode($row["Contract_ID"]) .'">Löschen</a></div>';
                        echo '<div class="entry-box">' . htmlspecialchars($row["Contract_ID"]) . '</div>';
                        echo '<div class="entry-box">' . htmlspecialchars($row["Start_Date"]) . '</div>';
                        echo '<div class="entry-box">' . htmlspecialchars($row["End_Date"]) . '</div>';
                        echo '<div class="entry-box">' . htmlspecialchars($row["ConcatName"]) . '</div>'; 
                        echo '<div class="entry-box">' . htmlspecialchars($row["DateOfBooking"]) . '</div>';
                        echo '</div>';
                    }
                } else {
                    echo "<p>Keine Buchungen gefunden.</p>";
                }
            } catch (PDOException $e) {
                echo "<p>SQL Fehler: " . $e->getMessage() . "</p>";
            }
            ?>

            <!-- Pagination Links -->
            <div class="pagination">
                <?php if ($page > 1): ?>
                    <a href="?page=<?= $page - 1 ?>">« Vorherige</a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="?page=<?= $i ?>" class="<?= ($i == $page) ? 'active' : '' ?>"><?= $i ?></a>
                <?php endfor; ?>

                <?php if ($page < $totalPages): ?>
                    <a href="?page=<?= $page + 1 ?>">Nächste »</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php define('ALLOW_FOOTER_INCLUDE', true);
    include 'Footer.php';
     ?>

</body>
</html>
