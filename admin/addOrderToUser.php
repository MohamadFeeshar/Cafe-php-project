


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Order</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="styleAddOrderToUser.css">
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
        <form action="addOrderToUser.php" method="post">
            <h3>Items</h3>
            <div class="orderedItems">
                <!-- <div class="itemHolder">
                    <h2 class="itemName">Coffee</h2>
                    <button>+</button>
                    <h2 class="itemPrice">25</h2>
                    <button>-</button>
                    <button>X</button>
                </div> -->
            </div>
            <h3>Notes</h3>
            <textarea name="orderNotes" id="notes"></textarea><br>
            <label for="rooms">Room:</label>
            <select name="rooms" id="room">
                <option value="123">123</option>
                <option value="345">345</option>
            </select>
            <br>
            <div class="separator"></div>
            <div class="total">
            </div>
            <input type="submit" value="confirm" class="confirmOrder">
        </form>
    </div>
    <div class="orderOptions">
        <div class="usersCBox">
            <label for="users">Add to User:</label><br>
            <select name="users" id="users">

            </select>
        </div>
        <div class="separator"></div>
        <div class="products">
            <!-- <div class="productHolder">
                <img src="" alt="">
                <div class="priceHolder"></div>
            </div> -->
        </div>
    </div>
</div>

</body>
</html>