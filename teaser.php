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
        <div class="cardbild" >
        </div>
        <div class="cardtext">
            <p style=" font-size: 25px;"> <?php  echo $_SESSION['Vendor_Name'] ?> <?php  echo $_SESSION['carname'] ?></p>
            <p style=" font-size: 20px;"> <?php  echo $_SESSION['carname'] ?></p>
            <p style="padding:20px;text-align: right; font-size: 40px;"> <?php  echo $_SESSION['carprice']."€" ?></p>
        </div>

    </div>  
</body>
