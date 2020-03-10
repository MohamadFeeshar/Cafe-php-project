<?php

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
require_once '../databaseFunction/DatabaseFunctions.php';
$dbs = new Database("localhost", $DBUserName, $DBPassword, "cafedb");
if (isset($_POST['username'])) {
    if (isset($_POST['password']) && !empty($_POST['password'])) {
        if (isset($_FILES['profilePic']) && !empty($_FILES['profilePic']['name']) && validateFile() == 1) {
            if (!validatePassword($_POST['password'], $_POST['confirmpassword'])) {
                header("location: ./edituser.php?id=" . $_POST['userId'] . "&error=1");
            } else {
                $result = $dbs->updateUserwithPasswordWithPic($_POST['userId'], $_POST['username'], $_POST['email'], $_POST['password'], $_POST['room'], $_POST['ext'], $_FILES['profilePic']['name']);
                $dbs->closeDBConnection();
                header("location: ./showusers.php?suc=1");
            }
        } else if (isset($_FILES['profilePic']) && validateFile() == 0) {
            $dbs->closeDBConnection();
            header("location: ./edituser.php?id=" . $_POST['userId'] . "&error=2");
        } else {
            $result = $dbs->updateUserWithPassword($_POST['userId'], $_POST['username'], $_POST['email'], $_POST['password'], $_POST['room'], $_POST['ext']);
            $dbs->closeDBConnection();
            header("location: ./showusers.php?suc=2");
        }

    } else if (isset($_FILES['profilePic']) && validateFile() == 1) {
        $result = $dbs->updateUserWithPic($_POST['userId'], $_POST['username'], $_POST['email'], $_POST['room'], $_POST['ext'], $_FILES['profilePic']['name']);
        $dbs->closeDBConnection();
        header("location: ./showusers.php?suc=3");
    } else if (isset($_FILES['profilePic']) && validateFile() == 0) {
        $dbs->closeDBConnection();
        header("location: ./edituser.php?id=" . $_POST['userId'] . "&error=3");
    } else {
        $result = $dbs->updateUser($_POST['userId'], $_POST['username'], $_POST['email'], $_POST['room'], $_POST['ext']);
        $dbs->closeDBConnection();
        header("location: ./showusers.php?suc=4");
    }
    if ($result) {
        $dbs->closeDBConnection();
        header("location: ./showusers.php?success=1");
    } else {
        $dbs->closeDBConnection();
        header("location: ./showusers.php?error=4");
    }
} else {
    $dbs->closeDBConnection();
    var_dump($_POST);
}
$dbs->closeDBConnection();

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
        $file_name = $_FILES['profilePic']['name'];
        $file_type = $_FILES['profilePic']['type'];
        $ext = explode('.', $_FILES['profilePic']['name']);
        $file_ext = strtolower(end($ext));
        $extensions = array("jpeg", "jpg", "png");
        if (in_array($file_ext, $extensions) === false) {
            $errors .= "Extension is not allowed, please choose a JPEG or PNG image.";
        }
        if (empty($errors) == true) {

            if (move_uploaded_file($_FILES['profilePic']['tmp_name'], dirname(__DIR__, 1) . "/imag/" . basename($_FILES['profilePic']['name']))) {
                echo "Uploaded";
            } else {
                echo "File was not uploaded";
            }

            return 1;

        } else {

            echo '<script>alert("extension not allowed, please choose a JPEG or PNG file.")</script>';
            return 0;
            //  print_r($errors);
        }
    }
}
