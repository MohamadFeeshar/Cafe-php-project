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
require_once '../databaseFunction/DatabaseFunctions.php';
$db = new Database("127.0.0.1", $DBUserName, $DBPassword, "cafedb");
$result=false;
if (isset($_FILES['profilePic']) && !empty($_FILES['profilePic']['name']) && validateFile() == 1) {
    if (validatePassword($_POST['password'], $_POST['confirmpassword'])) {
        $result = $db->addUserWithPic($_POST['username'], $_POST['email'], $_POST['password'], $_POST['room'], $_POST['ext'], $_FILES['profilePic']['name']);
    } else {
        $db->closeDBConnection();
        header("location: ./adduser.php?error=password");
    }

} else {
    if (validatePassword($_POST['password'], $_POST['confirmpassword'])) {
        $result = $db->addUser($_POST['username'], $_POST['email'], $_POST['password'], $_POST['room'], $_POST['ext']);
    } else {
        $db->closeDBConnection();
        header("location: ./adduser.php?error=password");
    }

}
if($result){
    header("location: ./showusers.php?success");
    $db->closeDBConnection();
} else{
    header("location: ./adduser.php?error=duplicate");
}

function validatePassword($pass, $confirm)
{
    if (strcmp($pass, $confirm) == 0) {
        return true;
    } else {
        return false;
    }
}

function validateFile(){    
    if(isset($_FILES['profilePic'])){
       $file_name = $_FILES['profilePic']['name'];
       $file_type=$_FILES['profilePic']['type'];
       $ext=explode('.',$_FILES['profilePic']['name']);
       $file_ext=strtolower(end($ext));     
       $extensions= array("jpeg","jpg","png");   
       if(in_array($file_ext,$extensions)=== false){
           $errors.="Extension is not allowed, please choose a JPEG or PNG image.";
       }      
       if(empty($errors)==true){
        
        if (move_uploaded_file($_FILES['profilePic']['tmp_name'],dirname(__DIR__, 1)."/imag/".basename($_FILES['profilePic']['name']))) {
          echo "Uploaded";
      } else {
         echo "File was not uploaded";
      }
          
           return 1;
        
       }else{
        
         echo '<script>alert("extension not allowed, please choose a JPEG or PNG file.")</script>';
        return 0;
          //  print_r($errors);
       }
   }
}
