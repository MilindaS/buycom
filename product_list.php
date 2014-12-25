<?php

// Script Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', '0');
?>
<?php
// Display new 3 items
// Connect to the db
include "storescripts/connect_to_mysql.php";
$dynamicList = "";
$sql = mysqli_query($link,"SELECT * FROM products ORDER BY date_added DESC");
$productCount = mysqli_num_rows($sql); // count the output amount
if ($productCount > 0) {
	while($row = mysqli_fetch_array($sql)){
             $id = $row["id"];
			 $product_name = $row["product_name"];
			 $price = $row["price"];
			 $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
			 $dynamicList .= '<div class="col-lg-3"><table>

        <tr>
          <td width="17%" valign="top"><a href="product.php?id=' . $id . '"><div class="well" ><img " class="thumbnail" src="inventory_images/' . $id . '.jpg" alt="' . $product_name . '" width="250" height="160" border="1" /></a>
          <div class="caption"><h3>' . $product_name . '</h3>
           <h5> $' . $price . '</h5><br />
            <a href="product.php?id=' . $id . '" class="btn btn-primary">View Product Details</a></td>
            </div>  </div>
        </tr>

      </table></div>';
    }
} else {
	$dynamicList = "We have no products listed in our store yet";
}
mysqli_close($link);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<title>All Items</title>
<!--<link rel="stylesheet" href="style/style.css" type="text/css" media="screen" />-->
 <link href="style/bootstrap.min.css" rel="stylesheet">

 <link href="style/my.css" rel="stylesheet">
</head>
<body>
<div class="container-fluid">
  <div align="center" id="mainWrapper">
    <?php include_once("template_header.php");?>
    <div class="panel panel-default">
    <table>
    <tr>

      <td><h3 style="margin-left:7px; ">All Item's</h3>
        <p><?php echo $dynamicList; ?><br />
          </p>
        <p><br />
        </p></td>

    </tr>
  </table>

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