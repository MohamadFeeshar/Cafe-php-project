<?php
require_once('../databaseFunction/DatabaseFunctions.php');

selectUser($_POST["user_id"]);
function selectUser($user_id)
{
    require '../configrationfile.php';
    $db = new Database("127.0.0.1", $DBUserName, $DBPassword, "cafedb");
    $usersWthTotal = $db->getUsernameWthTotal($user_id);
    echo json_encode(['code'=>200, 'users'=> $usersWthTotal]);
}

if(isset($_POST['expandUserOrder']))
{
    require '../configrationfile.php';
    $db = new Database("127.0.0.1", $DBUserName, $DBPassword, "cafedb");
    $usersWthTotal = $db->getspecificOrder($_POST["date-from"], $_POST["date-to"],$user_id);
    echo json_encode(['code'=>200, 'users'=> $usersWthTotal]);
}

?>