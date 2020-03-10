<head>
<title>Cafe PHP Project</title>
<link rel="stylesheet" href="../CSS/header.css">
<link rel="stylesheet" href="../CSS/displayAll.css">
<link rel="stylesheet" href="../CSS/form.css">
<link rel="stylesheet" href="../CSS/styleAddOrderToUser.css">
<link rel="stylesheet" href="../CSS/generalStyles.css">
<script type="text/javascript" src="https://code.jquery.com/jquery-1.9.1.min.js"></script>

</head>
<body>
<header>
<div class="topnav">

  <form action="../validateDirection.php" method="POST" enctype="multipart/form-data">
  <input type="hidden" name="source" value="header">
  <button id="homePage" name="adminHome">Home</button>
  <button id="prodPage" name="product">Products</button>
  <button id="userPage" name="user">Users</button>
  <button id="manualPage" name="MO">Manual Order</button>
  <button id="checksPage" name="checks">Checks </button>
  <button id="logout" name="logout"> Logout </button>
   </form>

</div>
</header>