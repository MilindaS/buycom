<?php
session_start();
unset($_SESSION["manager"]);

session_destroy();

header("location:../index.php");

?>