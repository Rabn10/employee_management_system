<?php include('partials/menu.php') ?>
<?php include('partials/session-error.php') ?>


<div class="main-content">
	<div class="wrapper">
		<h1>Update Employee</h1>

		<br><br>

		<?php

			//check whether id is set or not
			if (isset($_GET['id'])) {
				//get all the details
				$id = $_GET['id'];

				//sql query to get selected food
				$sql = "SELECT * FROM tbl_employee WHERE id=$id";

				//Execute the query
				$res = mysqli_query($connection,$sql);

				//count the rows to check whether the id is valid or not
				$count = mysqli_num_rows($res);

				if ($count==1) {
				 	//Get all the data
				 	$row = mysqli_fetch_assoc($res);
				 	$name = $row['name'];
				 	$email = $row['email'];
				 	$position = $row['position'];
				 	$age = $row['age'];
				 	$gender = $row['gender'];
				 }
				 else {
				 	$_SESSION['no-employee-found'] = "<div class='error'>Data not found</div>";
				 	header('location:'.'employee.php');
				 } 
			}
			else {
				header('location:'.'employee.php');
			}
		 ?>

		<form action="" method="POST">
			<table class="tbl-30">
				<tr>
					<td>Name: </td>
					<td>
						<input type="text" name="name" placeholder="Enter name" value="<?php echo $name; ?>">
					</td>
				</tr>
				<tr>
					<td>Email: </td>
					<td>
						<input type="email" name="email" placeholder="Enter email" value="<?php echo $email; ?>">
					</td>
				</tr>
				<tr>
					<td>Position: </td>
					<td>
						<input type="text" name="position" placeholder="Enter name" value="<?php echo $position; ?>">
					</td>
				</tr>
				<tr>
					<td>Age: </td>
					<td>
						<input type="number" name="age" placeholder="Enter age" value="<?php echo $age; ?>">
					</td>
				</tr>
				<tr>
					<td>Gender: </td>
					<td>
						<input <?php if ($gender == "Male"){echo "checked";} ?> type="radio" name="gender" value="Male">Male
						<input <?php if ($gender == "Female"){echo "checked";} ?> type="radio" name="gender" value="Female">Female
					</td>
				</tr>

				<tr>
					<td colspan="2">
						<input type="submit" name="submit" value="Update Employee" class="btn-secondary">
					</td>

				</tr>
			</table>
		</form>

	</div>
</div>
</body>
</html>


<?php


if (isset($_POST['submit'])) {
	// echo "button clicked";

	//Get the data from form
	$name = $_POST['name'];
	$email = $_POST['email'];
	$position = $_POST['position'];
	$age = $_POST['age'];
	$gender = $_POST['gender'];


	//sql query to insert data into database
	$sql2 = "UPDATE tbl_employee SET
		name = '$name',
		email = '$email',
		position = '$position',
		age = '$age',
		gender = '$gender'
		WHERE id = $id;
	";

	//executing query and saving data into database
	$res2 = mysqli_query($connection,$sql2);

	//check whether the query is executed or not
	if ($res2==TRUE) {

		$_SESSION['update'] = "<div class='sucess'>Data updated successfully</div>";

		header("location:".'employee.php');
		// echo "Data insert sucessfully";
	}
	else{

		$_SESSION['update'] = "<div class='error'>Failed to update data</div>";

		header("location:".'employee.php');
		// echo "falied to insert data";
	}
}

 ?>