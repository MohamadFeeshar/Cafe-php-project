
<?php
require_once('../databaseFunction/DatabaseFunctions.php');
$db = new Database('127.0.0.1', 'root', '123456', 'cafedb');
session_start(); // Starting Session
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
if (empty($_POST['username']) || empty($_POST['password'])) {
$error = "Username or Password is invalid";
}
else
{

// Define $username and $password
$username=$_POST['username'];
$password=$_POST['password'];

// To protect MySQL injection for Security purpose
$username = stripslashes($username);
$password = stripslashes($password);

// SQL query to fetch information of registerd users and finds user match.
$res=$db->login($username,$password);

if(count($res)>0){
    $_SESSION['login_user']=$username; // Initializing Session
    $_SESSION['user_type']=$res[0]['user_type'];
    echo $_SESSION['user_type'];
        //  header("location: profile.php"); // Redirecting To Other Page
}
else {
$error = "Username or Password is invalid";
}
$db->closeDBConnection(); // Closing Connection
}
}
?>
