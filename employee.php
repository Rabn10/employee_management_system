<?php include('partials/session-error.php') ?>
<?php include('partials/menu.php') ?>
<div class="main-content">
	<div class="wrapper-emp">
		<h1>Manage Employee</h1>

		<br><br>

		<?php

			if (isset($_SESSION['add'])) {
				echo $_SESSION['add'];
				unset($_SESSION['add']);
			}

			if (isset($_SESSION['delete'])) {
					echo $_SESSION['delete'];
					unset($_SESSION['delete']);
			}

			if (isset($_SESSION['update'])) {
					echo $_SESSION['update'];
					unset($_SESSION['update']);
			}

		 ?>

		 <br><br><br>

		<a href="add-employee.php" class="btn-primary">Add Employee</a>
		<a href="landingpage.php" class="btn-back">Back</a>
		<br><br>

		<table class="tbl-full">
			<tr>
				<th>S.N.</th>
				<th>Name</th>
				<th>Email</th>
				<th>Position</th>
				<th>Image</th>
				<th>Age</th>
				<th>Gender</th>
				<th>Action</th>
			</tr>

			<?php

			//sql query to select data
			$sql = "SELECT * FROM tbl_employee";

			//Execute the query
			$res = mysqli_query($connection,$sql);

			//check whether the query is executed or not
			if ($res==TRUE) {
				//count rows to check whether we have data in database or not
				$count = mysqli_num_rows($res);//function to get all the rows in database

				//check the num of rows
				if($count>0) {
					//we have data in our databasse
					$sn = 1;//create a varable and assign the value

					while($rows=mysqli_fetch_assoc($res)) {
						//using while loop to get all the data in databse 
								//And while loop will run as long as data in database
						$id = $rows['id'];
						$name = $rows['name'];
						$email = $rows['email'];
						$position = $rows['position'];
						$image_name = $rows['image'];
						$age = $rows['age'];
						$gender = $rows['gender'];

						//Display data in table
						?>
						<tr>
							<td><?php echo $sn++; ?></td>
							<td><?php echo $name; ?></td>
							<td><?php echo $email; ?></td>
							<td><?php echo $position; ?></td>

							<td>
								<?php

									//check whether image name is avaialble or not
								if ($image_name !="") {
									?>

									<img src="images/<?php echo $image_name; ?>" width="100px" >

									<?php
								}
								else {
									echo "<div class='error'>image not added</div>";
								}

								 ?>
									
								</td>

							

							<td><?php echo $age; ?></td>
							<td><?php echo $gender; ?></td>
							<td>
								<a href="update.php?id=<?php echo $id; ?>" class="btn-secondary">Edit Employee</a>
								<a href="delete.php?id=<?php echo $id; ?>" class="btn-danger">Delete Employee</a>
							</td>
						</tr>

						<?php 
					}  
				}
			}

			 ?>

			
			
		</table>

		<!-- <form>
			<table></table>				
		</form> -->

	</div>
</div>


</body>
</html>