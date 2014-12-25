<?php
  $tot=$_GET["tot"];

 
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
<title>User Info</title>




<!--<link rel="stylesheet" href="style/style.css" type="text/css" media="screen" />-->
 <link href="style/bootstrap.min.css" rel="stylesheet">

 <link href="style/my.css" rel="stylesheet">
</head>
<body>
<div class="container-fluid">
  <div align="center" id="mainWrapper">
    <?php include_once("template_header.php");?>
    <div class="well">


      <!--<h3></h3>-->

      <form class="form-horizontal" action="conform.php" method="post">
        <fieldset>

        <!-- Form Name -->
        <legend>Customer Information</legend>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="name">Full Name</label>
          <div class="col-md-3">
          <input id="name" name="name" type="text" placeholder="Name" class="form-control input-md" required="">

          </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="email">E-Mail</label>
          <div class="col-md-4">
          <input id="email" name="email" type="text" placeholder="E-Mail" class="form-control input-md" required="">

          </div>
        </div>

        <!-- Textarea -->
        <div class="form-group">
          <label class="col-md-4 control-label" for="address">Address</label>
          <div class="col-md-3">
            <textarea class="form-control" id="address" name="address">Address</textarea>
          </div>
        </div>

        <!-- Button -->
        <div class="form-group">
          <label class="col-md-4 control-label" for="submit"></label>
          <div class="col-md-1">

          	<input type="hidden" name="tot" value="<?php echo $_GET["tot"]; ?>">

            <button id="submit" name="submit" type="submit" class="btn btn-success">Submit</button>
          </div>
        </div>

        </fieldset>
        </form>




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