	<?php
include ('../config.php');

	$sql_delete= "DELETE FROM storage WHERE storage_id = '".$_GET['storage_id']."'";
	if ($result_delete = mysqli_query($conn, $sql_delete))
	{
		echo "<script language=javascript>alert('DELETE SUCCESS');
		window.location='mailstaff.php';</script>";
	}
	else
	{
		echo "FAILED";
	}
?>