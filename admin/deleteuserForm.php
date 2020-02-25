<?php
require '../databaseFunction/DatabaseFunctions.php';
include('../login/login.php'); // Includes Login Script
if(isset($_SESSION['login_user'])){
    if($_SESSION['user_type']=='user'){
      echo $_SESSION['user_type'];
      header("location: ../login/");     
    } 
}
else {
   header("location: ../login/");
}
$db = new Database("127.0.0.1", "phpmyadmin", "phpmyadmin", "cafedb");
$user = $db->deleteUser($_POST['userId']);
if($user)
{
    header("Location: ./showusers.php");
}
else{
    header("Location: ./showusers.php?error=1");
}
?>