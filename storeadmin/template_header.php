<div class="row">
<nav class="navbar navbar-default">
    <div class="navbar-header">
		<button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".js-navbar-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="#"><img src="../style/logo.png" alt="Logo" width="220" height="25" border="0" /></a>
	</div>


	<div class="collapse navbar-collapse js-navbar-collapse">
		<ul class="nav navbar-nav">
            <li> <a href="index.php">Home</a></li>
            <li><a href="inventory_list.php">Manage Stock</a></li>
            <?php if(isset($_SESSION["id"])){
			if($_SESSION["id"]==12){
           ?>
				<li><a href="user_list.php">Manage Users</a></li>
			<?php
			}
			}
			?>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li ><a href="logout.php" > Logout</a></li>
		</ul>

	</div><!-- /.nav-collapse -->
</nav>
</div>









