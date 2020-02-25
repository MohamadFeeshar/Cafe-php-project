
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

<?php  include("../header.php");?>



<div class="main">
    <section>
        <h1 class="pageTitle"> Login </h1>
        <br>
    </section>
    
    <section class="content" >
        <form action="" method="post">
        <label class="fomrLable">Email :</label>
        <input class="formInput" name="email" placeholder="email" type="email">
        <br/><br/>
        <label class="fomrLable">Password :</label>
        <input class="formInput" name="password" placeholder="**********" type="password">
        <input class ="submit" name="submit" type="submit" value=" Login ">
        <span class="error"><?php echo $error; ?></span>
        </form>

    </section>
</div>

</body>
</html>