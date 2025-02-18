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
            background-color: gray;
            border-radius: 10px;
            margin-top: 15px;
            display: flex;
        }

        /* Klasse für die einzelnen Felder (Buchungsnummer) */
        .bookingnumberdiv {
            width: 15%;
            height: 50px;
            background-color: #123472;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        /* Klasse für die einzelnen Felder (Abholdatum) */
        .pickupdatediv {
            width: 15%;
            height: 50px;
            background-color: #123472;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            margin-left: 20px; /* Abstand zum nächsten Feld */
        }

        
    </style>
</head>
<body class="produktübersicht-body">
    <?php include 'P.RideReadyHeader.php'; ?>

    <!-- Wrapper für den Hauptinhalt -->
    <div class="produktübersicht-content">
        <div class="card">
            <div class="bookingnumberdiv"><p class="textforbookingnumber">Buchungsnummer</p>
            </div>
            <div class="pickupdatediv"><p class="textforbookingnumber">Abholdatum</p>
            </div>
            <div class="pickupdatediv"><p class="textforbookingnumber">Rückgabedatum</p>
            </div>
            <div class="pickupdatediv"><p class="textforbookingnumber">gebuchtes Fahrzeug</p>
            </div>
            <div class="pickupdatediv"><p class="textforbookingnumber">Buchungsdatum</p>
            </div>

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
