<?php
include('../login/login.php'); // Includes Login Script

if(isset($_SESSION['login_user'])){
    if($_SESSION['user_type']=='admin'){
      header("location: ../login");     
    } 
}
else {
  header("location: ../login");
}
require_once('../databaseFunction/DatabaseFunctions.php');

$itemsJSON = $_POST["items"];
$itemsArray = array();
foreach ($itemsJSON as $item) {
    $itemsArray[] = array("product_id" => $item["product_id"], "quantity" => $item["quantity"]);
}

addToUser($_POST["user_id"], $_POST["room"], $_POST["notes"], $_POST["total"], $itemsArray);

function addToUser($user_id, $room, $notes, $total, $itemsArray)
{

    require '../configrationfile.php'; 
    $db = new Database("localhost",$DBUserName,$DBPassword, "cafedb");
    date_default_timezone_set("Africa/Cairo");
    $db->addOrder(date("Y-m-d h:i:s", time()), $room, $total, $notes, "processing", $user_id, $itemsArray);
    echo json_encode(['code'=>200]);
}

?>