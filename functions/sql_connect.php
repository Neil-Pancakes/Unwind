<?php
	$server_address = "localhost"; 
	$username = "root";
	$password = "";
	$database_name = "unwind_db";

	$mysqli = new mysqli($server_address, $username, $password, $database_name);
	
	//check connection
	if (!$mysqli) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
	
?>
