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
            flex: 1; /* Stellt sicher, dass der Inhalt wächst */
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        /* Container für Karten */
        .produktübersicht-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            max-width: 900px;
            justify-content: center;
            align-items: center;
        }

        .card {
            width: 300px;
            height: 400px;
            background-color: #0a2e6d;
            border-radius: 15px;
            color: white;
            font-weight: bold;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
        .cardbild {
            position: static;
            width: 300px;
            height: 250px;
            background-image: url(bmw.png);
            background-size: 100%;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
           
        }

        .cardtext {
            width: 300px;
            height: 150px;
            border-bottom-left-radius: 15px;
            border-bottom-right-radius: 15px;
            color: white;
            font-weight: bold;
            padding: 15px;
        }
        .card p {
            margin: 2px 0;
        }

        
    </style>
</head>
<body class="produktübersicht-body">
<header>
<?php include 'P.RideReadyHeader.php'; ?>
</header>

    <!-- Wrapper für den Hauptinhalt -->
    <div class="produktübersicht-content">
        <div class="produktübersicht-container">
            <?php
                $cardCount = 10;
        
                for ($i = 0; $i < $cardCount; $i++) {
                    include 'teaser.php';
                    global $x;
                }
            ?>
        </div>
    </div>

    <!-- Unabhängiger Footer -->
    
    <?php include 'P.RideReadyFooter.php'; ?>
    

</body>
</html>
