
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
$sql = mysqli_query($link,"SELECT * FROM products ORDER BY date_added DESC LIMIT 4");
$productCount = mysqli_num_rows($sql); // count the output amount
if ($productCount > 0) {
	while($row = mysqli_fetch_array($sql)){
             $id = $row["id"];
			 $product_name = $row["product_name"];
			 $price = $row["price"];
			 $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
			 $dynamicList .= '<div class="col-lg-3"><table width="100%" border="0" cellspacing="0" cellpadding="6">

        <tr>
          <td width="17%" valign="top"><a href="product.php?id=' . $id . '"><div class="well" ><img style="border:#666 1px solid;" class="thumbnail" src="inventory_images/' . $id . '.jpg" alt="' . $product_name . '" width="250" height="160" border="1" /></a>
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

<title>BuyCom</title>
<!--<link rel="stylesheet" href="style/style.css" type="text/css" media="screen" />-->
 <link href="style/bootstrap.min.css" rel="stylesheet">

 <link href="style/my.css" rel="stylesheet">
</head>
<body>
<div class="container-fluid">
  <?php include_once("template_header.php");?>


  <div class="row">
    <div class="carousel fade-carousel slide" data-ride="carousel" data-interval="4000" id="bs-carousel">
        <!-- Overlay -->
        <div class="overlay"></div>

        <!-- Indicators -->
        <ol class="carousel-indicators">
          <li data-target="#bs-carousel" data-slide-to="0" class="active"></li>
          <li data-target="#bs-carousel" data-slide-to="1"></li>
          <li data-target="#bs-carousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
          <div class="item slides active">
            <div class="slide-1"></div>
            <div class="hero">
              <hgroup>
                  <h1>GALAXY EDGE</h1>
                  <h3>Update with tranding mobile</h3>
              </hgroup>
              <a href="product_list.php"><button class="btn btn-hero btn-lg" role="button">See all products</button></a>
            </div>
          </div>
          <div class="item slides">
            <div class="slide-2"></div>
            <div class="hero">
              <hgroup>
                  <h1>Nikon 800</h1>
                  <h3>Be Smart Be A Professional</h3>
              </hgroup>
             <a href="product_list.php"> <button class="btn btn-hero btn-lg" role="button">See all products</button></a>
            </div>
          </div>
          <div class="item slides">
            <div class="slide-3"></div>
            <div class="hero">
              <hgroup>
                  <h1>Prologic 7.1ch</h1>
                  <h3>Have a Ultra Experince With Music </h3>
              </hgroup>
              <a href="product_list.php"><button class="btn btn-hero btn-lg" role="button">See all products</button></a>
            </div>
          </div>
        </div>
      </div>

  </div>


  <div class="row">
  <table width="100%" border="0" cellspacing="0" cellpadding="10">
  <tr>

    <td width="35%" valign="top"><h3>Latest Products</h3>
      <p><?php echo $dynamicList; ?><br />
        </p>
      <p><br />
      </p></td>
   </tr>
</table>

  </div>
  <?php include_once("template_footer.php");?>
</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>