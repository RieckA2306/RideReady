<?php
include "dbConfig.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $_SESSION["password"] = $password;

}
echo "$firstname"."<br>"."$lastname"."<br>"."$username"."<br>"."$email"."<br>"."$password";
?>
