	<?php
include ('../config.php');

	$sql_delete= "DELETE FROM staff WHERE staff_id = '".$_GET['staff_id']."'";
	if ($result_delete = mysqli_query($conn, $sql_delete))
	{
		echo "<script language=javascript>alert('DELETE SUCCESS');
		window.location='staff.php';</script>";
	}
	else
	{
		echo "FAILED";
	}
?>