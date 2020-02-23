<?php
include ("../databaseFunction/DatabaseFunctions.php");
$dbObject= new Database('localhost', 'test', 'test', 'cafedb');
$myTest=$dbObject->getAllProducts();
?>

<!DOCTYPE Html>
<html>

<?php  include("../header.php");?>

<section>
    <h1 style="margin-left:2%;margin-bottom:0;margin-top:1%;font-size: 3em;color:#ffffcc;"> All Products </h1>
    <button class="addLink">add product ?</button>  
    <br>
    </div>
</section>

<section>
<div class="contentDisPlayall">
    <table id="data">
        <tr>
        <th> Product </th>    
        <th> Price </th>    
        <th> Image </th>    
        <th> Action</th>    
        </tr>
    <?php foreach($myTest as $row)
    {    
        echo "<tr><td>" . $row['product_name'] . "</td><td>" . $row['price'] ."</td><td>" . 
        $row['product_img'] ."</td><td> <button class='button availablebtn'> Available
        </button> <button class='button updatebtn'> Update </button> <button class='button deletebtn'> Delete  </button> </td></tr>"; 
    
    }

    foreach($myTest as $row)
    {    
        echo "<tr><td>" . $row['product_name'] . "</td><td>" . $row['price'] ."</td><td>" . 
        $row['product_img'] ."</td><td> <button class='button availablebtn'> Available
        </button> <button class='button updatebtn'> Update </button> <button class='button deletebtn'> Delete  </button> </td></tr>"; 
    }

    
    ?>
    </table>

    <table id="tableImage">

    <tr ><td colspan="2"><img src="../imag/img4.jpg" alt="pepsi" height="60%" width="80%" style="border: 2px solid #ddd;"></td> </tr>
    <tr><td><img src="../imag/img1.jpeg" alt="coffe" height="80%" width="90%" style="border: 2px solid #ddd; border-radius:10px ;transform: rotate(10deg);"></td>
    <td rowspan="0"><img src="../imag/img3.jpg" alt="juice" height="30%" width="100%" style="border: 2px solid #ddd; border-radius:10px ;transform: rotate(-8deg);"></td> 
    </tr>
    <tr><td><img src="../imag/img2.png" alt="pepsi" height="30%" width="100%" style="border: 2px solid #ddd; transform: rotate(0deg);"></td> </tr>

    </table>
    </div>
</section>

<?php include("../footer.php");?>

<?php
$currentPage="prodPage";
echo '<style type="text/css">
   #prodPage{
    background-color:#6f8c76;
    color:white
   }
   </style>';
?> 



   

   


  

