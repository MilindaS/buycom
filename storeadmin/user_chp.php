<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
if (!isset($_SESSION["manager"])) {
    header("location: admin_login.php"); 
    exit();
}

include "../storescripts/connect_to_mysql.php"; 
if(isset($_GET['uid'])){
 $id = $_GET['uid'];
}
if (isset($_POST['useradd'])) {
  $error = [];
  
  $password = mysqli_real_escape_string($link,$_POST['password']);
  $repassword = mysqli_real_escape_string($link,$_POST['repassword']);

  if($password==""){
    array_push($error, "Password cannot be empty !");
  }

  if($password!=$repassword){
    array_push($error, "Password did not match !");
  }
  
 

  if(empty($error)){
    $password = md5($password);
    $sql = mysqli_query($link,"UPDATE user SET password = '$password' where id = '$id'") or die (mysqli_error($link));
        header('Location:user_list.php');  
  }
}
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<title>User Add</title>
<!--<link rel="stylesheet" href="../style/style.css" type="text/css" media="screen" />-->
 <link href="../style/bootstrap.min.css" rel="stylesheet">

 <link href="../style/my.css" rel="stylesheet">
</head>

<body style="background:#fff;">
<?php include_once("template_header.php");?>
<div class="container" style="background:#fff;width:65%">

  
  

<div class="row">
    <div class="col-md-12">
      <a href="user_list.php" class="btn btn-success pull-right">Go Back</a>
    </div>
  </div>




<h3 class="col-sm-offset-3">
    Change Password
    </h3></br>
    <div class="row">
<div class="col-md-12">
<form action="" enctype="multipart/form-data" name="myForm" id="myform" method="post">



<div class="form-group">
      <label for="password" class="col-sm-2 control-label">Password</label>
      <div class="col-sm-10">
         <input class="form-control" name="password" type="password" id="password" />
      </div>
    </div>
    <br /><br />
    <div class="form-group">
      <label for="repassword" class="col-sm-2 control-label">Re Password</label>
      <div class="col-sm-10">
         <input class="form-control" name="repassword" type="password" id="repassword" />
      </div>
    </div>


<div class="form-group">
      <label class="col-sm-2 control-label"></label>
      <div class="col-sm-10">
         <?php
          if(!empty($error)){
            echo '<div class="alert alert-danger" role="alert"><ul>';
            foreach($error as $err){              
              echo "<li>".$err."</li>";              
            }
            echo '</ul></div>';
          }
         ?>
      </div>
    </div>
<br /><br />


  <div class="form-group">
    <div class="col-md-10 col-md-offset-2">
          <input type="submit" name="useradd" id="button" value="Save" class="btn btn-primary" />
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