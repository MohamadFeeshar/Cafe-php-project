<?php
//include DB Class
require_once('../databaseFunction/DatabaseFunctions.php');
include("adminHeader.php");

$db = new Database("localhost", "test", "test", "cafedb");
$retreiveallorders = $db->getAllOrders();
$getUserId = $db->getAllUsers();
echo '<table>
            <tr>         
            <th> Date </th>  
            <th> Name </th>       
            <th> Room </th>           
            <th> Ext  </th>
            <th> Total price </th>
            
        </tr>';


    foreach ($retreiveallorders as $userOrder) {
        if ($retreiveallorders['user_id'] == $getUserId['user_id']) {
        echo '<tr>';
        echo '<td>'.$userOrder['order_date'].'</td>';
        echo '<td>'.$userOrder['user_name'].'</td>';
        echo '<td>'.$userOrder['room'].'</td>';
        echo '<td>'.$userOrder['ext'].'</td>';
        echo '<td>'.$userOrder['amount'].'</td>';    
        echo '</tr>';
    }
    }    
   
    echo '</table>';    
?>