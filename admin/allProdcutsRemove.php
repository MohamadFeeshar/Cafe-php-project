<?php
include('../login/login.php'); // Includes Login Script

if(isset($_SESSION['login_user'])){
    if($_SESSION['user_type']=='user'){
      header("location: ../login");     
    } 
}
else {
  header("location: ../login");
}

require_once('../databaseFunction/DatabaseFunctions.php');
$db = new Database("127.0.0.1",$DBUserName,$DBPassword, "cafedb");
if(isset($_GET['pId'])){
    $result = $db->deleteProduct($_GET['pId']);
    if($result){
        header('location: ./allProducts.php?success=delete');
    }
    else{
        header('location: ./allProducts.php?error=delete');
    }
}
else{
  echo "dead";
}