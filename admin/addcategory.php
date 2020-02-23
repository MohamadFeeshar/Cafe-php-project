<?php


?>
<!DOCTYPE html>
<html>
<head>
   <meta charset="UTF-8">
	<title>Add product</title>
	<link rel="stylesheet" type="text/css" href="form.css">

</head>
<body>
    <div class="form_container">
    <h1><a>Add Category</a></h1>
    <form id="form" class="appnitro"  method="post"  action="addproduct.php">	
      <div class="inp_container">
        <label class="name" for="cat-name"> Name </label>
        <input id="cat-name" name="cat-name" class="element text large" type="text" maxlength="255" required /> 
      </div>    
        <br/>
        <div class="buttons">
        <input id="saveForm" class="button_text" type="submit" name="submit" value="Submit" />
        <input id="resetForm" class="button_text" type="reset" name="reset" value="Reset" />
    </div>
   
   
    </form>
</div>

</body>

</html>