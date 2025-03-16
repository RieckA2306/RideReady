<!-- Salwa -->
<!DOCTYPE html>  
<html lang="de">
<head>  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=1920">
    <link rel="stylesheet" href="P.RideReadyProductoverview.css?v=1.1">
    <title>Meine Buchungen</title>
    <style>
        /* Allgemeine Body-Styling */
        .produktübersicht-body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            margin: auto;
            background-color: #F0F0F0;
            margin: 0;
        }

        /* Hauptinhalt */
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

        /* Container für die gesamte Tabelle */
        .table-container {
            width: 100%;
            display: flex;
            flex-direction: column;
        }

        /* Header-Zeile */
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

        /* Styling für Daten-Zeilen */
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

    <!-- Wrapper für den Hauptinhalt -->
    <div class="produktübersicht-content">
        
        <!-- Tabelle -->
        <div class="table-container">
            <!-- Header-Zeile -->
            <div class="header-row">
                <div class="header-box">Buchungsnummer</div>
                <div class="header-box">Abholdatum</div>
                <div class="header-box">Rückgabedatum</div>
                <div class="header-box">Gebuchtes Fahrzeug</div>
                <div class="header-box">Buchungsdatum</div>
            </div>

            <!-- PHP: Dynamische Buchungseinträge -->
            <?php 
            include 'dbConfigJosef.php';

            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            if (!isset($_SESSION['account_id'])) {
                echo "<p>Bitte melden Sie sich an, um Ihre Buchungen zu sehen.</p>";
                exit;
            }

            $user_id = $_SESSION['account_id']; // ID des aktuellen Benutzers

        
                try {
                    
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
                
                    if ($buchungen) {
                        foreach ($buchungen as $row) {
                            echo '<div class="data-row">';
                            echo '<div class="entry-box">' . htmlspecialchars($row["Contract_ID"]) . '</div>';
                            echo '<div class="entry-box">' . htmlspecialchars($row["Start_Date"]) . '</div>';
                            echo '<div class="entry-box">' . htmlspecialchars($row["End_Date"]) . '</div>';
                            echo '<div class="entry-box">' . htmlspecialchars($row["ConcatName"]) . '</div>'; // 
                            echo '<div class="entry-box">' . htmlspecialchars($row["DateOfBooking"]) . '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo "<p>Keine Buchungen gefunden. Sie haben noch keine Buchung getätigt.</p>";
                    }
                } catch (PDOException $e) {
                    echo "<p>SQL Fehler: " . $e->getMessage() . "</p>";
                }
                
    
            ?>
        </div>
    </div>

    <?php include 'P.RideReadyFooter.php'; ?>

</body>
</html>
