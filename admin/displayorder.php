<?php 
include('../login/login.php'); // Includes Login Script

if(isset($_SESSION['login_user'])){
    if($_SESSION['user_type']=='user'){
      header("location: ../login");     
    } 
}
else {
  header("location: ../login");
}
require_once('../databaseFunction/DatabaseFunctions.php');
$orders;
$title = 'Orders';
function getOrders(){
    $db = new Database("127.0.0.1",  $DBUserName,$DBPassword, "cafedb");
    $GLOBALS[$orders]=$db->getAllOrders();       
    renderOrders($GLOBALS[$orders]);
}
getOrders();


function renderOrders($orders){
    echo '<table>
            <tr>         
            <th> Date </th>  
            <th> Name </th>       
            <th> Room </th>           
            <th> Ext  </th>
            <th> Total price </th>
            
        </tr>';
    foreach ($orders as $key => $value) {     
        echo '<tr>';  
        foreach ($value as $sub_key => $sub_val) {                     
            if($sub_key=="order_id")continue;
            if (is_array($sub_val)) {         
                    foreach ($sub_val as $k => $v) { 
                        if (is_array($v)) {                              
                            
                            foreach ($v as $k => $v) { 
                                
                                 if($k=="price")$items.= "price=";
                                 elseif($k=="quantity")$items.= "quantity=";                                 
                                  $items.= " $v ";   
                                
                            }
                            
                        }              
                } 
                echo '<tr > <td colspan=5 rowspan=1>' .$items. '</td></tr>'; 
                $items="";
                // echo '<td>' .$items. '</td>'; 
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





