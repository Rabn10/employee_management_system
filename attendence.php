<?php include('partials/menu.php') ?>
<?php include('partials/session-error.php') ?>
<div class="main-content">
	<div class="wrapper">
		<h1>General Attendence(<?php echo $todaysDate = date("m-d-Y"); ?>)</h1>
		<a href="landingpage.php" class="btn-back">Back</a>
		<br><br>

		<!-- <?php
			// if (isset($_SESSION['attendence'])) {
			// 	echo $_SESSION['attendence'];
			// 	unset($_SESSION['attendence']);
			// }

			// if (isset($_SESSION['delete'])) {
			// 	echo $_SESSION['delete'];
			// 	unset($_SESSION['delete']);
			// }

		 ?> -->

		 <?php
		 	if (isset($_SESSION['add'])) {
				echo $_SESSION['add'];
				unset($_SESSION['add']);
			}

			

		  ?>

		 <br><br>

		<!-- <a href="new-attendence.php" class="btn-primary">Insert employee</a> -->
		
		<br><br>

		<form  method="POST">
		<table class="tbl-full">
			<tr>
				<th>S.N.</th>
				<th>Emp_Name</th>
				<th>Position</th>
				<th>Checked</th>
			</tr>

			<?php

			//sql query to select data
			// $sql = "SELECT *FROM tbl_attandence";
			$sql = "SELECT id,name,position FROM tbl_employee";
			// $sql = "SELECT te.id,te.name,te.position FROM tbl_attandence at,tbl_employee te WHERE at.emp_id=te.id";

			//Execute the query
			$res = mysqli_query($connection,$sql);

			//check whether the query is executed or not
			if ($res==TRUE) {
				//Count rows to check whether we have data in database or not
				$count = mysqli_num_rows($res);

				//check the num of rows
				if($count>0) {
					//we have data in out database
					$sn = 1;//create a varaiable  and assign the value

					while($rows=mysqli_fetch_assoc($res)) {
						$emp_id = $rows['id'];
						$emp_name = $rows['name'];
						$position = $rows['position'];
						// $date = $rows['Date']

						?>

						<tr>
							<td><?php echo $sn++; ?></td>
							<td><?php echo $emp_name; ?></td>
							<td><?php echo $position ?></td>
							<td>
								<input type="checkbox" name="status[]" value="<?php echo $emp_id; ?>">
							</td>
						</tr>

						<?php 

					}


				}
			}

			 ?>

			
		</table>
		<br><br>
		<input type="submit" id="btn" name="submit" value="Take Attendence" class="btn-primary" style="margin-left: 68rem">
		</form>
	</div>
</div>
</body>
</html>
<!-- <script>
	const btn = document.querySelector('#btn');
	btn.addEventListener('click',(event) => {
		let checkboxes = document.querySelectorAll('input[name="data[]"]:checked');
		// debugger;	
		let values = [];
		checkboxes.forEach((checkbox)=>{
			values.push(checkbox.value);
		});
		alert(values);
	});


</script> -->

<?php
if (isset($_POST['submit'])) {
	// print_r($_POST);exit;
	$emp_list = $_POST['status'];
	$created_at = date('Y-m-d H:i:s');
	 // $chk = "";
	 $i=0;
	 while ($i<count($emp_list)) {
	 	$sql2 = "INSERT INTO tbl_attandence SET
			emp_id = $emp_list[$i],
			value = 1,
			Created_at = '$created_at'	
	";

	$res2 = mysqli_query($connection,$sql2);
	$i++;
	 }

	if ($res2==TRUE) {
		$_SESSION['add'] = "<div class='sucess'>Attendence taken sucessfully</div>";
		header('location:'.'attendence.php');
	}
	else {
		$_SESSION['add'] = "<div class='error'>Falied to take attendence</div>";
		header('location:'.'attendence.php');
	}

	 // foreach ($status as $chk1) {
	 // 	$chk .= $chk1;
	 // }
	 // $in_ch = mysqli_query($connection,"INSERT INTO tbl_attandence(value,Created_at) VALUES('$chk','$created_at')");
	 // if($in_ch==1) {
	 // 	echo "Insert successfully";
	 // }
	 // else
	 // {
	 // 	echo "falied to insert data";
	 // }
}

	


 ?>



<!-- https://laracasts.com/series/laravel-8-from-scratch -->