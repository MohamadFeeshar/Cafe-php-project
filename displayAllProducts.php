<?php

$myTest=[
    ["product"=>"product1","price"=>5,"image"=>"img1.jpg","statuse"=>"statuse1"],
    ["product"=>"product2","price"=>10,"image"=>"img2.jpg","statuse"=>"statuse2"],
    ["product"=>"product3","price"=>5,"image"=>"img3.jpg","statuse"=>"statuse3"],
    ["product"=>"product4","price"=>10,"image"=>"img4.jpg","statuse"=>"statuse4"]
    ];
?>

<!DOCTYPE Html>
<html>

<?php  include("header.php"); ?>

<section>
<h1> All Products </h1>

<a href="#">  <small style="float:right"> add product </small> </a>  
</section>

<section>


<table id="products">
    <tr>
    <th> Product </th>    
    <th> Price </th>    
    <th> Image </th>    
    <th> Action</th>    
    </tr>
<?php foreach($myTest as $row)
{    
    echo "<tr><td>" . $row['product'] . "</td><td>" . $row['price'] ."</td><td>" . 
    $row['image'] ."</td><td> <button style='background-color: #008CBA;'>" . $row['statuse'] .
    "</button> <button style='background-color: #008CBA;'> Update </button> <button style='background-color: #008CBA;'> Delete  </button> </td></tr>"; 
    
}
echo "</table>"; 
  
?>

</section>


</body>
</html>