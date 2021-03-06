<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
if (!isset($_SESSION["manager"])) {
    header("location: admin_login.php"); 
    exit();
}

include "../storescripts/connect_to_mysql.php"; 


if (isset($_GET['deleteid'])) {
	
	$id = $_GET['deleteid'];
	$sql = mysqli_query($link,"DELETE FROM user WHERE id='$id'") or die (mysqli_error());
	
	header("location: user_list.php"); 
    
}


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
		      <a href="user_add.php" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-plus"></span> Add New User</a>
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
						<th>Created Date</th>
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
								<td><?php echo $date_created;?></td>
								
								<td>
									<a href='user_edit.php?uid=<?php echo $id;?>'class='btn btn-primary btn-sm'>Edit</a> 
									&bull; 
									<a onclick="confirmDel(<?php echo $id;?>);" class='btn btn-danger btn-sm'>Delete</a>
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
    <!--<script src="js/bootstrap.min.js"></script>-->
</html>


<script>
	function confirmDel(e){
		if(confirm("Are you sure want to delete this user")){
			window.location.href = 'user_list.php?deleteid='+e;
		}
	}
</script>