<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../CSS/header.css">
    <link rel="stylesheet" href="../CSS/userhomestyle.css">
    <link rel="stylesheet" href="../CSS/userOrders.css">
    
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.9.1.min.js"></script>

    <title>User</title>
</head>
<body>
    
<header>
<div class="topnav">
  <form action="../validateDirection.php" method="POST" enctype="multipart/form-data">
  <input type="hidden" name="source" value="header">
  <button id="homePage" name="userHome">Home</button>
  <button id="myOrders" name="myOrders">myOrders</button>
  <button id="logout" name="logout"> Logout </button>
   </form>
</div>
</header>

