<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php
 


    $username= $_SESSION["benutzername"];
?>
<body>
<div class="menu" id="menu">
<div class="menu" id="menu">AD</div>
    <h2><?php  echo "$username"?></h2>
    <a href="P.RideReady.MeineBuchungen.php" >Meine Buchungen</a>
    <a href="logout.php">Logout</a>
    <a href="Sessionanzeige.php">Sessionanzeigen</a>
    <button href="logout.php">Logout</button>
       </div>   
</body>
</html>


