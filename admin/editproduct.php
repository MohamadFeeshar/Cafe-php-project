
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
$db = new Database("127.0.0.1",$DBUserName,$DBPassword, "cafedb");
$product = $db->getProduct($_GET['id']);
$catego=$db->getAllCategories();
$db->closeDBConnection();
?>






<?php  include "../adminHeader.php";?>

  <div class="main">
    <section>
        <h1 class="pageTitle"> Edit Product </h1>
        <br>
    </section>
    
   <!-- product_img VARCHAR(200), category_id INT NOT NULL -->
<section class="content" >
    <form action="editproductForm.php" method="post" enctype="multipart/form-data">
    <input type="hidden" class="formInput" style="padding: 4px 4px;margin: 2px 0;" name="productId" value="<?php echo $product["product_id"]; ?>">

    <label for="productname" class="fomrLable" style="font-size: 100%;">Product Name</label>
    <input type="test" class="formInput" style="padding: 4px 4px;margin: 2px 0;" name="productname" id="productname" value="<?php echo $product["product_name"]; ?>" required><br>
 
    <label for="price" class="fomrLable" style="font-size: 100%;">Price</label>
    <input type="number" class="formInput" style="padding: 4px 4px;margin: 2px 0;" name="price" id="price" value="<?php echo $product["price"]; ?>" required><br>
    
    <label for="available" class="fomrLable" style="font-size: 100%;">Available</label>
      <select id="available"  name="available">
    <option value="available">available</option>
    <option value="unavailable">unavailable</option>
    </select>
    <br/>

    <label for="category" class="fomrLable" style="font-size: 100%;">Category</label>
      <select id="available"  name="category">

      <?php 
      foreach ($catego as $c) {
        echo "<option value='".$c['category_name']."'>". $c['category_name']."</option>";
       }    
      ?>
      </select>

    <br/>

    <label for="pic" class="fomrLable" style="font-size: 100%;">Pick new picture</label>
    <input  type="file" id="productPic" name="productPic" class="formInput" style="padding: 4px 4px;margin: 2px 0;"><br>
    
    <input type="submit" value="Save" class ="save">
    <input type="reset" value="Reset" class="reset">
  </form>
    </section>
    </div>
    <!-- If something went wrong-->
 
    <h2><?php
      if(isset($_GET['error'])){
        if($_GET['error'] == 1){
          echo "Passowrds don't match";
        }
        else if($_GET['error'] == 2){
          echo "error uploading image";
        }
        else{
          echo "Something went wrong";
        }
      }
      else if(isset($_GET['success'])){
        echo "successful";
      }
  ?></h2>


</body>

</html>