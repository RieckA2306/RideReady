<?php
// conncetion to database 
include "dbConfigJosef.php";
session_start(); 
// 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["passwort"];

    try {
        // SQL Request of Password and UserID for the User 
        $stmt = $pdo->prepare("SELECT Account_ID, Password FROM user_account WHERE username = :username");
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->execute();
        $dbResult = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dbResult) {
            // Password check 
            if (password_verify($password, $dbResult["Password"])) {
              header('Location:UserControl.php');
            //   if correct creating session username 
              $_SESSION['username']=$username;
              exit();
            } else {
                // sktipt if password is wrong 
                echo  ('<script>
                alert("Falsches Passwort");
                window.location.href = "loginsite.php";
            </script>');
            }
        } else {
            // skript if username doesent exist 
            echo  ('<script>
            alert("Benutzer nicht gefunden");
            window.location.href = "loginsite.php";
        </script>');
        }

    } catch (PDOException) {
        echo  ('<script>
            alert("Da ist wohl etwas schief gelaufen");
            window.location.href = "loginsite.php";
        </script>');

    }
}
?>
