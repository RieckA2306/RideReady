<!-- 
 This script will open if the logout Button is pushed on overview_login.php
 After Button is pushed, the Session will be destroyed and user is sent to Loginsite.php -->
<?php
session_start();
session_unset();
session_destroy();
header("Location: loginsite.php");
exit();
?>
