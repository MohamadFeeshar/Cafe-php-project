
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


<!DOCTYPE Html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="../CSS/login.css">
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
        <h1 class="pageTitle"> Login </h1>
        <br/>
    </section>
    
    <section class="content" >
        <form action="" method="post">
        <label class="fomrLable">Email :</label>
        <input class="formInput" name="email" placeholder="email" type="email">
        <br/><br/>
        <label class="fomrLable">Password :</label>
        <input class="formInput" name="password" placeholder="**********" type="password">
        <input class ="submit" name="submit" type="submit" value=" Login ">
        <br>
        <span class="error"><?php echo $error; ?></span>

    </form>
    <a href="/login/resetpasswordForm.php"><button class="forgetLink">Forget Password ?</button> </a>
    </section>
</div>

</body>
</html>