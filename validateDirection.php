<?php
$keys = array_keys($_POST);
//var_dump($_POST);
//var_dump(array_keys($_POST));


switch ($keys[1]) {
    case "adminHome": 
        header( "location: admin/home.php" );      
        break;
    case "product":
        header( "location: admin/allProducts.php" );      
        break;
    case "user":
        header( "location: admin/showusers.php" );      
        break;
    case "MO":
        header( "location: admin/addOrderToUser.php" );      
    break;
    case "checks":
        header( "location: admin/checks.php" );      
         break;
    case "logout":
        header( "location: logout.php" );      
        break;

    case "userHome":
        header( "location: user/userhome.php" );      
        break;
    case "myOrders":
        header( "location: user/orders.php" );      
        break;

     default:
        header( "location: admin/home.php" );      
    }
    

    ?>