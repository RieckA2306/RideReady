<!-- This script will open if someone pushes the button "Registrieren" on Signinsite.php -->
<?php
// connection to Database 
include "dbConfig.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $firstname = trim($_POST["firstname"]);
    $lastname = trim($_POST["lastname"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    try {
        // checks if user name already exists 
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
            //Inserting Userdata into Databse 
            $stmt = $pdo->prepare("INSERT INTO user_account (Lastname, Firstname, username, email_adress, Password) 
                                   VALUES (:Lastname, :Firstname, :username, :email_adress, :password_hash)");
            $stmt->bindParam(":Lastname", $lastname, PDO::PARAM_STR);
            $stmt->bindParam(":Firstname", $firstname, PDO::PARAM_STR);
            $stmt->bindParam(":username", $username, PDO::PARAM_STR);
            $stmt->bindParam(":email_adress", $email, PDO::PARAM_STR);
            $stmt->bindParam(":password_hash", $password_hash, PDO::PARAM_STR);
            

            if ($stmt->execute()) {
                // if executed creating session username 
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
