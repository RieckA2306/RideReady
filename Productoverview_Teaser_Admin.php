<!-- In this Document each of the Cards are created -->
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport">
    <link rel="stylesheet" href="RideReady.css?v=1.1">
</head>
<style>
</style>
<body>
<div class="card">
    <a href="Productdetail_Admin.php?id=<?php echo urlencode($_SESSION['type_id']); ?>">
        <div class="cardimage">
            <img src="Images/Cars/<?php echo htmlspecialchars($_SESSION['Img_File_Name']); ?>" alt="Car Image">
        </div>
        <!-- The Cardtext is shown in different rows and layouts. First the Name and Vendor -->
        <div class="cardtext">
            <div class="cardtext-Vendor_Name"> 
                <?php echo htmlspecialchars($_SESSION['Vendor_Name'] . ' ' . $_SESSION['carname']); ?>
            </div>
            <!-- Then the Name extension if there is any -->
            <div class="cardtext-Name_Extension">
                <?php echo htmlspecialchars($_SESSION['Name_Extension']); ?>
            </div>
            <!-- Then the Number of Cars at Ride Ready of that Type -->
            <div class="cardtext-available">
                <?php echo "<p>Verfügbar: $availableCount</p>"; ?>
            </div>
            <!-- And at Last the Price Per Day of teh Type of Car -->
            <div class="cardtext-price">
                <?php echo number_format($_SESSION['carprice'], 2, ',', '.') . "€"; ?>
            </div>
        </div>
    </a>    
</div> 
</body>
