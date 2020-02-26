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



<!DOCTYPE html>
<html lang="en">

  <?php  include "../adminHeader.php";?>

  <div class="main">
    <section>
        <h1 class="pageTitle"> Add Category </h1>
        <br>
    </section>
    
    <section class="content" >
    <form id="form" class="appnitro"  method="post"  action="addproduct.php">	
      <div class="inp_container">
        <label for="cat-name" class="fomrLable"> Name : </label>
        <input id="cat-name" name="cat-name"  class="formInput" type="text" maxlength="255" required /> 
      </div>    
        <br/>
        <input type="submit" value="Save" class ="save">
        <input type="reset" value="Reset" class="reset">
   
    </form>
    
    </section> 
 

</body>

</html>