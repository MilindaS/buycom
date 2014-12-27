<?php

session_start();
if (isset($_SESSION["manager"])) {
    header("location: index.php");
    exit();
}
?>
<?php 
// Parse the log in form if the user has filled it out and pressed "Log In"
if (isset($_POST["username"]) && isset($_POST["password"])) {

	$manager = preg_replace('#[^A-Za-z0-9]#i', '', $_POST["username"]); // filter everything but numbers and letters
    $password = preg_replace('#[^A-Za-z0-9]#i', '', $_POST["password"]); // filter everything but numbers and letters
    // Connect to the MySQL database  
    include "../storescripts/connect_to_mysql.php"; 
    $password = md5($password);
    $sql = mysqli_query($link,"SELECT id FROM user WHERE username='$manager' AND password='$password' LIMIT 1"); // query the person
    // ------- MAKE SURE PERSON EXISTS IN DATABASE ---------
    //print_r($sql);

    $existCount = mysqli_num_rows($sql); // count the row nums
    if ($existCount == 1) { // evaluate the count
	     while($row = mysqli_fetch_array($sql)){ 
             $id = $row["id"];
		 }
		 $_SESSION["id"] = $id;
		 $_SESSION["manager"] = $manager;
		 $_SESSION["password"] = $password;
		 header("location: index.php");
         exit();
    } else {
		$error= 'That information is incorrect, try again <a href="index.php">Click Here</a>';
		//exit();
	}
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

<title>Admin Log In </title>
<!--<link rel="stylesheet" href="../style/style.css" type="text/css" media="screen" />-->
 <link href="../style/bootstrap.min.css" rel="stylesheet">

 <link href="../style/my.css" rel="stylesheet">
</head>

<body>
<div class="container-fluid">
     </br> </br> </br> </br> </br> </br>
    <div class="row">
		<div class="col-md-4 col-md-offset-4">
    		<div class="panel panel-default">
			  	<div class="panel-heading">
			    	<h3 class="panel-title">Administrator Login</h3>
			 	</div>
			  	<div class="panel-body">
			    	<form accept-charset="UTF-8" role="form" id="form1" name="form1" method="post" action="admin_login.php">
                    <fieldset>
			    	  	<div class="form-group">
                        <input name="username"class="form-control" placeholder="User Name" type="text" id="username" size="40" />

			    		</div>
			    		<div class="form-group">
                            <input name="password" class="form-control" placeholder="Password" type="password" id="password" size="40" />

			    		</div>
<div class="form-group">
			    		<input class="btn btn-lg btn-success btn-block" type="submit" value="Login"  style="font-weight: bold">
                       </div>

                            <?php if(isset($error)){
                                if($error!=null){
                                    echo '<div class="alert alert-danger" role="alert">';
                                    echo $error;
                                    echo ' </div>';
                                }
                                }?>

                       
			    	</fieldset>
			      	</form>
                    <p>&nbsp; </p>
                    <a href="../index.php" class="btn btn-default">Go Back To Home</a>
			    </div>
			</div>
		</div>
	</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  <?php include_once("../template_footer.php");?>
</div>
 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    
</body>
</html>