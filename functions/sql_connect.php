<?php
	$server_address = "den1.mysql2.gear.host"; 
	$username = "unwind";
	$password = "Gb6H8udjsi-?";
	$database_name = "unwind";
	$port = "3306";

	$mysqli = new mysqli($server_address, $username, $password, $database_name, $port);
	
	//check connection
	if (!$mysqli) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
	
?>
