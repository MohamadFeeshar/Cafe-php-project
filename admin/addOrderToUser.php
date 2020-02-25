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
$rooms;
$products;

function getUsers()
{
    $db = new Database("127.0.0.1", "test", "test", "cafedb");
    $GLOBALS[$users] = $db->getAllUsers();
    renderUsers($GLOBALS[$users]);
    $db->closeDBConnection();
}

function renderUsers($users)
{
    foreach ($users as $user) {
        if($user['user_id'] == 1) //admin -- till we modify it
        continue;
        echo "<option value=\"".$user['user_id']."\">".$user['user_name']."</option>";
    }  
}

function getRooms()
{
    $db = new Database("127.0.0.1", "test", "", "cafedb");
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
    $db = new Database("127.0.0.1", "test", "test", "cafedb");
    $GLOBALS[$products] = $db->getAllProducts();
    renderProducts($GLOBALS[$products]);
    $db->closeDBConnection();
}

function renderProducts($products)
{
    foreach ($products as $product) {
        echo "<div class=\"productHolder\" >";
        echo "<img src=\"".$product['product_img']."\">";
        echo "<div class=\"priceHolder\">";
        echo "<h3>".$product['product_name']."<h3/>";
        echo "<h3>".$product['price']."<h3/>";
        echo "<h6 style=\"display:none;\">"." ".$product["product_id"]."<h6/>";
        echo "</div>";
        echo "</div>";
    }  
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Order</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="styleAddOrderToUser.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
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

<div class="main">
    <div class="addOrderForm">
        <!-- <form action="insertOrder.php" method="post"> -->
            <h3>Items</h3>
            <div class="orderedItems">
                <!-- <div class="itemHolder">
                    <h2 class="itemName">Coffee</h2>
                    <h2 class="itemName ">5</h2>
                    <button type="button">+</button>
                    <h2 class="itemQuantity">1</h2>
                    <button type="button">-</button>
                    <button type="button">X</button>
                </div> -->
            </div>
            <h3>Notes</h3>
            <textarea name="orderNotes" id="notes"></textarea><br>
            <label for="rooms">Room:</label>
            <select name="rooms" id="rooms">
            <?php getRooms();?>
            </select>
            <br>
            <div class="separator"></div>
            <div class="total">
            </div>
            <input type="submit" value="Confirm" class="confirmOrder">
        <!-- </form> -->
    </div>
    <div class="orderOptions">
        <div class="usersCBox">
            <label for="users">Add to User:</label><br>
            <select name="users" id="users">
                <?php getUsers();?>
            </select>
        </div>
        <div class="separator"></div>
        <div class="products">
            <?php getProducts();?>
            <!-- <div class="productHolder">
                <img src="" alt="">
                <div class="priceHolder"></div>
            </div> -->
        </div>
    </div>
</div>
<script src="js/addOrderToUser.js"></script>
</body>
</html>