<?php
	require('connection.php');
	session_start();
?>

<?php 
$_SESSION["user-id"]=null;
session_destroy();
header("location:index.php");
?>