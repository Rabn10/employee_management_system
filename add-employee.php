<?php include('partials/menu.php') ?>
<?php include('partials/session-error.php') ?>

<?php


if (isset($_POST['submit'])) {
	// echo "button clicked";

	//Get the data from form
	$name = $_POST['name'];
	$email = $_POST['email'];
	$position = $_POST['position'];
	$age = $_POST['age'];
	$gender = $_POST['gender'];

	//check whether the image is slected or not
	// print_r($_FILES['image']);

	// die();//break the code here

	if (isset($_FILES['image']['name'])) {
		//upload the image
		//to upload image we need image name,source path and destination path
		$image_name = $_FILES['image']['name'];

		//Auto rename our image
		//get the extension of our image(jpg,png,jpge)
		$ext = end(explode('.', $image_name));

		//Rename the image
		$image_name = "employee".rand(0000,9999).'.'.$ext;

		$soruce_path = $_FILES['image']['tmp_name'];
		$destination_path = "./images/".$image_name;

		//upload the image
		$upload = move_uploaded_file($soruce_path,$destination_path );
		//check whether the image is upload or not 
		//and if the image is not uploaded then we will stop the process and redirecrt with error message
		if ($upload==false) {
			//set message
			$_SESSION['upload'] = "<div class='error '>Falied to upload image</div>";
			//redirect to add employee page
			header('location: '.'add-employee.php');
			//stop the process
			die();
		}
	}
	else {
		//don't upload image and set the image name value as blank
		$image_name = "";
	}


	//sql query to insert data into database
	$sql = "INSERT INTO tbl_employee SET
		name = '$name',
		email = '$email',
		position = '$position',
		image = '$image_name',
		age = '$age',
		gender = '$gender'
	";

	//executing query and saving data into database
	$res = mysqli_query($connection,$sql) or die(mysqli_error());

	//check whether the query is executed or not
	if ($res==TRUE) {

		$_SESSION['add'] = "<div class='sucess'>Data inserted successfully</div>";

		header("location:".'employee.php');
		// echo "Data insert sucessfully";
	}
	else{

		$_SESSION['add'] = "<div class='error'>Failed to insert data</div>";

		header("location:".'employee.php');
		// echo "falied to insert data";
	}
}

 ?> 


<div class="main-content">
	<div class="wrapper">
		<h1>Add Employee</h1>

		<?php

			if (isset($_SESSION['upload'])) {
				echo $_SESSION['upload'];
				unset($_SESSION['upload']);
			}

		 ?>

		<br><br>

		<form action="" method="POST" enctype="multipart/form-data">
			<table class="tbl-40">
				<tr>
					<td>Name: </td>
					<td>
						<input type="text" name="name" placeholder="Enter name">
						<?php
							if (isset($err['name'])) { ?>
							 	<span class='error'><?php echo $err['name']; ?></span>
						<?php   } ?>
					</td>
				</tr>
				<tr>
					<td>Email: </td>
					<td>
						<input type="email" name="email" placeholder="Enter email">
						<?php
							if (isset($err['email'])) { ?>
							 	<span class='error'><?php echo $err['email']; ?></span>
						<?php   } ?>
					</td>
				</tr>
				<tr>
					<td>Position: </td>
					<td>
						<input type="text" name="position" placeholder="Enter name">
						<?php
							if (isset($err['position'])) { ?>
							 	<span class='error'><?php echo $err['position']; ?></span>
						<?php   } ?>
					</td>
				</tr>
				<tr>
					<td>Image: </td>
					<td>
						<input type="file" name="image">
					</td>
				</tr>
				<tr>
					<td>Age: </td>
					<td>
						<input type="number" name="age" placeholder="Enter age">
						<?php
							if (isset($err['age'])) { ?>
							 	<span class='error'><?php echo $err['age']; ?></span>
						<?php   } ?>
					</td>
				</tr>
				<tr>
					<td>Gender: </td>
					<td>
						<input type="radio" name="gender" value="Male" checked="">Male
						<input type="radio" name="gender" value="Female">Female
					</td>
				</tr>

				<tr>
					<td colspan="2">
						<input type="submit" name="submit" value="Add Employee" class="btn-secondary">
					</td>

				</tr>
			</table>
		</form>

	</div>
</div>
</body>
</html>


