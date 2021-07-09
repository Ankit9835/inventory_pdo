<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$db_name = "vectus";
	$conn = mysqli_connect($servername,$username,$password,$db_name);
	if(!$conn){
		die("Connection Not Created" .mysqli_connect_error);
	}
?>