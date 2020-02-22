<?php
include ("DatabaseFunctions.php");

$dbObject= new Database('localhost', 'test', 'test', 'cafedb');
$myTest=$dbObject->getAllProducts();
/*
$myTest=[
    ["product"=>"product1","price"=>5,"image"=>"img1.jpg","statuse"=>"statuse1"],
    ["product"=>"product2","price"=>10,"image"=>"img2.jpg","statuse"=>"statuse2"],
    ["product"=>"product3","price"=>5,"image"=>"img3.jpg","statuse"=>"statuse3"],
    ["product"=>"product4","price"=>10,"image"=>"img4.jpg","statuse"=>"statuse4"]
    ];
    */
?>

<!DOCTYPE Html>
<html>

<?php  include("header.php"); ?>

<section>
<h1 style="margin:10px 0;font-size: 3em;color:#ffffcc;"> All Products </h1>

<button class="allProductLink">add product</button>  
</div>
</section>

<section >

<div style="overflow:auto;height:400px;overflow-x: hidden; margin-left:30%;margin-right:30%;">
<table id="products">
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
foreach($myTest as $row)
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
foreach($myTest as $row)
{    
    echo "<tr><td>" . $row['product_name'] . "</td><td>" . $row['price'] ."</td><td>" . 
    $row['product_img'] ."</td><td> <button class='button availablebtn'> Available
    </button> <button class='button updatebtn'> Update </button> <button class='button deletebtn'> Delete  </button> </td></tr>"; 
  
} 
  
?>
</table>
</div>
</section>


</body>
</html>