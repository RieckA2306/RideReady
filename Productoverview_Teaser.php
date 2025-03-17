<!-- In this Document each of the Cards are created -->
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport">
    <link rel="stylesheet" href="P.RideReadyProductoverview.css?v=1.1">
</head>
<style>  
</style>
<body>

 <div class="card">
    <a href="Produktdetail.php?<?php echo urlencode($_SESSION['type_id']); ?>">
        <div class="cardimage">
            <img src="Images/Cars/<?php echo htmlspecialchars($_SESSION['Img_File_Name']); ?>" alt="Car Image">
        </div>
        <div class="cardtext">
            <div class="cardtext-Vendor_Name"> 
                <?php echo htmlspecialchars($_SESSION['Vendor_Name'] . ' ' . $_SESSION['carname']); ?>
            </div>
            <div class="cardtext-Name_Extension">
                <?php echo htmlspecialchars($_SESSION['Name_Extension']); ?>
            </div>
            <div class="cardtext-available">
                <?php echo "<p>Verfügbar: $availableCount</p>"; ?>
            </div>

            <div class="cardtext-price">
                <?php echo number_format($_SESSION['carprice'], 2, ',', '.') . "€"; ?>
            </div>

        </div>
    </a>
</div> 
</body>
