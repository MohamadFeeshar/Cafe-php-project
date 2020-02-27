<?php
//include DB Class

include '../login/login.php'; // Includes Login Script
include "adminHeader.php";
require_once '../databaseFunction/DatabaseFunctions.php';
$db = new Database("127.0.0.1", $DBUserName, $DBPassword, "cafedb");

$retreiveallorders = $db->getAllOrders();
var_dump(end($retreiveallorders));
// $getUserId = $db->getAllUsers();
echo '<table>
            <tr>
            <th> Date </th>
            <th> Name </th>
            <th> Room </th>
            <th> Ext  </th>
            <th> Total price </th>

        </tr>';

// var_dump($_SESSION['user_id']);
foreach ($retreiveallorders as $userOrder) {
    if ($_SESSION['user_id'] == $userOrder['user_id']) {
// var_dump($userOrder['user_id']);
        echo '<tr>';
        echo '<td>' . $userOrder['order_date'] . '</td>';
        echo '<td>' . $userOrder['user_name'] . '</td>';
        echo '<td>' . $userOrder['room'] . '</td>';
        echo '<td>' . $userOrder['ext'] . '</td>';
        echo '<td>' . $userOrder['amount'] . '</td>';
        echo '</tr>';
    }
}

echo '</table>';
