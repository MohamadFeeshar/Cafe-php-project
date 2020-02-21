<?php 
require_once('../DatabaseFunctions.php');
$orders;
$title = 'Orders';
function getOrders(){
    $db = new Database('127.0.0.1', 'root', '', 'cafedb');
   $GLOBALS[$orders]=$db->getAllOrders();
   renderOrders($GLOBALS[$orders]);
}
getOrders();
// $orders = array(
//     array(
//         "date" => "2015/02/02 10:30AM",  
//         "Name" => "Abdulrahman",  
//         "Room" => "5", 
//         "Ext" => "6506",
//         "Action" => "deliver",
//         "items" => array( 
//             "tea" => "2",
//             "Nescafe" => "2", 
//             "Cola" => "1",           
//     ) 
//     ),
//     array(
//         "date" => "2015/02/02 10:30AM",  
//         "Name" => "Abdulrahman",  
//         "Room" => "5", 
//         "Ext" => "6506",
//         "Action" => "deliver",
//         "items" => array( 
//             "tea" => "2",
//             "Nescafe" => "2", 
//             "Cola" => "1",           
//          ) 
//         )
//      );

function renderOrders($orders){
    echo '<table>
            <tr>
            <th> Date </th>
            <th> Name </th>
            <th> Room </th>
            <th> Ext  </th>
            <th> Action </th>
            <th> Items  </th>
        </tr>';
    foreach ($orders as $key => $value) {     
        echo '<tr>';  
        foreach ($value as $sub_key => $sub_val) {                       
            
            if (is_array($sub_val)) {         
                    foreach ($sub_val as $k => $v) { 
                    $items.= "$k = $v ";                 
                } 
                echo '<td>' .$items. '</td>'; 
            } else {             
                echo '<td>' .$sub_val .'</td>'; 
            }      
            
        } 
        echo '</tr>';
    } 
    echo '</table></body></html>';
}



echo $html = <<< TMP
<!DOCTYPE html>
<html>
<head> 
<link rel="stylesheet" href="style.css"/>   
<title> $title </title>
</head>
<body>
<nav>
<ul>
    <li><a>Home</a></li>
    <li><a>Products</a></li>
    <li><a>Users</a></li>
    <li><a>Manual Order</a></li>
    <li><a>Checks</a></li>
</ul>
<div id="admin">
<a>Admin</a>
</div>
</nav>
TMP;

echo '<h1>' .$title .'</h1>';





