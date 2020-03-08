<?php

include('../login/login.php'); // Includes Login Script
// include('orders.php');
if(isset($_SESSION['login_user'])){
    if($_SESSION['user_type']=='admin'){
      header("location: ../login");     
    } 
}
else {
  header("location: ../login");
}

require_once('../databaseFunction/DatabaseFunctions.php');


if(isset($_POST["expandUserOrder"])) {
    require '../configrationfile.php';
    $db = new Database("localhost", $DBUserName, $DBPassword, "cafedb");
    $usersWthTotal = $db->getOrdersOfUser($_POST["dateFrom"], $_POST["dateTo"], $_POST["user_id"]);
    echo json_encode(['code'=>200, 'orders'=> $usersWthTotal]);

  }
  if(isset($_POST["expandedOrder"])){
    
    require '../configrationfile.php';
    $db = new Database("localhost", $DBUserName, $DBPassword, "cafedb");
    $ordersDetails = $db->getProductsOfOrder($_POST["order_id"]);
    
    echo json_encode(['code'=>200, 'ordersdetails'=> $ordersDetails]);
}
?>