<?php



$db_host = "localhost"; 
// Place the username for the MySQL database here 
$db_username = "root";
// Place the password for the MySQL database here 
$db_pass = "password";
// Place the name for the MySQL database here 
$db_name = "buycom";

// Run the actual connection here  
$link = mysqli_connect("$db_host","$db_username","$db_pass") or die ("could not connect to mysql");
mysqli_select_db($link,"$db_name") or die ("no database");              
?>