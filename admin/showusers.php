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
$users;

function getUsers()
{

    $db = new Database("127.0.0.1", "root", "123456", "cafedb");
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
        echo "<td> <a href=\"edituser.php?id=".$user['user_id']."\"><button class='button updatebtn'> Update </button></a>";
        echo "<a href=\"deleteuser.php?id=".$user['user_id']."\"><button class='button deletebtn'> Delete  </button></a> </td>"; 
    
        echo '</tr>';
    }
    
   
    echo '</table>';
    
}


?>

<!DOCTYPE Html>
<html>

<?php  include("../header.php");?>

<div class="main">
    <section>
        <h1 class="pageTitle"> All Users </h1>
        <a href="adduser.php"><button class="addLink">add user ?</button> </a>
        <br>
    </section>
    
    <section class="content" >
     <?php  getUsers(); ?> 

    </section>
    </div>
    <!-- If something went wrong-->
    <h2>
    <?php
        if(isset($_GET['error']) && $_GET['error'] == 1){
            echo "Something went wrong";
        }
    ?>
    </h2>

</body>
</html>




