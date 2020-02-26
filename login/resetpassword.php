<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Password</title>
</head>
<body>
  <h2>Reset Password </h2>
  <form action="resetpasswordForm.php" method="post">
    <label for="email">Email:</label>
    <input type="email" name="email" id="email"><br>
    <label for="password">Password</label>
    <input type="password" name="password" id="password"><br>
    <label for="confirmPass">Confirm passowrd:</label>
    <input type="password" name="confirmpassword" id="confirmpassword"><br>
    <input type="submit" value="Save" name="submit">
    <input type="reset" value="Reset">
  </form>

  <!-- If something went wrong-->
  <h2>
    <?php
        if(isset($_GET['error'])){
          if($_GET['error'] == 1)
            echo "Email is empty";
          else if($_GET['error'] == 2){
            echo "Passwords don't match";
          }
          else{
            echo "something went wrong or you have used old password";
          }
        }
    ?>
    </h2>
</body>

</html>