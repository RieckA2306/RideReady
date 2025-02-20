<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Über uns – RideReady</title>
    <style>
        .static-page-body {
        display: flex;
        flex-direction: column;
        margin: auto;
        background-color: #F0F0F0;
        font-family: "Inter", serif;
        margin: 0;
        }

        .login-container {
            display: flex;
            flex-direction: column;
            width: 300px;
            margin: 0 auto;
            align-items: center; /* Center elements horizontally */
        }
        .login-container input {
            margin-bottom: 10px;
            padding: 8px;
            font-size: 16px;
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 100%; /* Ensure inputs take full width */
            box-sizing: border-box; /* Include padding and border in element's total width */
        }
        .login-container button {
            padding: 10px;
            font-size: 16px;
            background-color: #80BFFF;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%; /* Ensure button takes full width */
            box-sizing: border-box; /* Include padding and border in element's total width */
        }
        .login-container button:hover {
            background-color: #3399FF;
        }
        .login-container a {
            text-align: center;
            margin-top: 10px;
            color: #0000EE;
            text-decoration: none;
        }
        .login-container a:hover {
            text-decoration: underline;
        }
    </style>
</head>


    
<body class="static-page">
        
    <div class="login-container">
        <form method="POST" action="log.php">
            <input type="text" id="username" name="username" placeholder="Username">
            <input type="password" id="passwort" name="passwort" placeholder="Passwort">
            <button type="submit">Weiter</button>
        </form>
        <a href="#">Noch Kein Konto?</a>


    </div>

    
</body>
</html>