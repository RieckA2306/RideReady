<?php
session_start();
$servername=$_SERVER['SERVER_NAME'];
$serverusername="root";
// $serverpassword="123456";
$dbname="benutzer";
$conn = new mysqli("$servername", "$serverusername", "", "$dbname");
// $conn = new PDO("mysql:host=$servername;dbname=$dbname", $serverusername,);

// $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}
?>