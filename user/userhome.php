<?php 
include('../login/login.php'); // Includes Login Script

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
$rooms;
$products;


function getUsers()
{
    require '../configrationfile.php'; 
    $db = new Database("localhost",$DBUserName,$DBPassword, "cafedb");
    $GLOBALS[$users] = $db->getAllUsers();
    renderUsers($GLOBALS[$users]);
    $db->closeDBConnection();
}

function renderUsers($users)
{
    foreach ($users as $user) {
        if($_SESSION['user_id'] == $user['user_id']){
        echo "<input id=\"user\" type=\"hidden\" value=\"".$user['user_id']."\">";
        }
    }  
}

// var_dump($_SESSION['user_id']);
$retreiveallorders = $db->getAllOrders();
$last_order=end($retreiveallorders);
// $getUserId = $db->getAllUsers();
echo '<table style="border: solid">
            <tr>         
            <th> Date </th>  
            <th> Room </th>           
            <th> Ext  </th>
            <th> Total price </th>
            
        </tr>';

// var_dump($_SESSION['user_id']);
        if ($_SESSION['user_id'] == $last_order['user_id']) {
// var_dump($userOrder['user_id']);
        echo '<tr>';
        echo '<td>'.$last_order['order_date'].'</td>';
        echo '<td>'.$last_order['room'].'</td>';
        echo '<td>'.$last_order['ext'].'</td>';
        echo '<td>'.$last_order['amount'].'</td>';    
        echo '</tr>';
    }
      
   
    echo '</table>';  


function getRooms()
{
    require '../configrationfile.php'; 
    $db = new Database("localhost",$DBUserName,$DBPassword, "cafedb");
    $GLOBALS[$rooms] = $db->getAllRooms();
    renderRooms($GLOBALS[$rooms]);
    $db->closeDBConnection();
}

function renderRooms($rooms)
{
    foreach ($rooms as $room) {
        echo "<option value=\"".$room['room']."\">".$room['room']."</option>";
    }  
}

function getProducts()
{
    require '../configrationfile.php'; 
    $db = new Database("localhost",$DBUserName,$DBPassword, "cafedb");
    $GLOBALS[$products] = $db->getAllProducts();
    renderProducts($GLOBALS[$products]);
    $db->closeDBConnection();
}

function renderProducts($products)
{
    foreach ($products as $product) {
        echo "<div class=\"productHolder\" >";
        echo "<img src=\"../imag/".$product['product_img']."\">";
        echo "<div class=\"priceHolder\">";
        echo "<h3>".$product['product_name']."<h3/>";
        echo "<h3>".$product['price']."<h3/>";
        echo "<h6 style=\"display:none;\">"." ".$product["product_id"]."<h6/>";
        echo "</div>";
        echo "</div>";
    }  
}
?>


<?php include('../userHeader.php');?>
<body>
<div class="main">
    <div class="addOrderForm">
            <h3>Items</h3>
            <div class="orderedItems">
            </div>
            <br/>
            <br/>
            <h3>Notes</h3>
            <textarea name="orderNotes" id="notes"></textarea><br>
            <label for="rooms">Room:</label>
            <select name="rooms" id="rooms">
            <?php getRooms();?>
            </select>
            <br>
            <div class="total">
            </div>
            <input type="submit" value="Confirm" class="confirmOrder savebtn">
        <!-- </form> -->
    </div>
    <div class="orderOptions">
    <div class="usersCBox" style="height:10px" >
    <div name="users" id="users">
                <?php getUsers();?>
            </div>
            </div>
        <div class="products">
            <?php getProducts();?>
        </div>
    </div>
</div>
<script src="makeorder.js"></script>
</body>
</html>