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
        
        /* Balkem für die Buchung, in denen dann die einzelnen Divs sind*/
        .card-MB {
            width: 100%;
            max-height: 50px;
            height: 50px;
            background-color: white;
            border-radius: 10px;
            margin-top: 15px;
            display: flex;
        }
        /* Obere Divs Start*/
        /* Klasse für die einzelnen Felder (Buchungsnummer) */
        .bookingnumber-div {
            width: 14%;
            height: 50px;
            background-color: #b3b3b3;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        /* Klasse für die einzelnen Felder (Abholdatum) */
        .pickup-retunr-dates-div {
            width: 14%;
            height: 50px;
            background-color: #b3b3b3;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            margin-left: 20px; /* Abstand zum nächsten Feld */
        }

        .booked-vehicle-div {
            width: 39%;
            height: 50px;
            background-color: #b3b3b3;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            margin-left: 20px; /* Abstand zum nächsten Feld */
        }

        .booked-on-div {
            width: 14%;
            height: 50px;
            background-color: #b3b3b3;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            margin-left: 20px; /* Abstand zum nächsten Feld */
        }
        /* Obere Divs Ende */
        
    </style>
</head>
<body class="produktübersicht-body">
    <?php include 'P.RideReadyHeader.php'; ?>

    <!-- Wrapper für den Hauptinhalt -->
    <div class="produktübersicht-content">
        <div class="card-MB">
            <div class="bookingnumber-div"><p class="textforbookingnumber">Buchungsnummer</p>
            </div>
            <div class="pickup-retunr-dates-div "><p class="textforbookingnumber">Abholdatum</p>
            </div>
            <div class="pickup-retunr-dates-div "><p class="textforbookingnumber">Rückgabedatum</p>
            </div>
            <div class="booked-vehicle-div"><p class="textforbookingnumber">gebuchtes Fahrzeug</p>
            </div>
            <div class="booked-on-div"><p class="textforbookingnumber">Buchungsdatum</p>
            </div>

        </div>
        <?php
            $cardCount = 5; 

            for ($i = 0; $i < $cardCount; $i++) {
                include 'P.MeineBuchungVerlinkung.php';
                global $x;
            }         
       ?>
    </div>

    <?php include 'P.RideReadyFooter.php'; ?>
</body>
</html>
