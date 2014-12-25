<?php

// Script Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', '0');
?>
<?php 
// Check to see the URL variable is set and that it exists in the database
if (isset($_GET['id'])) {
	// Connect to the MySQL database  
    include "storescripts/connect_to_mysql.php"; 
	$id = preg_replace('#[^0-9]#i', '', $_GET['id']); 
	// Use this var to check to see if this ID exists, if yes then get the product 
	// details, if no then exit this script and give message why
	$sql = mysqli_query($link,"SELECT * FROM products WHERE id='$id' LIMIT 1");
	$productCount = mysqli_num_rows($sql); // count the output amount
    if ($productCount > 0) {
		// get all the product details
		while($row = mysqli_fetch_array($sql)){ 
			 $product_name = $row["product_name"];
			 $price = $row["price"];
			 $details = $row["details"];
			 $category = $row["category"];
			 $subcategory = $row["subcategory"];
			 $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
         }
		 
	} else {
		echo "That item does not exist.";
	    exit();
	}
		
} else {
	echo "Data to render this page is missing.";
	exit();
}
mysqli_close($link);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $product_name; ?></title>
    <!--<link rel="stylesheet" href="style/style.css" type="text/css" media="screen" />-->
     <link href="style/bootstrap.min.css" rel="stylesheet">

 <link href="style/my.css" rel="stylesheet">
</head>
<body>
<div class="container-fluid">
<div id="mainWrapper">
  <?php include_once("template_header.php");?>
  <div class="row well"> </br></br>

    <div class="col-sm-3 ">
      <img src="inventory_images/<?php echo $id; ?>.jpg" alt="<?php echo $product_name; ?>" class="thumbnail img-responsive"/>


        <a href="inventory_images/<?php echo $id; ?>.jpg" class="btn btn-link">View Full Size Image</a>
    </div>





   <div class="col-sm-5 col-md-offset-1 "><h1><?php echo $product_name; ?></h1>
      <p><?php echo "$ &nbsp;".$price."&nbsp;USD"; ?><br />
        <br />
        <?php echo "$subcategory $category"; ?> <br />
<br />
        <?php echo $details; ?>
<br />
        </p>
      <form id="form1" name="form1" method="post" action="cart.php">
        <input type="hidden" name="pid" id="pid" value="<?php echo $id; ?>" />
        <input type="submit" name="button" id="button" value="Add to Shopping Cart" class="btn btn-success" />
      </form></div>


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