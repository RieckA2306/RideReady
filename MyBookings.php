<!-- 
    This page displays a user's car rental bookings.
    It retrieves data from the database and presents it in a table format.
    This page appears when the user clicks on "My Bookings"
-->

<!DOCTYPE html>  
<html lang="de"> <!-- Sets the document language to German -->
<head>  
    <meta charset="UTF-8"> <!-- Ensures proper character encoding -->
    <meta name="viewport" content="width=1920"> <!-- Defines the viewport width for better responsiveness -->
    <title>Meine Buchungen</title> <!-- Sets the title of the page -->

    <!-- Links an external CSS file for styling with a version parameter to prevent caching issues -->
    <link rel="stylesheet" href="RideReady.css?v=1.1">

   
<body class="Booking-body"> <!-- Applies a CSS class to the body for styling -->

    <!-- Includes the header section -->
    <?php include 'Header.php'; ?>

    <!-- Main content wrapper -->
    <div class="Booking-content">
        
        <!-- Booking Table -->
        <div class="table-container">
            <!-- Table header row -->
            <div class="header-row">
                <div class="header-box">Buchungsnummer</div>
                <div class="header-box">Abholdatum</div>
                <div class="header-box">Rückgabedatum</div>
                <div class="header-box">Gebuchtes Fahrzeug</div>
                <div class="header-box">Buchungsdatum</div>
            </div>

            <!-- PHP: Fetch and display user bookings dynamically -->
            <?php 
            include 'dbConfig.php'; // Includes database connection

            // Start session if not already started
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            // Check if user is logged in
            if (!isset($_SESSION['account_id'])) {
                echo "<p>Bitte melden Sie sich an, um Ihre Buchungen zu sehen.</p>";
                exit; // Exit the script if the user is not logged in
            }

            $user_id = $_SESSION['account_id']; // Get the logged-in user's ID

            try {
                // SQL query to fetch booking details for the logged-in user
                $sql = "SELECT c.Contract_ID, 
                               c.Start_Date,  
                               c.End_Date,
                               CONCAT(m.Vendor_Name, ' ', m.Name, ' ', IFNULL(m.Name_Extension, '')) AS ConcatName, 
                               c.DateOfBooking
                        FROM contract c
                        JOIN car ca ON c.Car_ID = ca.Car_ID
                        JOIN model m ON ca.Type_ID = m.Type_ID
                        WHERE c.Account_ID = :user_id";
            
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                $stmt->execute();
                $buchungen = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
                // If bookings are found, display them in table rows
                if ($buchungen) {
                    foreach ($buchungen as $row) {
                        echo '<div class="data-row">';
                        echo '<div class="entry-box">' . htmlspecialchars($row["Contract_ID"]) . '</div>';
                        echo '<div class="entry-box">' . htmlspecialchars($row["Start_Date"]) . '</div>';
                        echo '<div class="entry-box">' . htmlspecialchars($row["End_Date"]) . '</div>';
                        echo '<div class="entry-box">' . htmlspecialchars($row["ConcatName"]) . '</div>';
                        echo '<div class="entry-box">' . htmlspecialchars($row["DateOfBooking"]) . '</div>';
                        echo '</div>';
                    }
                } else {
                    // Display message if no bookings are found
                    echo "<p>Keine Buchungen gefunden. Sie haben noch keine Buchung getätigt.</p>";
                }
            } catch (PDOException $e) {
                // Display an error message if the SQL query fails
                echo "<p>SQL Fehler: " . $e->getMessage() . "</p>";
            }
            ?>
        </div>
    </div>

    <!-- Includes the footer section -->
    <?php include 'Footer.php'; ?>

</body>
</html>
