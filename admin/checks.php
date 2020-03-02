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
$usersWthTotal;

function getUsers()
{
    require '../configrationfile.php';
    $db = new Database("localhost", $DBUserName,$DBPassword, "cafedb");
    $GLOBALS[$users] = $db->getAllUsers();
    renderUsers($GLOBALS[$users]);
}

function renderUsers($users)
{
    echo "<option value=\"none\">"."User"."</option>";
    foreach ($users as $user) {
        if($user['user_id'] == 1) //admin -- till we modify it
            continue;
        echo "<option value=\"".$user['user_id']."\">".$user['user_name']."</option>";
    }  
}

function getUsersWthTotal()
{
    require '../configrationfile.php';
    $db = new Database("localhost", $DBUserName,$DBPassword, "cafedb");
    $GLOBALS[$usersWthTotal] = $db->getUsernameWthTotal();
    renderUsersWthTotal($GLOBALS[$usersWthTotal]);
}

function renderUsersWthTotal($usersWthTotal)
{
    echo '<table id="data" >
    <tr>
        <th>Name</th>
        <th>Total Amount</th>
    </tr>';


foreach ($usersWthTotal as $user) {
    echo '<tr>';
    echo '<td>'.$user['user_name'].'</td>';
    echo '<td>'.$user['total_amount'].'</td>';
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
        <h1 class="pageTitle"> Checks </h1>
        <br>
    </section>
    
    <section>
     Date From: <input type="date" placeholder="Date from" id="date-from">
     Date To: <input type="date" placeholder="Date to" id="date-to"> <br> <br>
     <label for="users">User: </label>
     <select id="users">
     
        <?php getUsers()?>
     </select>
    </section>

    <section class="content" >
     <?php  //getUsersWthTotal(); ?> 

    </section>
    </div>
<script src="js/checks.js"></script>
</body>
</html>