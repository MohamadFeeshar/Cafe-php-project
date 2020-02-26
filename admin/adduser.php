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

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add New User</title>
</head>

<body>
  <h2> Add New User </h2>
  <form action="addUserForm.php" method="post" enctype="multipart/form-data">
    <label for="username">User Name</label>
    <input type="text" name="username" id="username"><br>
    <label for="email">Email:</label>
    <input type="email" name="email" id="email"><br>
    <label for="password"></label>
    <input type="password" name="password" id="password"><br>
    <label for="confirmPass">Confirm passowrd:</label>
    <input type="password" name="confirmpassword" id="confirmpassword"><br>
    <label for="RoomNo">Room No.</label>
    <input type="text" name="roomno" id="roomno"><br>
    <label for="ext">Ext</label>
    <input type="text" name="ext" id="ext"><br>
    <label for="pic">Profile picture</label>
    <input type="file" id="profilePic" name="profilePic"><br>
    <input type="submit" value="Save">
    <input type="reset" value="Reset">
  </form>
  <h2>
    <?php
      if(isset($_GET['error'])){
        echo "Something went wrong";
      }
    ?>
  </h2>

</body>

</html>