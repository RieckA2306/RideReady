<!DOCTYPE html>  
<html lang="de">
<head>  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=1920">
    <link rel="stylesheet" href="P.RideReadyProductoverview.css?v=1.1">
    <title>Meine Buchungen</title>
    <style>
        /* General body styling */
        .produktübersicht-body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            margin: auto;
            background-color: #F0F0F0;
            margin: 0;
        }

        /* Main content styling */
        .produktübersicht-content {
            flex-direction: column;
            display: flex;
            padding: 20px;
            background-color: white;
            width: 80%;
            margin: auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            min-height: 430px;
        }

        /* Container for the entire table */
        .table-container {
            width: 100%;
            display: flex;
            flex-direction: column;
        }

        /* Header row styling */
        .header-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .header-box {
            width: 18%;
            height: 50px;
            background-color: #80BFFF;
            color: white;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            margin: 5px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Styling for data rows */
        .data-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }

        .entry-box {
            width: 18%;
            height: 50px;
            background-color: #D3D3D3;
            color: black;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            margin: 5px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="produktübersicht-body">

    <?php include 'P.RideReadyHeader.php'; ?>

    <!-- Wrapper for the main content section -->
    <div class="produktübersicht-content">
        
        <!-- Table container -->
        <div class="table-container">
            <!-- Header row (column titles) -->
            <div class="header-row">
                <div class="header-box">Booking Number</div>
                <div class="header-box">Pick-up Date</div>
                <div class="header-box">Return Date</div>
                <div class="header-box">Booked Vehicle</div>
                <div class="header-box">Booking Date</div>
            </div>

            <!-- PHP: Dynamically fetch and display booking entries -->
            <?php 
            include 'dbConfigJosef.php';

            // Start the session if it hasn't been started yet
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            // Check if the user is logged in
            if (!isset($_SESSION['account_id'])) {
                echo "<p>Please log in to view your bookings.</p>";
                exit;
            }

            $user_id = $_SESSION['account_id']; // ID of the current user

            try {
                // Query to retrieve user-specific bookings
                $sql = "SELECT c.Contract_ID, 
                               c.Start_Date,  
                               c.End_Date,
                               CONCAT(m.Vendor_Name, ' ', m.Name, ' ', IFNULL(m.Name_Extension, '')) AS ConcatName, 
                               c.DateOfBooking
                        FROM contract c
                        JOIN car ca ON c.Car_ID = ca.Car_ID
                        JOIN model m ON ca.Type_ID = m.Type_ID
                        WHERE c.Account_ID = :user_id";
            
                // Prepare and execute the query
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                $stmt->execute();
                $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
                // If bookings exist, display them in table rows
                if ($bookings) {
                    foreach ($bookings as $row) {
                        echo '<div class="data-row">';
                        echo '<div class="entry-box">' . htmlspecialchars($row["Contract_ID"]) . '</div>';
                        echo '<div class="entry-box">' . htmlspecialchars($row["Start_Date"]) . '</div>';
                        echo '<div class="entry-box">' . htmlspecialchars($row["End_Date"]) . '</div>';
                        echo '<div class="entry-box">' . htmlspecialchars($row["ConcatName"]) . '</div>'; 
                        echo '<div class="entry-box">' . htmlspecialchars($row["DateOfBooking"]) . '</div>';
                        echo '</div>';
                    }
                } else {
                    echo "<p>No bookings found. You have not made any bookings yet.</p>";
                }
            } catch (PDOException $e) {
                // Handle any SQL errors
                echo "<p>SQL Error: " . $e->getMessage() . "</p>";
            }
            ?>
        </div>
    </div>

    <?php include 'P.RideReadyFooter.php'; ?>

</body>
</html>
