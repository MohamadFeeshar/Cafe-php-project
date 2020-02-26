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
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Delete User</title>
</head>
<body>
<form action="deleteuserForm.php" method="POST">
  <p>Do you want to delete <?php echo $user["user_name"]; ?> ? </p>
  <input type="hidden" name="userId" value=<?php echo $user['user_id']?>>
  <input type="submit" value="confirm" name="submit">
</form>
<a href="./showusers.php"><button>Cancel</button></a>
</body>
</html>