<?php include('partials/menu.php') ?>
<?php include('partials/session-error.php') ?>

<div class="main-content">
	<div class="wrapper">
		<h1>New Attendence</h1>

		<br><br>

		<form action="" method="POST">
			<table class="tbl-30">
				<tr>
					<td>Name: </td>
					<td>
						<select name="name">
							<?php


								//Create PHP code to display employee from database
								//1. Create sql to get all active employee from data baase
								$sql = "SELECT * FROM tbl_employee";


								//exeuting query
								$res = mysqli_query($connection,$sql);
								//count rows to check whether we have employee or not 
								$count = mysqli_num_rows($res);
								//if count is greater than 0 we have employee
								if ($count>0) {
									//we have employee
									While($row = mysqli_fetch_assoc($res)) {
											//get data
										$id = $row['id'];
										$name = $row['name'];
									?>
									<option value="<?php echo $id; ?>"><?php echo $name; ?>/<?php echo $id; ?></option>
									<?php 
									}
								}
								else{
									?>
									<option value="0">No category found</option>
									<?php  
								}

							 ?>
							<!-- <option>Rabin Awale</option>
							<option>Lisa Maharjan</option>
							<option>Nishes Shrestha</option> -->
						</select>
					</td>
				</tr>
				
				<tr>
					<td>Date: </td>
					<td>
						<input type="date" name="date">
					</td>
				</tr>
				<tr>
					<td>Value: </td>
					<td>
						<input type="radio" name="value" value="1">Present
						<input type="radio" name="value" value="0">Absent
					</td>
				</tr>
				<tr>
					<td>
						<input type="submit" name="submit" value="New Attendence" class="btn-secondary">
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
	 $name = $_POST['name'];
	 $date = $_POST['date'];
	 $value = $_POST['value'];
	 $created_at = date('Y-m-d H:i:s');

	 // sql query to insert data into database
	 $sql2 = "INSERT INTO tbl_attandence SET
	 	emp_id = '$name',
	 	Date = '$date',
	 	value = '$value',
	 	created_at = '$created_at'
	 ";

	 $res2 = mysqli_query($connection,$sql2);

	 if ($res2 == TRUE) {
	 	// echo "data insert sucessfully";
	 	$_SESSION['attendence'] = "<div class='sucess'>Attendence Done</div>";
	 	header('location:'.'attendence.php');
	 }
	 else {
	 	// echo "failed to insert data";
	 	$_SESSION['attendence'] = "<div class='error'>Falied to record attendence</div>";
	 	header('location:'.'attendence.php');
	 }
}

 ?>

