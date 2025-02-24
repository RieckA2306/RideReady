<?php
// connection to the database
include "dbConfig.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $_SESSION["password"] = $password;//muss raus
    $password_hash=password_hash($password,PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO benutzer (username, passwort_hash) VALUES (?, ?)");
// request as a String 
$stmt->bind_param("ss", $username, $password_hash);
$stmt->execute();

$_SESSION["eingeloggt"] = true;
$_SESSION["username"] = $username;
header("Location: P.RideReady.Landingpage.php");
exit();
}
