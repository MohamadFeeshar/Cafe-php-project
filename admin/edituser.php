<?php
require_once '../databaseFunction/DatabaseFunctions.php';
include '../login/login.php'; // Includes Login Script
if (isset($_SESSION['login_user'])) {
    if ($_SESSION['user_type'] == 'user') {
        echo $_SESSION['user_type'];
        header("location: ../login/");
    }
} else {
    header("location: ../login/");
}
$db = new Database("127.0.0.1", "phpmyadmin", "phpmyadmin", "cafedb");
$user = $db->getUser($_GET['id']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit User</title>
</head>

<body>
  <h2>Editing <?php echo $user["user_name"]; ?> Profile </h2>
  <form action="edituserForm.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="userId" value="<?php echo $user["user_id"]; ?>">
    <label for="username">User Name</label>
    <input type="text" name="username" id="username" value="<?php echo $user["user_name"]; ?>" required><br>
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" value="<?php echo $user["email"]; ?>" required><br>
    <label for="password">Password</label>
    <input type="password" name="password" id="password"><br>
    <label for="confirmPass">Confirm passowrd:</label>
    <input type="password" name="confirmpassword" id="confirmpassword"><br>
    <label for="RoomNo">Room No.</label>
    <input type="text" name="room" id="room" value="<?php echo $user["room"]; ?>" required><br>
    <label for="ext">Ext</label>
    <input type="text" name="ext" id="ext" value="<?php echo $user["ext"]; ?>" required><br>
    <label for="pic">Pick new picture</label>
    <input type="file" id="profilePic" name="profilePic"><br>
    <input type="submit" value="Save" name="submit">
    <input type="reset" value="Reset">
  </form>

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