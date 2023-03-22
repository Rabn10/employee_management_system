<?php

	include('partials/config.php');

	$id = $_GET['at_id'];

	//sql query to delete data
	$sql = "DELETE FROM tbl_attandence WHERE at_id = $id";

	//execute the query
	$res = mysqli_query($connection,$sql);

	//check whether the query is execute or not
	if ($res==TRUE) {
		$_SESSION['delete'] = "<div class='sucess'>data deleted sucessfully</div>";
		header('location:'.'attendence.php');
	}
	else{
		$_SESSION['delete'] = "<div class='error'>falied to delete data</div>";
		header('location:'.'attendence.php');
	}

 ?>