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


<?php  include "../userHeader.php";?>

<div >
    <section>
        <h1 class="pageTitle2"> My Orders </h1>
        <br>
    </section>
    
    <section class="mainpart1">
     <label> Date From:</label> <input type="date" placeholder="Date from" id="date-from"> 
     <label>Date To:</label> <input type="date" placeholder="Date to" id="date-to">  
     
     <input type="hidden" value="<?php echo $_SESSION['user_id']?>" id="getUserId">
       
     <a href="./orders.php">
    <button  class="showbtn" style=" margin-left: 20%; width:150px" >Show All Orders ?</button>
    </a>
    <br>   <br>
    <button id="getOrders" class="showbtn" >Show</button>


     <br>   <br>
     
     </select>
    </section>

    <section style="margin-left:18%; height:200px; width: 100%;" > 
        <div class="mainpart2" >
       </div>

    </section>
  
    </div>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="displayorder.js"></script>
</body>
</html>
