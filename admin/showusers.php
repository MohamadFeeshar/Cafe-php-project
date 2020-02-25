<?php
include '../login/login.php' ; // Includes Login Script

if(isset($_SESSION['login_user'])){
    if($_SESSION['user_type']=='user'){
      header("location: ../login");     
    } 
}
else {
  header("location: ../login");
}
require_once('../databaseFunction/DatabaseFunctions.php');
$users;

function getUsers()
{

    require '../configrationfile.php';
    $db = new Database("127.0.0.1", $DBUserName,$DBPassword, "cafedb");
    $GLOBALS[$users] = $db->getAllUsers();
    renderUsers($GLOBALS[$users]);
}

function renderUsers($users)
{
    echo '<table id="data" >
        <tr>
            <th>Name</th>
            <th>Room</th>
            <th>Image</th>
            <th>Ext.</th>
            <th>Action</th>
        </tr>';


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
    
   
    echo '</table>';    





}


?>

<!DOCTYPE Html>
<html>

<?php  include "../adminHeader.php";?>

<div class="main">
    <section>
        <h1 class="pageTitle"> All Users </h1>
        <button class="addLink">add user ?</button>  
        <br>
    </section>
    
    <section class="content" >
     <?php  getUsers(); ?> 

    </section>
    </div>

</body>
</html>




