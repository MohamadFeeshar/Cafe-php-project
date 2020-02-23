<?php

require_once('../databaseFunction/DatabaseFunctions.php');
$users;

function getUsers()
{
    $db = new Database("127.0.0.1", "test", "test", "cafedb");
    $GLOBALS[$users] = $db->getAllUsers();
    renderUsers($GLOBALS[$users]);
}

function renderUsers($users)
{
    echo '<table id="data">
    <thead>
        <tr>
            <th>Name</th>
            <th>Room</th>
            <th>Image</th>
            <th>Ext.</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody id="contact_table_body">
        <!-- <tr>
            
        </tr> -->';


    foreach ($users as $user) {
        echo '<tr>';
        echo '<td>'.$user['user_name'].'</td>';
        echo '<td>'.$user['room'].'</td>';
        echo "<td> <img src= \"".$user['profile_pic']."\"/> </td>";
        echo '<td>'.$user['ext'].'</td>';
        //echo "<td> <a class=\"edit\" href=\"editUser.php?id=".$user['user_id']."\">Edit</a> &emsp;";
        //echo "<a class=\"delete\" href=\"deleteUser.php?id=".$user['user_id']."\">Delete</a> </td>";
        echo "<td> <button class='button updatebtn'> Update </button>";
        echo "<button class='button deletebtn'> Delete  </button> </td>"; 
    
        echo '</tr>';
    }
    
    echo '</tbody>
    </table>';    





}


?>

<!DOCTYPE Html>
<html>

<?php  include("../header.php");?>

<section>
    <h1 style="margin-left:2%;margin-bottom:0;margin-top:1%;font-size: 3em;color:#ffffcc;"> All Users </h1>
    <button class="addLink">add user ?</button>  
    <br>
    </div>
</section>



<section>
<div class="contentDisPlayall">
    
 <?php  getUsers(); ?> 





    <table id="tableImage">

    <tr><td colspan="2"><img src="../imag/users.jpeg" alt="pepsi" height="85%" width="80%" style="border: 2px solid #ddd;"></td> </tr>
   
    </table>
    </div>
</section>

















<?php include("../footer.php");?>

<?php
$currentPage="userPage";
echo '<style type="text/css">
   #userPage{
    background-color:#6f8c76;
    color:white
   }
   </style>';
?> 

