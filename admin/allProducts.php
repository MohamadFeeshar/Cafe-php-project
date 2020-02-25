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
$dbObject= new Database('localhost', 'test', 'test', 'cafedb');
$myTest=$dbObject->getAllProducts();
?>

<!DOCTYPE Html>
<html>

<?php  include("../header.php");?>

<div class="main">
    <section>
        <h1 class="pageTitle"> All Products </h1>
        <button class="addLink">add product ?</button>  
        <br>
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
                echo "<tr><td>" . $row['product_name'] . "</td><td>" . $row['price'] ."</td><td>" . 
                $row['product_img'] ."</td><td> <button class='button availablebtn'> Available
                </button> <button class='button updatebtn'> Update </button> <button class='button deletebtn'> Delete  </button> </td></tr>"; 
            
            }
            
            
            ?>
            </table>

            
        
    </section>
</div>

</body>
</html>