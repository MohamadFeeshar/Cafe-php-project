<?php

require_once('../DatabaseFunctions.php');
$users;

function getUsers()
{
    $db = new Database("127.0.0.1", "root", "", "cafedb");
    $GLOBALS[$users] = $db->getAllUsers();
    renderUsers($GLOBALS[$users]);
}

function renderUsers($users)
{
    echo '<table>
    <thead>
        <tr>
            <th colspan="5">All Users</th>
        </tr>
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
        echo "<td> <a class=\"edit\" href=\"editUser.php?id=".$user['user_id']."\">Edit</a> &emsp;";
        echo "<a class=\"delete\" href=\"deleteUser.php?id=".$user['user_id']."\">Delete</a> </td>";
        echo '</tr>';
    }
    
    echo '</tbody>
    </table>';    



}

getUsers();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>All Users</title>
    <link rel="stylesheet" href="styleUsersTable.css">
</head>

<body>

</body>

</html>