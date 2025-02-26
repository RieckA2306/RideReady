<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport">
</head>
<style>
</style>
<body>
    <div class="card">
        <div class="cardbild">
            <img src="Images/Cars/<?php echo $_SESSION['Img_File_Name']; ?>" alt="Car Image">
        </div>
        <div class="cardtext">
            <p style="font-size: 24px;"> 
                <?php echo $_SESSION['Vendor_Name']; ?> <?php echo $_SESSION['carname']; ?>
            </p>
            <p style="font-size: 20px;">
                <?php echo $_SESSION['Name_Extension']; ?>
            </p>
            <p style="padding:20px; text-align: right; font-size: 40px;">
                <?php echo $_SESSION['carprice'] . "€"; ?>
            </p>
        </div>
    </div> 
</body>
