<?php
	$server_address = "sql12.freemysqlhosting.net"; 
	$username = "sql12208242";
	$password = "2gYimpae7m";
	$database_name = "sql12208242";
	$port = "3306";

	$mysqli = new mysqli($server_address, $username, $password, $database_name, $port);
	
	//check connection
	if (!$mysqli) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
	
?>
