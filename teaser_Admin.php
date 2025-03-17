<!-- In this Document each of the Cards are created -->
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport">
    <link rel="stylesheet" href="P.RideReadyProductoverview.css">
</head>
<style>
</style>
<body>
<a href="Produktdetail_Admin.php?id=<?php echo urlencode($_SESSION['type_id']); ?>">
    <div class="card">
        <div class="cardimage">
            <img src="Images/Cars/<?php echo htmlspecialchars($_SESSION['Img_File_Name']); ?>" alt="Car Image">
        </div>
        <!-- The Cardtext is shown in different rows and layouts. First the Name and Vendor -->
        <div class="cardtext">
            <p style="font-size: 23px;"> 
                <?php echo htmlspecialchars($_SESSION['Vendor_Name'] . ' ' . $_SESSION['carname']); ?>
            </p>
            <p style="font-size: 20px;">
            <?php
            // If the car has a name extension, it is shown, otherwise there will be a blank row. 
                If($_SESSION['Name_Extension']==''){
                    echo "<br>";
                }
                else{echo htmlspecialchars($_SESSION['Name_Extension']); 
                }
                ?>
                </p>
            <p style="font-size: 20px;">
                <!-- Now it will show how many cars Ride Ready owns and are in the system of the type-->
                <?php echo "<p>Verfügbar: $availableCount</p>"; ?>
            </p>

            <p style="padding: 15px; text-align: right; font-size: 40px;">
                <!-- And Last the Price per Day is shown aswell -->
                <?php echo number_format($_SESSION['carprice'], 2, ',', '.') . "€"; ?>
            </p>

        </div>
    </div> 
</a>
</body>
