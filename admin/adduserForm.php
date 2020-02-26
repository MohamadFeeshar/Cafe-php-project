<?php
require_once '../databaseFunction/DatabaseFunctions.php';
include '../login/login.php'; // Includes Login Script
if (isset($_SESSION['login_user'])) {
    if ($_SESSION['user_type'] == 'user') {
        echo $_SESSION['user_type'];
        header("location: ../login/");
    }
} else {
    header("location: ../login/");
}
if(isset($_POST['submit'])){
    
}
else{
    header("location: ./adduser.php");
}

function validatePassword($pass, $confirm)
{
    if (strcmp($pass, $confirm) == 0) {
        return true;
    } else {
        return false;
    }
}

function validateFile()
{
    if (isset($_FILES['myfile'])) {
        $file_name = $_FILES['myfile']['name'];
        $file_type = $_FILES['myfile']['type'];
        $ext = explode('.', $_FILES['myfile']['name']);
        $file_ext = strtolower(end($ext));
        $extensions = array("jpeg", "jpg", "png");
        if (in_array($file_ext, $extensions) === false) {
            $errors .= "Extension is not allowed, please choose a JPEG or PNG image.";
        }
        if (empty($errors) == true) {
            move_uploaded_file($file_tmp, "files/" . $file_name);
            return 1;

        } else {

            echo '<script>alert("extension not allowed, please choose a JPEG or PNG file.")</script>';
            return 0;
        }
    }
}
