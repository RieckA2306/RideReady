<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php
 


    $username= $_SESSION["username"];
?>
<body>
<div class="menu" id="menu">
<div class="menu" id="menu">AD</div>
    <h2><?php  echo "Willkommen "."$username"?></h2>
    <a href="MyBookings.php" >Meine Buchungen</a>
    <a href="Sessionanzeige.php">Sessionanzeigen</a>
    <a href="AboutUs.php">Über Uns</a>
    <a href="Cookieguidelines.php">Cookierichtlinien</a>
    <a href="AGBs.php">AGBs</a>
    <a href="logout.php"><button>Logout</button></a>
       </div>   
</body>
</html>


