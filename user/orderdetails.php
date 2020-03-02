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
require '../configrationfile.php'; 
$db = new Database("localhost",$DBUserName,$DBPassword, "cafedb");
if(isset($_GET['order_id'])){
 

    $order_id = $_GET['order_id'];
    $orderDetails = $db->getProductsOfOrder(37);
    print_r($orderDetails);
//     foreach ($orderDetails as $value) {
//         # code...
//         echo $value;
//     }
//     if($orderDetails){
//       echo json_encode(['code'=>200, 'message'=> 'retreived order successfully']);

//     }
//   else{
//     echo json_encode(['code'=>500, 'message'=> 'failed to retreive order']);
//   }
// }
}