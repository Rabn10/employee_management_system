<?php

	include('partials/config.php');

	//get the a of employee
	$id = $_GET['id'];

	//sql query to delete data
	$sql = "DELETE FROM tbl_employee WHERE id = $id";

	//execute the query
	$res = mysqli_query($connection,$sql);

	//check whether the query is execute or not
		if ($res==TRUE) {
			//query executed sucessfully and data deleted.
			// echo "Data deleted sucessfully";
			//create session variable to display message
			$_SESSION['delete'] = "<div class='sucess'>data deleted successfully</div>";
		//redirected to manage admin page
		header('location:'.'employee.php');
		}

		else{
		//fail to delte admin
		//echo "falied to deteled admin";
		//create session variable to display message
		$_SESSION['delete'] = "<div class='error'>failed to delete data</div>";
		//redirected to manage admin page
		header('location:'.'employee.php');
	}

	//https://www.tutorialrepublic.com/php-tutorial/php-mysql-crud-application.php#:~:text=What%20is%20CRUD,delete%20operations%20in%20previous%20chapters.
 ?>

