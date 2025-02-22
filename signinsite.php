
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>signin</title>
    <style>
        /* .static-page {
            display: flex;
    flex-direction: column;
    margin: auto;
    background-color: #F0F0F0;
    font-family: "Inter", serif;
    margin: 0;
    }    */

            .form-container {
                background-color: white;
            margin: auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            width: 600px;
            height: 300px;
            text-align: right;
            display: flex;  
            flex-direction: column;
            align-items: center;
            color: black;
        }
        .form-container input {
            margin-bottom: 10px;
            padding: 8px;
            font-size: 16px;
            background-color:  #D3D3D3;;
            border: 1px solid #ccc;
            border-radius: 4px;
            width:100%;
        }
        .form-container button {
            padding: 10px;
            font-size: 16px;
            background-color: #80BFFF;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .form-container button:hover {
            background-color: #0056b3;
        }
    
    
    </style>
</head>

<body class="static-page">
    <?php include 'P.RideReadyHeader.php'; ?>
    <form class="form-container" action="signin.php" method="POST">
        <input type="text" id="vorname" name="firstname" placeholder="Vorname">
        <input type="text" id="nachname" name="lastname" placeholder="Nachname">
        <input type="text" id="username" name="username" placeholder="Username">
        <input type="email" id="email" name="email" placeholder="Email Adresse">
        <input type="password" id="passwort" name="password" placeholder="Passwort">
        <button type="submit">Konto erstellen</button>
    </form>
    <?php include 'P.RideReadyFooter.php'; ?>
</body>
</html>