<?php
require_once '../databaseFunction/DatabaseFunctions.php';
if (isset($_POST['submit'])) {
    $db = new Database("127.0.0.1", "phpmyadmin", "phpmyadmin", "cafedb");
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm = $_POST['confirmpassword'];
    if(!isset($_POST['email'])){
        header("location: ./resetpassword.php?error=1");
    }
    if(isset($_POST['password']) && isset($_POST['confirmpassword']) && validatePassword($password, $confirm)){
        $result = $db->resetPassword($_POST['email'], $_POST['password']);
        var_dump($result);
        if($result){
            header("location: ./index.php");
        }
        else{
            header("location: ./resetpassword.php?error=3");
        }
    }
    else{
        header("location: ./resetpassword.php?error=2");
    }
} else {
    header("location: ./resetpassword.php");
}

function validatePassword($pass, $confirm)
{
    if (strcmp($pass, $confirm) == 0) {
        return true;
    } else {
        return false;
    }
}
