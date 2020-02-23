<!DOCTYPE Html>
<html>
<head>
   <title> </title>
   <style>
      *{
      margin:0;
      padding:0;
      }
      body{
      height: 100vh;
      font-family: "inherit;";
      background-image:url("../imag/t1.jpg") ;
      background-repeat: no-repeat;
      background-size: 100%;
      background-color:#D5BDAA ;
      }
      .myButton {
	box-shadow:inset 0px 1px 0px 0px #9fb4f2;
	background:linear-gradient(to bottom, #7892c2 5%, #476e9e 100%);
	background-color:#7892c2;
	border-radius:6px;
	border:1px solid #4e6096;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:Arial;
	font-size:20px;
	font-weight:bold;
	padding:6px 24px;
	text-decoration:none;
   text-shadow:0px 1px 0px #283966;
   margin:1%;
}
.myButton:hover {
	background:linear-gradient(to bottom, #476e9e 5%, #7892c2 100%);
	background-color:#476e9e;
}
.myButton:active {
	position:relative;
	top:1px;
}

       
        
   </style>
</head>
<body style="height:100%">

<section class="homeBody">
   <div style="margin-left:25%;margin-top:10%;">
            <h1 style="margin:1%;color:rgba(167, 82, 55,0.9);font-size:400%"> SELECT ^_^ </h1>
            <br>
            <button class="myButton"> HOME </button>
            <br>
            <button class="myButton"> PRODUCTS </button>
            <br>
            <button class="myButton"> USERS </button>
            <br>
            <button class="myButton"> MANUAL - ORDERS </button>
            <br>
            <button class="myButton"> CHECKS </button>
            <br>
   </div>
</section>

</body>
</html>


<?php
$currentPage="homePage";
echo '<style type="text/css">
   #homePage{
    background-color:#6f8c76;
    color:white
   }
  
   </style>';

?> 

