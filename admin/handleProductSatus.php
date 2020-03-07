<?php
include '../login/login.php'; // Includes Login Script
if (isset($_SESSION['login_user'])) {
    if ($_SESSION['user_type'] == 'user') {
        echo $_SESSION['user_type'];
        header("location: ../login/");
    }
} else {
    header("location: ../login/");
}

?>

<?php
var_dump($_GET);
$id=$_GET['id'];
$set=$_GET['set'];

require_once('../databaseFunction/DatabaseFunctions.php');
$db = new Database("127.0.0.1",$DBUserName,$DBPassword, "cafedb");
$res = $db->updateProductStatus($id,$set);
header( "location: allProducts.php" );      


?>