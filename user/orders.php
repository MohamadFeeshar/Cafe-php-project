<?php
include '../login/login.php' ; // Includes Login Script

if(isset($_SESSION['login_user'])){
    if($_SESSION['user_type']=='admin'){
      header("location: ../login");     
    } 
}
else {
  header("location: ../login");
}
require_once('../databaseFunction/DatabaseFunctions.php');

$users;
$usersWthTotal;

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

<?php  include "../userHeader.php";?>

<div class="main">
    <section>
        <h1 class="pageTitle"> My Orders </h1>
        <br>
    </section>
    
    <section>
     Date From: <input type="date" placeholder="Date from" id="date-from">
     Date To: <input type="date" placeholder="Date to" id="date-to"> <br> <br>
     
     <input type="hidden" value="<?php echo $_SESSION['user_id']?>" id="getUserId">
       
     <div>
        <button id="getOrders" style="background-color:yellow; width:150px;">Show</button>
     </div>
     </select>
    </section>

    <section class="content"> 

    </section>
    <section id="details"> 

    </section>
    </div>
<script src="displayorder.js"></script>
</body>
</html>
