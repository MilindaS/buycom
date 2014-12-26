<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
if (!isset($_SESSION["manager"])) {
    header("location: admin_login.php"); 
    exit();
}

include "../storescripts/connect_to_mysql.php"; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>User List</title>

	<link href="../style/bootstrap.min.css" rel="stylesheet">

 <link href="../style/my.css" rel="stylesheet">
</head>

<body >
	<?php include_once("template_header.php");?>

	<div class="container-fluid" >


	<div class="container">

		<div class="row">
		    <div class="col-md-12">
		      <a href="inventory_add.php" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-plus"></span> Add New User</a>
		    </div>
		</div>


	<div class="row">
		<div class="col-md-12">
		<h2>User List</h2>
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Full name</th>
						<th>Username</th>
						<th>Email</th>
						<th>Actions</th>
					</tr>
				</thead>






				<tbody>
					<?php
					$sql = mysqli_query($link,"SELECT * FROM user ORDER BY date_created DESC");
					$userCount = mysqli_num_rows($sql); // count the output amount
					        if ($userCount > 0) {
					    	    while($row = mysqli_fetch_array($sql)){ 
									$id = $row["id"];
									$username = $row["username"];
									$fullname = $row["fullname"];
					            	$email = $row["email"];
					            	$date_created = strftime("%b %d, %Y", strtotime($row["date_created"]));
					         ?>
					        <tr>
								<td><?php echo $fullname;?></td>
								<td><?php echo $username;?></td>
								<td><?php echo $email;?></td>
								<td>
									<a href='user_edit.php?pid=<?php echo $id;?>'class='btn btn-primary btn-sm'>edit</a> 
									&bull; 
									<a href='user_list.php?deleteid=<?php echo $id;?>' class='btn btn-danger btn-sm'>delete</a>
								</td>
							</tr>   
							<?php 
								}
							}else{
								"Users cannot reach";
							}
					?>
				</tbody>
			</table>
		</div>
	</div>


	</div>



	</div>



</body>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</html>