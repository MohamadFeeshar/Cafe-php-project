<?php  include("../configrationfile.php");?>

<?php
require_once('../databaseFunction/DatabaseFunctions.php');
$db = new Database('localhost', $DBUserName, $DBPassword, 'cafedb');
session_start(); // Starting Session
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
if (empty($_POST['email']) || empty($_POST['password'])) {
$error = "Email or Password is invalid";
}
else
{

// Define $email and $password
$email=$_POST['email'];
$password=$_POST['password'];

// To protect MySQL injection for Security purpose
$email = stripslashes($email);
$password = stripslashes($password);

// SQL query to fetch information of registerd users and finds user match.
$res=$db->login($email,$password);

if(count($res)>0){
    $_SESSION['login_user']=$email; // Initializing Session
    $_SESSION['user_type']=$res[0]['user_type'];
    $_SESSION['user_id']=$res[0]['user_id'];
    if($_SESSION['user_type']=="user"){
        header("location: ../user/userhome.php");
    }
    else  header("location: ../admin/home.php");
}    
else {
$error = "Email or Password is invalid";
}
$db->closeDBConnection(); // Closing Connection
}
}
?>
