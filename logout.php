<?php
include ('../config.php');

unset($_SESSION['id']);
echo "<script language=javascript>alert('LOG OUT');
			window.location='index.php';</script>";
?>