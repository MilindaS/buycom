<?php


include "storescripts/connect_to_mysql.php";

// Parse the form data and add inventory item to the system
if (isset($_POST['tot'])) {

     $tot = mysqli_real_escape_string($link,$_POST['tot']);
	$name = mysqli_real_escape_string($link,$_POST['name']);
	$email = mysqli_real_escape_string($link,$_POST['email']);
	$address = mysqli_real_escape_string($link,$_POST['address']);

    }


// Script Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<title>Conformation</title>




<!--<link rel="stylesheet" href="style/style.css" type="text/css" media="screen" />-->
 <link href="style/bootstrap.min.css" rel="stylesheet">

 <link href="style/my.css" rel="stylesheet">
</head>
<body>
<div class="container-fluid">
  <div align="center" id="mainWrapper">

    <div class="well">


      <h1>Successfully Completed</h1>
     <h4>Your transation has been successfully completed . </br>
     thank you!</h4>

     <hr>

        <?php echo "<h4>Name :&nbsp;".$name."</h4>"; ?>
         <?php echo "<h4>E-Mail :&nbsp;".$email."</h4>"; ?>
          <?php echo "<h4>Address :&nbsp;".$address."</h4>"; ?>
            <?php echo $tot; ?>       </br>
       <hr>
         <a href="cart.php" class="btn btn-primary">Go Back to Cart</a></br>

    </div>
    <?php include_once("template_footer.php");?>
  </div>
</div>
 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>