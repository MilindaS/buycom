<?php
// This file is www.developphp.com curriculum material
// Written by Adam Khoury January 01, 2011
// http://www.youtube.com/view_play_list?p=442E340A42191003
session_start();
if (!isset($_SESSION["manager"])) {
    header("location: admin_login.php"); 
    exit();
}
// Be sure to check that this manager SESSION value is in fact in the database
$managerID = preg_replace('#[^0-9]#i', '', $_SESSION["id"]); // filter everything but numbers and letters
$manager = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["manager"]); // filter everything but numbers and letters
$password = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["password"]); // filter everything but numbers and letters
// Run mySQL query to be sure that this person is an admin and that their password session var equals the database information
// Connect to the MySQL database  
include "../storescripts/connect_to_mysql.php"; 
$sql = mysqli_query($link,"SELECT * FROM admin WHERE id='$managerID' AND username='$manager' AND password='$password' LIMIT 1"); // query the person
// ------- MAKE SURE PERSON EXISTS IN DATABASE ---------
$existCount = mysqli_num_rows($sql); // count the row nums
if ($existCount == 0) { // evaluate the count
	 echo "Your login session data is not on record in the database.";
     exit();
}
?>
<?php 
// Script Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<?php 
// Parse the form data and add inventory item to the system
if (isset($_POST['product_name'])) {
	
	$pid = mysqli_real_escape_string($link,$_POST['thisID']);
    $product_name = mysqli_real_escape_string($link,$_POST['product_name']);
	$price = mysqli_real_escape_string($link,$_POST['price']);
	$category = mysqli_real_escape_string($link,$_POST['category']);
	$subcategory = mysqli_real_escape_string($link,$_POST['subcategory']);
	$details = mysqli_real_escape_string($link,$_POST['details']);
	// See if that product name is an identical match to another product in the system
	$sql = mysqli_query($link,"UPDATE products SET product_name='$product_name', price='$price', details='$details', category='$category', subcategory='$subcategory' WHERE id='$pid'");
	if ($_FILES['fileField']['tmp_name'] != "") {
	    // Place image in the folder 
	    $newname = "$pid.jpg";
	    move_uploaded_file($_FILES['fileField']['tmp_name'], "../inventory_images/$newname");
	}
	header("location: inventory_list.php"); 
    exit();
}
?>
<?php 
// Gather this product's full information for inserting automatically into the edit form below on page
if (isset($_GET['pid'])) {
	$targetID = $_GET['pid'];
    $sql = mysqli_query($link,"SELECT * FROM products WHERE id='$targetID' LIMIT 1");
    $productCount = mysqli_num_rows($sql); // count the output amount
    if ($productCount > 0) {
	    while($row = mysqli_fetch_array($sql)){ 
             
			 $product_name = $row["product_name"];
			 $price = $row["price"];
			 $category = $row["category"];
			 $subcategory = $row["subcategory"];
			 $details = $row["details"];
			 $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
        }
    } else {
	    echo "Sorry dude that crap dont exist.";
		exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<title>Inventory Edit</title>
<!--<link rel="stylesheet" href="../style/style.css" type="text/css" media="screen" />-->
 <link href="../style/bootstrap.min.css" rel="stylesheet">

 <link href="../style/my.css" rel="stylesheet">
</head>

<body>
<div align="center" id="mainWrapper">
  <?php include_once("template_header.php");?>
  <div id="pageContent"><br />
    <div align="right" style="margin-right:32px;"><a href="inventory_list.php#inventoryForm">+ Add New Inventory Item</a></div>
<div align="left" style="margin-left:24px;">

    </div>
    <hr />
    <a name="inventoryForm" id="inventoryForm"></a>
    <h3>
    &darr; Add New Inventory Item Form &darr;
    </h3>


       <div class="row">
    <div class="col-sm-7 col-sm-offset-3">

    <form action="inventory_edit.php" enctype="multipart/form-data" name="myForm" id="myform" method="post">



        <label>   Product Name
          <input class="form-control" name="product_name" type="text" id="product_name" value="<?php echo $product_name; ?>" />
        </label>  </br> </br>


        <label>  Product Price  $

          <input class="form-control" name="price" type="text" id="price" value="<?php echo $price; ?>"/>
        </label>
        </br> </br>
        <label>Category
          <select class="form-control" name="category" id="category">
            <option value="<?php echo $category; ?>"><?php echo $category; ?></option>
          <option value="Clothing">Clothing</option>
          <option value="Toys">Toys</option>
          <option value="Electronics">Electronics</option>
          <option value="Sporting Goods">Sporting Goods</option>
          </select>
        </label>
        </br>   </br>
        <label>Subcategory
        <select  name="subcategory" id="subcategory" class="form-control">
            <option value="<?php echo $subcategory; ?>"><?php echo $subcategory; ?></option>
          <option value="Pants">Pants</option>
          <option value="Jeans">Jeans</option>
          <option value="Casual Shirts">Casual Shirts</option>
          <option value="Suits">Suits</option>
          <option value="Athletic Apparel">Athletic Apparel</option>
          <option value="Kids Toys">Kids Toys</option>
          <option value="Phones">Phones</option>
          <option value="Computers">Computers</option>
          <option value="Cameras And Photos">Cameras And Photos</option>
          <option value="Outdoor Sports">Outdoor Sports</option>
          <option value="Indoor Games">Indoor Games</option>
          <option value="Water Sports">Water Sports</option>
          <option value="Mobile Accessories">Mobile Accessories</option>
          <option value="Computer Accessories">Computer Accessories</option>
          <option value="Camera Accessories">Camera Accessories</option>
          </select>
           </select>
           </br> </br>
          <label>Product Details
          <textarea class="form-control" name="details" id="details"><?php echo $details; ?></textarea>
        </label>
        </br>   </br>
        <label>Product Image
          <input type="file" class="form-control" name="fileField" id="fileField" />
        </label>

        </br> </br>
        &nbsp;
        <label>
            <input name="thisID" type="hidden" value="<?php echo $targetID; ?>" />
          <input type="submit" name="button" id="button" value="Make change" class="btn btn-primary" />
        </label>

    </form>
    </div>

    <br />
  <br />
  </div>


    <br />
  <br />
  </div>
  <?php include_once("template_footer.php");?>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>