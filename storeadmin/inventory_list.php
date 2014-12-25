<?php

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
// Delete Item Question to Admin, and Delete Product if they choose
if (isset($_GET['deleteid'])) {
	echo 'Do you really want to delete product with ID of ' . $_GET['deleteid'] . '? <a href="inventory_list.php?yesdelete=' . $_GET['deleteid'] . '">Yes</a> | <a href="inventory_list.php">No</a>';
	exit();
}
if (isset($_GET['yesdelete'])) {
	// remove item from system and delete its picture
	// delete from database
	$id_to_delete = $_GET['yesdelete'];
	$sql = mysqli_query($link,"DELETE FROM products WHERE id='$id_to_delete' LIMIT 1") or die (mysqli_error());
	// unlink the image from server
	// Remove The Pic -------------------------------------------
    $pictodelete = ("../inventory_images/$id_to_delete.jpg");
    if (file_exists($pictodelete)) {
       		    unlink($pictodelete);
    }
	header("location: inventory_list.php"); 
    exit();
}
?>
<?php 
// Parse the form data and add inventory item to the system
if (isset($_POST['product_name'])) {
	
    $product_name = mysqli_real_escape_string($link,$_POST['product_name']);
	$price = mysqli_real_escape_string($link,$_POST['price']);
	$category = mysqli_real_escape_string($link,$_POST['category']);
	$subcategory = mysqli_real_escape_string($link,$_POST['subcategory']);
	$details = mysqli_real_escape_string($link,$_POST['details']);
	// See if that product name is an identical match to another product in the system
	$sql = mysqli_query($link,"SELECT id FROM products WHERE product_name='$product_name' LIMIT 1");
	$productMatch = mysqli_num_rows($sql); // count the output amount
    if ($productMatch > 0) {
		echo 'Sorry you tried to place a duplicate "Product Name" into the system, <a href="inventory_list.php">click here</a>';
		exit();
	}
	// Add this product into the database now
	$sql = mysqli_query($link,"INSERT INTO products (product_name, price, details, category, subcategory, date_added) 
        VALUES('$product_name','$price','$details','$category','$subcategory',now())") or die (mysqli_error());
     $pid = mysqli_insert_id();
	// Place image in the folder 
	$newname = "$pid.jpg";
	move_uploaded_file( $_FILES['fileField']['tmp_name'], "../inventory_images/$newname");
	header("location: inventory_list.php"); 
    exit();
}
?>
<?php 
// This block grabs the whole list for viewing
$product_list = "";
$sql = mysqli_query($link,"SELECT * FROM products ORDER BY date_added DESC");
$productCount = mysqli_num_rows($sql); // count the output amount
if ($productCount > 0) {
	while($row = mysqli_fetch_array($sql)){ 
             $id = $row["id"];
			 $product_name = $row["product_name"];
			 $price = $row["price"];
			 $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
			 $product_list .= "Product ID: $id - <strong>$product_name</strong> - $$price - <em>Added $date_added</em> &nbsp; &nbsp; &nbsp; <a href='inventory_edit.php?pid=$id'class='btn btn-primary btn-sm'>edit</a> &bull; <a href='inventory_list.php?deleteid=$id' class='btn btn-danger btn-sm'>delete</a><br /><br />";
    }
} else {
	$product_list = "You have no products listed in your store yet";
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<title>Inventory List</title>
<!--<link rel="stylesheet" href="../style/style.css" type="text/css" media="screen" />-->
 <link href="../style/bootstrap.min.css" rel="stylesheet">

 <link href="../style/my.css" rel="stylesheet">
</head>

<body>
<div class="container-fluid ">

<!--<div align="center" id="mainWrapper">  -->
  <div class="row panel panel-default">
  <?php include_once("template_header.php");?>
  <div id="pageContent"><br />
    <div align="right" style="margin-right:32px;"><a href="inventory_list.php#inventoryForm">+ Add New Product</a></div>
<div align="left" >
    <div class="row">
    <div class="col-sm-7 col-sm-offset-1">
      <h2>Product List</h2>
      <?php echo $product_list; ?>
      </div>
      </div>
    </div>
    <hr />
    <a name="inventoryForm" id="inventoryForm"></a>
    <h3 class="col-sm-offset-3">
    Add New Product Form
    </h3></br>
    <div class="row">
    <div class="col-sm-7 col-sm-offset-3">

    <form action="inventory_list.php" enctype="multipart/form-data" name="myForm" id="myform" method="post">



        <label>   Product Name
          <input class="form-control" name="product_name" type="text" id="product_name" />
        </label>  </br> </br>


        <label>  Product Price  $

          <input class="form-control" name="price" type="text" id="price"/>
        </label>
        </br> </br>
        <label>Category
          <select class="form-control" name="category" id="category">

          <option value="Clothing">Clothing</option>
          <option value="Toys">Toys</option>
          <option value="Electronics">Electronics</option>
          <option value="Sporting Goods">Sporting Goods</option>
          </select>
        </label>
        </br>   </br>
        <label>Subcategory
        <select  name="subcategory" id="subcategory" class="form-control">

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
          <textarea class="form-control" name="details" id="details"></textarea>
        </label>
        </br>   </br>
        <label>Product Image
          <input type="file" class="form-control" name="fileField" id="fileField" />
        </label>

        </br> </br>
        &nbsp;
        <label>
          <input type="submit" name="button" id="button" value="Add This Item Now" class="btn btn-primary" />
        </label>

    </form>
    </div>

    <br />
  <br />
  </div>
  <?php include_once("template_footer.php");?>
</div>
</div>
</div>
 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>