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
$result = 0;
$db = new Database("127.0.0.1", "phpmyadmin", "phpmyadmin", "cafedb");
if (isset($_POST['submit'])) {
    if (isset($_POST['password'])) {
        if (isset($_FILES['profilePic']) && !empty($_FILES['profilePic']['name']) && validateFile() == 1) {
            if (!validatePassword($_POST['password'], $_POST['confirmpassword'])) {
                header("location: ./edituser.php?id=" . $_POST['userId'] . "&error=1");
            } else {
                $result = $db->updateUserwithPasswordWithPic($_POST['userId'], $_POST['username'], $_POST['email'], $_POST['password'], $_POST['room'], $_POST['ext'], $_POST['profilePic']);
                header("location: ./showusers.php?suc=1");
            }
        } else if (isset($_FILES['profilePic']) && validateFile() == 0) {
            header("location: ./edituser.php?id=" . $_POST['userId'] . "&error=2");
        } else {
            $result = $db->updateUserWithPassword($_POST['userId'], $_POST['username'], $_POST['email'], $_POST['password'], $_POST['room'], $_POST['ext']);
            header("location: ./showusers.php?suc=2");
        }

    } else if (isset($_FILES['profilePic']) && validateFile() == 1) {
        $result = $db->updateUserWithPic($_POST['userId'], $_POST['username'], $_POST['email'], $_POST['room'], $_POST['ext'], $_POST['profilePic']);
        header("location: ./showusers.php?suc=3");
    } else if (isset($_FILES['profilePic']) && validateFile() == 0) {
        header("location: ./edituser.php?id=" . $_POST['userId'] . "&error=2");
    } else {
        $result = $db->updateUser($_POST['userId'], $_POST['username'], $_POST['email'], $_POST['room'], $_POST['ext']);
        header("location: ./showusers.php?suc=4");
    }
    if ($result) {
        $db->closeDBConnection();
        header("location: ./showusers.php?success=1");
    }
    else{
        
    }
} else {
    header("location: ./showusers.php");
}
$db->closeDBConnection();

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
    if (isset($_FILES['profilePic'])) {
        $errors = "";
        $file_name = $_FILES['profilePic']['name'];
        if ($file_name) {
            $file_type = $_FILES['profilePic']['type'];
            $ext = explode('.', $_FILES['profilePic']['name']);
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
        } else {
            return 2;
        }
    }
}
