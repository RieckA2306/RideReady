<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <title>Document</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>

        .container {
            background-color: white;
            margin: auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            width: 1300px;
            height: auto;
            text-align: right;
            display: flex;  
             justify-content: space-between;
        }
        .pictureandprice {
        
        display: grid;
        justify-content: space-between;
        align-items: center;
        background-color: #002b5e;
        color: white;
        padding: 10px;
        border-radius: 10px;
        margin: 10px;
        margin-top: 10px;
        width: 800px;
        height: 450px;
        } 
        .picture{
        display: flex;
        flex-direction: column;
        align-items: center; 
        background-image: url(bmw.png);
        background-size: 100%;
        padding: 10px;
        border-radius: 10px;
        margin: 10px;
        margin-top: 30px;
        margin-left: 30px;
        width: 420px;
        height: 300px;}

        .price{
        flex-direction: column;
        background-color: white;
        color:#002b5e;
        padding: 10px;
        border-radius: 10px;
        margin: 10px;
        margin-left: 30px;
        width: 420px;
        height: 50px;
        text-align: left;
        }
        .price h2 {
                font-weight: bold;
                margin: 0;
            }

            .price p {
                text-align: end;
                margin: 5px ;
            }
        
        
        .detail {
        
        display: grid;
        justify-content: space-between;
        align-items: center;
        background-color: #002b5e;
        color: white;
        padding: 10px;
        border-radius: 10px;
        margin: 10px;
        width: 420px;
        height: 450px;
    }
    .CarName{
        display: flex;
        height: 50px;
        width: 80%; 
        overflow: hidden; 
        text-align: start;
        padding: 10px;
        
        }
        .detailt{
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        text-align: center;
        width: 420px;
        height: 350px;
        } 


        .feature {
            display: flex;
            flex-direction: column;
            align-items: center;
            color: white;
        }
        .feature img {
            width: 50px;
            height: 50px;
            background-color: white;
            border-radius: 50%;
            padding: 10px;
        }
        .feature p {
            margin-top: 5px;
            font-size: 14px;
        }

        
        .collapsible {
            display: flex;
        background-color: #002b5e;
        color: white;
        cursor: pointer;
        padding: 10px;
        margin: 10px;
        border-radius: 10px;
        width: 820px;
        height: 66px;
        border: none;
        text-align: left;
        outline: none;
        font-size: 15px;
}
.active, .collapsible:hover {
  background-color: #FFC107;
  color:#002b5e;
}

.content {
 
    display: none;
    overflow: hidden;
    background-color: #80BFFF;
    color: #002b5e;
    padding: 10px;
    border-radius: 10px;
    margin: 10px;
    margin-top: 3px;
    width: 800px;
    height:auto;
}
        .booking {
        display: flex;
        flex-direction: column;
        align-items: center; 
        justify-content: center; 
        gap:20%;
        background-color: #002b5e;
        padding: 10px;
        border-radius: 10px;
        margin: 10px;
        width: 420px;
        height: 200px;
        }
        .time {
        display: flex;
        width: 80%; 
        border: 1px solid #ccc; 
        border-radius: 10px; 
        overflow: hidden; 
        text-align: center;
        }

        .timebox {
        flex: 1; 
        padding: 10px;
        background-color: white;
        }
        .timebox:not(:last-child) {
             border-right: 1px solid #ccc; 
        }
        .timebox h4 {
            font-size: 12px;
            font-weight: bold;
            margin: 0;
        }

        .timebox p {
            font-size: 14px;
            margin: 5px 0 0;
        }
        .bookingbutton {
            background-color: #FFC107;
        padding: 10px;
        border-radius: 10px;
        margin: 10px;
        margin-bottom: 20px;
        width:70%;
        height: 60px;
        }

        </style>


<link rel="stylesheet" href="P.RideReady.css">
</head>

<body class="static-page-body">
    <header>
<?php 
// include 'P.RideReadyHeader.php';
 ?>
    </header>
    <?php 
     
    $priceperday=13;
    $startdate=1;
    $enddate=12;
    $days=$enddate-$startdate;
    $price=$days*$priceperday;
    ?>
<div class="container">

    <div>     
        <div class="pictureandprice">
            <div class="picture"></div>
            <div class="price">  <h2><?php echo"$priceperday"." €"?> pro Tag</h2><p><?php echo"$price"." €"?> Gesamtpreis </p>  </div>
        </div>
        <button type="button" class="collapsible">Buchungdetails</button>
        <div class="content">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        </div>
        <button type="button" class="collapsible">Open Collapsible</button>
        <div class="content">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        </div>
        <button type="button" class="collapsible">Open Collapsible</button>
        <div class="content">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        </div>

    </div>
    <div>
        <div class="detail">
        <div class="CarName">
            <h1> Mercedes AMG GT</h1>
        </div> 
        <div class="detailt">
            <div class="feature">
                <img src="icon1.png" alt="Sitzplätze">
                <p>5 Sitzplätze</p>
            </div>
            <div class="feature">
                <img src="icon2.png" alt="Türen">
                <p>4 Türen</p>
            </div>
            <div class="feature">
                <img src="icon3.png" alt="Automatik">
                <p>Automatik</p>
            </div>
            <div class="feature">
                <img src="icon4.png" alt="Benzin">
                <p>Benzin</p>
            </div>
            <div class="feature">
                <img src="icon5.png" alt="Klima">
                <p>Klima</p>
            </div>
            <div class="feature">
                <img src="icon6.png" alt="GPS">
                <p>GPS</p>
            </div>
            <div class="feature">
                <img src="icon7.png" alt="Mindestalter">
                <p>Mindestalter</p>
            </div>
            <div class="feature">
                <img src="icon8.png" alt="Koffer">
                <p>2</p>
            </div>
            <div class="feature">
                <img src="icon9.png" alt="Hamburg">
                <p>Hamburg</p>
            </div>

        </div>    
        </div>
        <div class="booking">
            <div class="time">
                <div class="timebox">  <h4>Start</h4> <p><?php echo"$startdate"?></p></div>
                <div class="timebox">  <h4>Ende</h4> <p><?php echo"$enddate"?></p></div>

            </div>
            <button class="bookingbutton">Reservieren</button>
    </div>
</div> 

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var coll = document.querySelectorAll(".collapsible");
        
        coll.forEach(function(button) {
            button.addEventListener("click", function() {
                this.classList.toggle("active");
                var content = this.nextElementSibling;
                if (content.style.display === "block") {
                    content.style.display = "none"; // Schließen
                } else {
                    content.style.display = "block"; // Öffnen
                }
            });
        });
    });
</script>

</body>
</html>

