<html>
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
            cursor: pointer;
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
    <body>
     <!-- <a href="Produktdetail.php"> -->
<div class="card" href="Produktdetail.php">
    <div class="cardbild" onclick="<?php $_SESSION['cardcount']=$count ?>"></div>
        <div class="cardtext">
                <p style=" font-size: 30px;"> <?php  echo $_SESSION['Vendor_Name'] ?></p>
                <p style=" font-size: 30px;"> <?php  echo $_SESSION['carname'] ?></p>
                <p style=" font-size: 15px;"> <?php  echo $_SESSION['count']=$count ?></p>
                <p style="padding:20px;text-align: right; font-size: 40px;"> <?php  echo $_SESSION['carprice']."€" ?></p>


    </div>  

</div>  

    </body>
</html>