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

        /* Pagination Styling */
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination a {
            margin: 5px;
            padding: 10px 15px;
            background-color: #80BFFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .pagination a:hover {
            background-color: #0056b3;
        }

        .pagination .active {
            background-color: #0056b3;
            font-weight: bold;
        }
    </style>
</head>
<body class="produktübersicht-body">

    <?php include 'P.RideReadyHeader.php'; ?>

    <div class="produktübersicht-content">
        <div class="table-container">
            <!-- Header-Zeile -->
            <div class="header-row">
                <div class="header-box">Vertrag Stornieren</div>
                <div class="header-box">Buchungsnummer</div>
                <div class="header-box">Abholdatum</div>
                <div class="header-box">Rückgabedatum</div>
                <div class="header-box">Gebuchtes Fahrzeug</div>
                <div class="header-box">Buchungsdatum</div>
            </div>

            <!-- PHP: Dynamische Buchungseinträge mit Pagination -->
            <?php 
            include 'dbConfigJosef.php';
  
            if (!isset($_SESSION['account_id'])) {
                echo "<p>Bitte melden Sie sich an, um Ihre Buchungen zu sehen.</p>";
                exit;
            }

            $user_id = $_SESSION['account_id'];

            // Pagination Einstellungen
            $limit = 5; // Anzahl der Buchungen pro Seite
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $offset = ($page - 1) * $limit;

            try {
                // Gesamtanzahl der Buchungen abrufen
                $stmt = $pdo->prepare("SELECT COUNT(*) FROM contract");
                $stmt->execute();
                $totalRows = $stmt->fetchColumn();
                $totalPages = ceil($totalRows / $limit);

                // Buchungen für die aktuelle Seite abrufen
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
                $buchungen = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if ($buchungen) {
                    foreach ($buchungen as $row) {
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

    <?php include 'P.RideReadyFooter.php'; ?>

</body>
</html>
