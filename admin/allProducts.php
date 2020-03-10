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
$myTest=$db->getAllProducts();
?>

<!DOCTYPE Html>
<html>

<?php  include("../adminHeader.php");?>

<div class="main">
    <section>
        <h1 class="pageTitle"> All Products </h1>
        <a href="addproduct.php"><button class="addLink">add product ?</button> </a>
        <br>
    </section>
    <section>
        <p class="errorMsg"><?php
            if(isset($_GET['error']) && $_GET['error'] == 'delete'){
                echo "Something went wrong with deletion";
            }
            else if (isset($_GET['success'])){
                echo "successful deletion";
            }
            ?>
        </p>
    </section>
    <section class="content">
            <table id="data">
                <tr>
                <th> Product </th>    
                <th> EGP </th>    
                <th> Image </th>    
                <th> Action</th>    
                </tr>
            <?php foreach($myTest as $row)
            {    
                echo "<tr><td>" . $row['product_name'] . "</td><td>" . $row['price'] ."</td><td> <img src = \"../imag/" . 
                $row['product_img'] ."\" style='width:50%;height:25%'></td><td> ";
                
                if($row['available']==="available")
                {
                    
                    echo "<a href='handleProductSatus.php?id=". $row['product_id']."&set=unavailable'> <button class='button unavailablebtn'> Unvailable";
                }
                else
                {
                    echo "<a href='handleProductSatus.php?id=". $row['product_id']."&set=available'> <button class='button availablebtn' >  Available ";
                }
                echo "</button> </a> <a href='editproduct.php?id=".$row['product_id']."' > <button class='button updatebtn'> Update </button> <a/> <a href=./allProdcutsRemove.php?pId=".$row['product_id']."><button class='button deletebtn'> Delete  </button></a> </td></tr>"; 
            
            }
            
            
            ?>
            </table>

            
        
    </section>
   
</div>

</body>
</html>