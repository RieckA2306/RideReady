<?php
// connection to the database
include "dbConfigJosef.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $_SESSION["password"] = $password;//muss raus
    $password_hash=password_hash($password,PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO user_account ( Lastname,Firstname, username, email_adress, Password) 
    VALUES (:Lastname,:Firstname, :username,:email_adress, :password_hash)");

    $stmt->bindParam(":Lastname", $lastname, PDO::PARAM_STR);
    $stmt->bindParam(":Firstname", $firstname, PDO::PARAM_STR);
    $stmt->bindParam(":username", $username, PDO::PARAM_STR);
    $stmt->bindParam(":email_adress", $email, PDO::PARAM_STR);
    $stmt->bindParam(":password_hash", $password_hash, PDO::PARAM_STR);
    $stmt->execute();

    header('Location:UserControl.php');
    $_SESSION['username']=$username;
    exit();
}

?>