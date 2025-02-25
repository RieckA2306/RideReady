<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$servername = $_SERVER['SERVER_NAME'];
$username = "RideReadyAdmin";
$password = "1234";
$dbname = "ridereadydb";


try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
} catch (PDOException $e) {
    die("Datenbankverbindung fehlgeschlagen: " . $e->getMessage());
}

?>