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
$result = 0;
require_once '../databaseFunction/DatabaseFunctions.php';
$dbs = new Database("localhost", $DBUserName, $DBPassword, "cafedb");

var_dump($_POST);


if (isset($_POST['productname']) && isset($_POST['price']) && isset($_POST['available']) && isset($_POST['category'])) 
{
  
  if(isset($_FILES['productPic']) && !empty($_FILES['productPic']['name']) && validateFile() == 1)
  {
    $result = $dbs->updateProductWithImage($_POST['productPic'],$_POST['productId'],$_POST['productname'], $_POST['price'], $_POST['available'], $_POST['category'], $_POST['productPic']);
    $dbs->closeDBConnection();

    if ($result) {
         echo "here";
       $dbs->closeDBConnection();
       header("location: ./allProducts.php?success=1");
   }
   else{
        echo "here2";
       $dbs->closeDBConnection();
       header("location: ./allProducts.php?error=4");
   }

  }
  else
  {
    // echo "no img";
    $result = $dbs->updateProduct($_POST['productId'],$_POST['productname'], $_POST['price'], $_POST['available'], $_POST['category']);
    $dbs->closeDBConnection();
    var_dump($result);
    if ($result) {
        $dbs->closeDBConnection();
        header("location: ./allProducts.php?success=1");
   }
   else{
        $dbs->closeDBConnection();
       header("location: ./allProducts.php?error=4");
   }

  }


     

}
else
{
    header("location: ./editproduct.php?id=" . $_POST['productId'] . "&error='please Fill Data'");
}




function validateFile()
{
    if (isset($_FILES['productPic'])) {
        $errors = "";
        $file_name = $_FILES['productPic']['name'];
        if ($file_name) {
            $file_type = $_FILES['productPic']['type'];
            $ext = explode('.', $_FILES['productPic']['name']);
            $file_ext = strtolower(end($ext));
            $extensions = array("jpeg", "jpg", "png");
            if (in_array($file_ext, $extensions) === false) {
                $errors .= "Extension is not allowed, please choose a JPEG or PNG image.";
            }
            if (empty($errors) == true) {
                move_uploaded_file($file_tmp, "files/" . $file_name);
                return 1;

            } else {
                echo '<script>alert("extension not allowed, please choose a JPEG or PNG file.")</script>';
                return 0;
            }
        } else {
            return 2;
        }
    }
}
