<?php
$keys = array_keys($_POST);
//var_dump($_POST);
//var_dump(array_keys($_POST));


switch ($keys[1]) {
    case "home": 
        header( "location: admin/home.php" );      
        break;
    case "product":
        header( "location: admin/allProducts.php" );      
        break;
    case "user":
        header( "location: admin/showusers.php" );      
        break;
    // case "MO":
    //     break;
    // case "checks":
    //     break;
    case "logout":
        header( "location: logout.php" );      
        break;
     default:
        header( "location: admin/home.php" );      
    }
    

    ?>