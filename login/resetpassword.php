<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../CSS/resetpassword.css">
  <link rel="stylesheet" href="../CSS/login.css">

  <title>Reset Password</title>
  <style>
        body{
            height:90vh;
            overflow:hidden;
        }

        .main
        {
            margin-left: 6%;
            margin-top: 8%;
        }
        </style>
</head>
<body>

<div class="main">
    <section>
        <h1 class="pageTitle"> Reset Password </h1>
        <br>
    </section>
    
    <section class="content" >
  
    <form action="resetpasswordForm.php" method="post">
    <label for="email" class="fomrLable">Email:</label>
    <input type="email" name="email" id="email" class="formInput" ><br>
    <label for="password" class="fomrLable">Password:</label>
    <input type="password" name="password" id="password"class="formInput" ><br>
    <label for="confirmPass" class="fomrLable">Confirm passowrd:</label>
    <input type="password" name="confirmpassword" id="confirmpassword" class="formInput" ><br>
    <input type="submit" value="Submit" class ="save">
    <input type="reset" value="Reset" class="reset">
  </form>
  <a href="/login/index.php"><button class="forgetLink">Login ?</button> </a>


    </section>
    </div>
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