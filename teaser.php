<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport">
</head>
<style>
</style>
<body>
<a href="Produktdetail.php?id=<?php echo urlencode($_SESSION['type_id']); ?>">
    <div class="card">
        <div class="cardbild">
            <img src="Images/Cars/<?php echo htmlspecialchars($_SESSION['Img_File_Name']); ?>" alt="Car Image">
        </div>
        <div class="cardtext">
            <p style="font-size: 23px;"> 
                <?php echo htmlspecialchars($_SESSION['Vendor_Name'] . ' ' . $_SESSION['carname']); ?>
            </p>
            <p style="font-size: 20px;">
                <?php echo htmlspecialchars($_SESSION['Name_Extension']); ?>
            </p>
            <p style="padding:20px; text-align: right; font-size: 40px;">
                <?php echo htmlspecialchars($_SESSION['carprice']) . "€"; ?>
            </p>
        </div>
    </div> 
</a>

</body>
