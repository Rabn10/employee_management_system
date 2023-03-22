<?php include('partials/menu.php') ?>
<?php include('partials/session-error.php') ?>
<div class="main-content">
	<div class="wrapper">
		<h1>View Attendence</h1>
		<br><br>
		<br>
		<input type="text" name="date" id="date" placeholder="Enter date" style="height: 2rem">
		<input type="submit" name="submit" value="view Attendence" id="submit" class="btn-primary">
		<a href="landingpage.php" class="btn-back" style="margin-left: 52rem">Back</a>


		<br><br>

		<div id="order-table">
		<table class="tbl-full">
			<tr>
				<th>S.N.</th>
				<th>Name</th>
				<th>Status</th>
				<th>Date</th>
			</tr>
			<?php
				$sql = "SELECT te.id,te.name,at.value,at.created_at FROM tbl_attandence at,tbl_employee te WHERE at.emp_id=te.id";
				$res = mysqli_query($connection,$sql);
				if ($res==TRUE) {
				 	$count = mysqli_num_rows($res);
				 	if ($count>0) {
				 		$sn = 1;

				 		while ($rows = mysqli_fetch_assoc($res)) {
				 			$emp_id = $rows['id'];
				 			$emp_name = $rows['name'];
				 			$status = $rows['value'];
				 			$date = $rows['created_at']; 

				 			?>
				 			<tr>
				 				<td><?php echo $sn++; ?></td>
				 				<td><?php echo $emp_name; ?></td>
				 				<td><?php echo $status; ?></td>
				 				<td><?php echo $date; ?></td>
				 			</tr>
				 			<?php 
				 		}
				 	}
				 } 
			 ?>
		</table>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$.datepicker.setDefaults({
			dateFormat: 'yy-mm-dd'
		});
		$(function(){
			$('#date').datepicker();
		});
		$('#submit').click(function(){
			var date = $('#date').val();
			if (date !='') 
			{
				$.ajax({
					url:"filter.php",
					method:"POST",
					data:{date:date},
					success:function(data)
					{
						$('#order-table').html(data);
					}
				});
			}
			else{
				alert("please select date");
			}
		});
	});
</script>