<?php
include "dbConfig.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $_SESSION["password"] = $password;//muss raus
    $password_hash=password_hash($password,PASSWORD_DEFAULT);
}


$stmt = $conn->prepare("INSERT INTO benutzer (username, passwort_hash) VALUES (?, ?)");
// Beide Parameter in einem Aufruf binden
$stmt->bind_param("ss", $username, $password_hash);
$stmt->execute();

$coded=password_hash($password,PASSWORD_DEFAULT);
echo "$firstname"."<br>"."$lastname"."<br>"."$username"."<br>"."$email"."<br>"."$password"."<br>"."$coded";
if(password_verify($password,$coded)){
    echo "true";
}
 ?>
