<?php
require_once 'Functions.php';
check_if_session_started();
// Connection to the Database
$servername = $_SERVER['SERVER_NAME'];
$username = "RideReadyAdmin";
$password = "1234";
$dbname = "ridereadydb";

// Error Message if Connection fails
try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
} catch (PDOException $e) {
    die("Datenbankverbindung fehlgeschlagen: " . $e->getMessage());
}

?>