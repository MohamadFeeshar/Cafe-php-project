<?php
require_once('../databaseFunction/DatabaseFunctions.php');

if(isset($_POST["selectUser"]))
{
    selectUser($_POST["user_id"]);
}
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

function selectUser($user_id)
{
    require '../configrationfile.php';
    $db = new Database("localhost", $DBUserName, $DBPassword, "cafedb");
    $usersWthTotal = $db->getUsernameWthTotal($user_id);
    echo json_encode(['code'=>200, 'users'=> $usersWthTotal]);
}

?>