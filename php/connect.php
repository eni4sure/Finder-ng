<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "finder";

	$connection = new mysqli($servername, $username, $password, $dbname);

	if($connection->connect_error){
		die($connection->connect_error);
	}
?>