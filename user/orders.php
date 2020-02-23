<?php
//include DB Class
require_once('../DatabaseFunctions.php');
include("header.php");
$order;

function getproducts()
{
    $db = new Database("localhost", "root", "", "cafedb");
    $GLOBALS['order'] = $db->getAllProducts();
    var_dump($GLOBALS['order']);
}

getproducts();
?>