<?php
require_once('../databaseFunction/DatabaseFunctions.php');

if(isset($_POST["getAllOrders"])) {

    require '../configrationfile.php';
    $db = new Database("localhost", $DBUserName, $DBPassword, "cafedb");
    $allOrders = $db->getAllOrders();
    echo json_encode(['code'=>200, 'orders'=> $allOrders]);
}

if(isset($_POST["delteOrder"])) {
    require '../configrationfile.php';
    $db = new Database("localhost", $DBUserName, $DBPassword, "cafedb");
    $result = $db->deleteOrder($_POST["order_id"]);
    echo json_encode(['code'=>200, 'result'=> $result]);
}

?>