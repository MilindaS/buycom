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

<body style="background:#fff;">
<?php include_once("template_header.php");?>
<div class="container" style="background:#fff;width:65%">

  
  

<div class="row">
    <div class="col-md-12">
      <a href="inventory_list.php" class="btn btn-success pull-right">Go Back</a>
    </div>
  </div>




<h3 class="col-sm-offset-3">
    Add New Product Form
    </h3></br>
    <div class="row">
<div class="col-md-12">
<form action="inventory_list.php" enctype="multipart/form-data" name="myForm" id="myform" method="post">

<div class="form-group">
      <label for="product_name" class="col-sm-2 control-label">Product Name</label>
      <div class="col-sm-10">
        <input class="form-control" name="product_name" type="text" id="product_name" />
      </div>
    </div>
<br /><br /><br />

       <div class="form-group">
      <label for="product_name" class="col-sm-2 control-label">Product Price  $</label>
      <div class="col-sm-10">
        <input class="form-control" name="price" type="text" id="price"/>
      </div>
    </div>
<br /><br />


<div class="form-group">
      <label for="product_name" class="col-sm-2 control-label">Category</label>
      <div class="col-sm-10">
        <select class="form-control" name="category" id="category">

          <option value="Clothing">Clothing</option>
          <option value="Toys">Toys</option>
          <option value="Electronics">Electronics</option>
          <option value="Sporting Goods">Sporting Goods</option>
          </select>
      </div>
    </div>
<br /><br />
<div class="form-group">
      <label for="product_name" class="col-sm-2 control-label">Subcategory</label>
      <div class="col-sm-10">
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
      </div>
    </div>
<br /><br />
<div class="form-group">
      <label for="product_name" class="col-sm-2 control-label">Product Details</label>
      <div class="col-sm-10">
        <textarea class="form-control" name="details" id="details"></textarea>
      </div>
    </div>
        <br /><br /><br />  
          <div class="form-group">
      <label for="product_name" class="col-sm-2 control-label">Product Image</label>
      <div class="col-sm-10">
        <input type="file" class="form-control" name="fileField" id="fileField" />
      </div>
    </div>
<br /><br />
  <div class="form-group">
    <div class="col-md-10 col-md-offset-2">
          <input type="submit" name="button" id="button" value="Add Item" class="btn btn-primary" />
     </div></div>
<br /><br />
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

</div>


</body>
</html>