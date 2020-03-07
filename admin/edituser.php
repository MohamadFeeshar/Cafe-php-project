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

require_once('../databaseFunction/DatabaseFunctions.php');
$db = new Database("127.0.0.1",$DBUserName,$DBPassword, "cafedb");
$user = $db->getUser($_GET['id']);
$db->closeDBConnection();
?>
<!DOCTYPE html>
<html lang="en">

<!DOCTYPE html>
<html lang="en">

  <?php  include "../adminHeader.php";?>

  <div class="main">
    <section>
        <h1 class="pageTitle"> Edit User </h1>
        <br>
    </section>
    
 
<section class="content" >
    <form action="edituserForm.php" method="post" enctype="multipart/form-data">
    <input type="hidden" class="formInput" style="padding: 4px 4px;margin: 2px 0;" name="userId" value="<?php echo $user["user_id"]; ?>">
    <label for="username" class="fomrLable" style="font-size: 100%;">User Name</label>
    <input type="text" class="formInput" style="padding: 4px 4px;margin: 2px 0;" name="username" id="username" value="<?php echo $user["user_name"]; ?>" required><br>
    <label for="email" class="fomrLable" style="font-size: 100%;">Email:</label>
    <input type="email" class="formInput" style="padding: 4px 4px;margin: 2px 0;" name="email" id="email" value="<?php echo $user["email"]; ?>" required><br>
    <label for="password" class="fomrLable" style="font-size: 100%;">Password</label>
    <input type="password" class="formInput" style="padding: 4px 4px;margin: 2px 0;" name="password" id="password"><br>
    <label for="confirmPass" class="fomrLable" style="font-size: 100%;">Confirm passowrd:</label>
    <input type="password" class="formInput" style="padding: 4px 4px;margin: 2px 0;" name="confirmpassword" id="confirmpassword"><br>
    <label for="RoomNo" class="fomrLable" style="font-size: 100%;">Room No.</label>
    <input type="text" class="formInput" style="padding: 4px 4px;margin: 2px 0;" name="room" id="room" value="<?php echo $user["room"]; ?>" required><br>
    <label for="ext" class="fomrLable" style="font-size: 100%;">Ext</label>
    <input type="text" name="ext" id="ext" value="<?php echo $user["ext"]; ?>" class="formInput" style="padding: 4px 4px;margin: 2px 0;" required><br>
    <label for="pic" class="fomrLable" style="font-size: 100%;">Pick new picture</label>
    <input type="file" id="profilePic" name="profilePic" class="formInput" style="padding: 4px 4px;margin: 2px 0;"><br>
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