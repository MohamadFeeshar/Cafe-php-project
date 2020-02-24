
<?php
include('login.php'); // Includes Login Script

if(isset($_SESSION['login_user'])){
    if($_SESSION['user_type']=='user'){
        header("location: ../user/userhome.php");    
    }
    else {
        header("location: ../admin/home.php");   
    }
 
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="main">
<h1> Login </h1>
<div id="login">

<form action="" method="post">
<label>Email :</label>
<input id="email" name="email" placeholder="email" type="email">
<label>Password :</label>
<input id="password" name="password" placeholder="**********" type="password">
<input name="submit" type="submit" value=" Login ">
<span><?php echo $error; ?></span>
</form>
</div>
</div>
</body>
</html>