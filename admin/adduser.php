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


?>

<!DOCTYPE html>
<html lang="en">

  <?php  include "../adminHeader.php";?>

  <div class="main">
    <section>
        <h1 class="pageTitle"> Add New User </h1>
        <br>
    </section>
    
    <section class="content" >
    <form action="addUserForm.php" method="post" enctype="multipart/form-data">
    <label for="username" class="fomrLable" style="font-size: 100%;">User Name</label>
    <input type="text" name="username" id="username" class="formInput" style="padding: 4px 4px;margin: 2px 0;" required><br>
    <label for="email" class="fomrLable" style="font-size: 100%;">Email:</label>
    <input type="email" name="email" id="email" class="formInput" style="padding: 4px 4px;margin: 2px 0;" required><br>
    <label for="password" class="fomrLable" style="font-size: 100%;">Password:</label>
    <input type="password" name="password" id="password" class="formInput" style="padding: 4px 4px;margin: 2px 0;" required><br>
    <label for="confirmPass" class="fomrLable" style="font-size: 100%;">Confirm passowrd:</label>
    <input type="password" name="confirmpassword" id="confirmpassword" class="formInput" style="padding: 4px 4px;margin: 2px 0;" required><br>
    <label for="room" class="fomrLable" style="font-size: 100%;">Room No.</label>
    <input type="text" name="room" id="room" class="formInput" style="padding: 4px 4px;margin: 2px 0;" required><br>
    <label for="ext" class="fomrLable" style="font-size: 100%;">Ext</label>
    <input type="text" name="ext" id="ext" class="formInput" style="padding: 4px 4px;margin: 2px 0;" required><br>
    <label for="pic" class="fomrLable" style="font-size: 100%;">Profile picture</label>
    <input type="file" id="profilePic" name="profilePic" class="formInput" style="padding: 4px 4px;margin: 2px 0;" ><br>
    <input type="submit" value="submit" class ="save">
    <input type="reset" value="Reset" class="reset">
     </form>

    </section> 
    </div>
    <p class="errorMsg">
      <?php
        if(isset($_GET['error'])){
          if($_GET['error'] == 'duplicate'){
              echo "duplicate entry please check data entered";
          } else{
            echo "Something went wrong";
          }
        }
      ?>
    </p>
</body>

</html>