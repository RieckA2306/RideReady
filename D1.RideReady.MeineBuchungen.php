<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=1920">
    <title>BMW Karten</title>
    <style>
        /* Body nur als generelle Hintergrundgestaltung */
        .produktübersicht-body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            margin: auto;
            background-color: #F0F0F0;
            /* font-family: "Inter", serif; */
            margin: 0;

        }

        /* Wrapper für den Hauptinhalt */
        .produktübersicht-content {
            flex-direction: column;
            display: flex;
            padding: 20px;
            background-color:white;
            width:80%;
            margin: auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            min-height: 430px; /* So, dass der Footer unten bleibt */
            
        }
        
        /* Balkem für die Buchung */
        .card {
            width: 100%;
            height: 50px;
            background-color: #123472;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            margin-top: 15px;
            
            
        }

        .timeline {
            width: 100%;
            height: 50px;
            border-radius: 10px;
            background: 
            linear-gradient(to right, #123472 0% 14%,  /* Block 1 */
            transparent 14% 15%, /* Lücke */ #123472 15% 100%  /* Block 2 */
            );
            display: flex;
            align-items: center;
            color: white;
            font-weight: bold;
        }

        .eintraege {
            margin-left: 200px;

        }

        
    </style>
</head>
<body class="produktübersicht-body">
    <?php include 'P.RideReadyHeader.php'; ?>

    <!-- Wrapper für den Hauptinhalt -->
    <div class="produktübersicht-content">
        <span>Buchungsnummer</span>
        <div class="timeline">
            <span>1</span>
            <span class="eintraege">2</span>

        </div>
        <?php
            $cardCount = 5; 

            for ($i = 0; $i < $cardCount; $i++) {
                include 'MeineBuchungVerlinkung.php';
                global $x;
            }         
       ?>
    </div>

    <?php include 'P.RideReadyFooter.php'; ?>
</body>
</html>
