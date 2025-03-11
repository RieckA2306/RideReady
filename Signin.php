<?php
// Verbindung zur Datenbank
include "dbConfigJosef.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $firstname = trim($_POST["firstname"]);
    $lastname = trim($_POST["lastname"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    try {
        // Überprüfen, ob der Benutzername bereits existiert
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM user_account WHERE username = :username");
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->execute();
        $userExists = $stmt->fetchColumn();

        if ($userExists > 0) {
           
            echo  ('<script>
            alert("Fehler: Der Benutzername ist bereits vergeben!");
            window.location.href = "signinsite.php";
             </script>');
        } else {
            // Benutzer registrieren
            $stmt = $pdo->prepare("INSERT INTO user_account (Lastname, Firstname, username, email_adress, Password) 
                                   VALUES (:Lastname, :Firstname, :username, :email_adress, :password_hash)");
            $stmt->bindParam(":Lastname", $lastname, PDO::PARAM_STR);
            $stmt->bindParam(":Firstname", $firstname, PDO::PARAM_STR);
            $stmt->bindParam(":username", $username, PDO::PARAM_STR);
            $stmt->bindParam(":email_adress", $email, PDO::PARAM_STR);
            $stmt->bindParam(":password_hash", $password_hash, PDO::PARAM_STR);
            
            if ($stmt->execute()) {
                $_SESSION['username'] = $username;
                header('Location: UserControl.php');
                exit();
            } else {
                echo "Fehler beim Speichern des Benutzers.";
            }
        }
    } catch (PDOException $e) {
        echo "Datenbankfehler: " . $e->getMessage();
    }
}
?>
