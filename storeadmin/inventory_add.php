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
<div class="container-fluid">
  
  <?php include_once("template_header.php");?>






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

</div>


</body>
</html>