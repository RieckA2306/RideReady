<!DOCTYPE html>
<html lang="de">
<head>
    <title>Login</title>
    <style>
    .login-container {
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
 
    
    .login-container input {
        margin-bottom: 10px;
        padding: 8px;
        font-size: 16px;
        background-color: #D3D3D3;
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
<body>
<?php include 'P.RideReadyHeader.php'; ?>
    <h2>Login</h2>
    <form class="login-container" action="login.php" method="POST">
        <label>username:</label>
        <input type="text" name="username" required>
        <br>
        <label>Passwort:</label>
        <input type="password" name="passwort" required>
        <br>
        <button type="submit">Login</button>
        <a href="signinsite.php">Noch Kein Konto?</a>
    </form>
    <?php include 'P.RideReadyFooter.php'; ?>
</body>
</html>
