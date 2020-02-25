<?php
require '../databaseFunction/DatabaseFunctions.php';
include('../login/login.php'); // Includes Login Script
if(isset($_SESSION['login_user'])){
    if($_SESSION['user_type']=='user'){
      echo $_SESSION['user_type'];
      header("location: ../login/");     
    } 
}
else {
   header("location: ../login/");
}
  $user = $db->getUser($_GET['id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Delete User</title>
</head>
<body>
<form action="deleteuserForm.php" method="post">
  <p>Do you want to delete <?php echo $user["user_name"]; ?> ? </p>
  <input type="hidden" name="userId" value=<?php echo $user['user_id']?>>
  <input type="submit" value="confirm">
</form>
<a href="./showusers.php"><button>Cancel</button></a>
</body>
</html>