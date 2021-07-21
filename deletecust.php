<?php
include ('../config.php');

	$sql_delete= "DELETE FROM customer WHERE cust_id = '".$_GET['cust_id']."'";
	if ($result_delete = mysqli_query($conn, $sql_delete))
	{
		echo "<script language=javascript>alert('DELETE SUCCESS');
		window.location='customer.php';</script>";	
	}
	else
	{
		echo "FAILED";
	}
?>
