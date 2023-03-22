<?php 
 

	//session start()
	// session_start();
	//process to login with database
	$connection = new mysqli('localhost','root','','employee');
	if ($connection->connect_errno != 0) {
		die('database connection error: '.$connection->connect_error);
	}

 ?>