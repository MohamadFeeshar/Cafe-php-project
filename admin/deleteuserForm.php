<?php
include('../login/login.php'); // Includes Login Script
if (isset($_SESSION['login_user'])) {
    if ($_SESSION['user_type'] == 'user') {
        header("location: ../login/");
    }
} else {
    header("location: ../login/");
}


if (isset($_POST['submit'])) {

    require_once('../databaseFunction/DatabaseFunctions.php');
    $db = new Database("127.0.0.1",$DBUserName,$DBPassword, "cafedb");
    $user = $db->deleteUser($_POST['userId']);
    if ($user) {
        header("Location: ./showusers.php");
    } else {
        header("Location: ./showusers.php?error=1");
    }
}
else{
    header("location: ../home.php");
}
?>
