<?php
if (isset($_POST['date'])) {
	$connect = mysqli_connect('localhost','root','','employee');
	$output = '';
	$query = "SELECT te.id,te.name,at.value,at.created_at FROM tbl_attandence at,tbl_employee te WHERE created_at ='".$_POST['date']."'AND at.emp_id=te.id
	";
	$result = mysqli_query($connect,$query);
	$output .= '
		<table class="tbl-full">
			<tr>
				<th>S.N.</th>
				<th>Name</th>
				<th>Status</th>
				<th>Date</th>
			</tr>
	';
	if (mysqli_num_rows($result)>0) {
		while($row = mysqli_fetch_array($result))
		{

			$output .= '
				<tr>
				 				<td>'.$row['id'].'</td>
				 				<td>'.$row['name'].'</td>
				 				<td>'.$row['value'].'</td>
				 				<td>'.$row['created_at'].'</td>
				 			</tr>
			';
		}
	}
	else {
		$output .= '
			<tr>
		        <td colspan = "4">No attendance Found</td>
		      </tr> 
		';
	}
	$output .= '</table>';
	echo $output;

}


 ?>