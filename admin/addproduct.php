<?php
include('../login/login.php'); // Includes Login Script
if(isset($_SESSION['login_user'])){
    if($_SESSION['user_type']=='user'){
      echo $_SESSION['user_type'];
      header("location: ../login/");     
    } 
}
else {
   header("location: ../login/");
}
require_once('../databaseFunction/DatabaseFunctions.php');
$db = new Database('127.0.0.1', 'root', '123456', 'cafedb');

if($_POST["cat-name"]!=""){  
  $res=$db->addCategory($_POST["cat-name"]);
  if(!$res)echo '<script>alert("duplicate category")</script>';
}
else if($_POST["price"]!=""){  
  $name=$_POST["name"];
  $price=$_POST["price"];
  $category_id=$_POST["category"];
  if(validateFile()){
    $img = $_FILES['myfile']['name'];
    $res=$db->addProduct($name,$img,$price,$category_id);
     if(!$res)echo '<script>alert("Duplicated product")</script>';
     else{
      echo '<script>alert("Added Successfully")</script>';
     }
  }
 
}
function validateFile(){    
  if(isset($_FILES['myfile'])){
     $file_name = $_FILES['myfile']['name'];
     $file_type=$_FILES['myfile']['type'];
     $ext=explode('.',$_FILES['myfile']['name']);
     $file_ext=strtolower(end($ext));     
     $extensions= array("jpeg","jpg","png");   
     if(in_array($file_ext,$extensions)=== false){
         $errors.="Extension is not allowed, please choose a JPEG or PNG image.";
     }      
     if(empty($errors)==true){
         move_uploaded_file($file_tmp,"files/".$file_name);
         return 1;
      
     }else{
      
       echo '<script>alert("extension not allowed, please choose a JPEG or PNG file.")</script>';
      return 0;
        //  print_r($errors);
     }
 }
}
$categories=$db->getAllCategories();   
?>
<!DOCTYPE html>
<html>
<head>
   <meta charset="UTF-8">
	<title>Add product</title>
	<link rel="stylesheet" type="text/css" href="form.css">

</head>
<body>
    <div class="form_container">
    <h1><a>Add Product</a></h1>
    <form id="form" class="appnitro"  method="post" enctype="multipart/form-data" action="addproduct.php">	
      <div class="inp_container">
        <label class="name" for="name"> Name </label>
        <input id="name" name="name" class="element text large" type="text" maxlength="255" required /> 
      </div>
        <br/>        
        <div class="inp_container">
        <label class="price" for="price"> Price: </label>
        <input id="price" name="price" type="number" min="0.00" max="10000.00" step="0.01" required/>  
       </div>
        <br/>
        
      
        <div class="inp_container">
      
        <label for="category">Choose a Category:</label>
        <select name="category" id="category"> 
        <?php        
       
       foreach ($categories as $key => $value) {  
                if (is_array($value)) {                                                    
                     echo "<option value=".$value['category_id']." id=".$value['category_id'].">".$value['category_name']."</option>";                  
        }
        
       }
    
        ?>      
        </select> 
        <a href="addcategory.php" >Add Category</a>
        </div>
        <br/>     
        <br/>
      
        <div class="inp_container">        
        <label for="prod-picture">Product Picture:</label>
        <input type="file" id="prod-picture" name="myfile"> 
        </div>
        <br/>
        <div class="buttons">
        <input id="saveForm" class="button_text" type="submit" name="submit" value="Submit" />
        <input id="resetForm" class="button_text" type="reset" name="reset" value="Reset" />
    </div>
   
   
    </form>
</div>

</body>

</html>