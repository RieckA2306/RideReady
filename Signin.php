<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Über uns – RideReady</title>
    <style>
        .static-page {
            display: flex;
    flex-direction: column;
    margin: auto;
    background-color: #F0F0F0;
    font-family: "Inter", serif;
    margin: 0;
    }   

            .form-container {
            display: flex;
            flex-direction: column;
            width: 300px;
            margin: 0 auto;
        }
        .form-container input {
            margin-bottom: 10px;
            padding: 8px;
            font-size: 16px;
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            border-radius: 4px;
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
    <div class="form-container">
        <input type="text" id="vorname" name="vorname" placeholder="Vorname">

        <input type="text" id="nachname" name="nachname" placeholder="Nachname">

        <input type="text" id="username" name="username" placeholder="Username">

        <input type="email" id="email" name="email" placeholder="Email Adresse">

        <input type="password" id="passwort" name="passwort" placeholder="Passwort">

        <button type="submit">Konto erstellen</button>
    </div>
        


    <?php include 'P.RideReadyFooter.php'; ?>
</body>
</html>