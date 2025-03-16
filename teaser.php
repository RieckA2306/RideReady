<!-- In this Document each of the Cards are created -->
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport">
    <link rel="stylesheet" href="P.RideReadyProductoverview.css">
</head>
<style>
    .cardtext {
        width: 300px;
        height: 150px;
        border-bottom-left-radius: 15px;
        border-bottom-right-radius: 15px;
        color: white;
        font-weight: bold;
        text-decoration: none !important; 
        padding: 5px;
    }

    .cardtext-Vendor_Name {
        font-size: 23px;
        margin: 2px 0;
    }

    .cardtext-Name_Extension {
        font-size: 20px;
        margin: 2px 0;
        height: 24px; /* Fixed height so that space is always reserved */
        display: flex;
    }

    .cardtext-available {
        font-size: 18px;
        margin: 2px 0;
    }

    .cardtext-price {
        font-size: 40px;
        text-align: right;
        padding: 10px;
        margin-top: auto; /* Pushes the price down */
    }

    .card a {
    text-decoration: none !important;
    color: inherit !important;
    display: block;
    }
</style>
<body>
<a href="Produktdetail.php? id=<?php echo urlencode($_SESSION['type_id']); ?>">
    <div class="card">
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
