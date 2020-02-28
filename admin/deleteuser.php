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
$user = $db->getUser($_GET['id']);

?>




<!DOCTYPE html>
<html lang="en">

  <?php  include "../adminHeader.php";?>

  <div class="main">
    <section>
        <h1 class="pageTitle"> Do you want to delete <?php echo $user["user_name"]; ?> ? </h1>
        <br>
    </section>
    
 
<section class="content" >
   
   

<form action="deleteuserForm.php" method="POST">
  <input type="hidden" name="userId" value=<?php echo $user['user_id']?>>
  <button name="submit" type="submit" class='button deletebtn'  value="confirm" style="height:10%"> Delete </button>
</form>
<a href="/admin/home.php" <button name="submit" type="submit" class='button updatebtn'  value="confirm" style="height:5%"> Back to Home </button> </a>

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
      else{
        echo "successful";
      }
  ?></h2>


</body>

</html>