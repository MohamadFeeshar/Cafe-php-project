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
?>
<!DOCTYPE Html>
<html>
<head>
   <title> </title>
   <link rel="stylesheet" href="../CSS/home.css">
</head> 
<body style="height:100%">

<section class="homeBody">
   <form action="../validateDirection.php" method="POST"  enctype="multipart/form-data">
      <h1 > SELECT ^_^ </h1>
      <input type="hidden" name="source" value="home">
      <br>
      <button class="myButton" name="home"> HOME </button>
      <br>
      <button class="myButton" name="product"> PRODUCTS </button>
      <br>
      <button class="myButton" name="user"> USERS </button>
      <br>
      <button class="myButton" name="MO"> MANUAL - ORDERS </button>
      <br>
      <button class="myButton" name="checks"> CHECKS </button>
      <br>
</form>
</section>

</body>
</html>