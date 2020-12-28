<?php 
include('../config.php');

if (!$_SESSION['admin_id'])
{
	header ('Location:index.php');
}

$sql_admin = "SELECT * FROM admin WHERE admin_id = '".$_SESSION['admin_id']."'";
if($result_admin = mysqli_query($conn, $sql_admin))
{	
	$rows_admin = $result_admin->fetch_array();
}
?>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
               <a class="navbar-brand" href="admin.php"><b><?php echo $rows_admin['admin_name']; ?>.</b></a>
			  
            </div>
            <!-- /.navbar-header -->            
            <ul class="nav navbar-top-links navbar-right">
			 
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-wrench fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                      <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu"><br>
                                     <center><img src="../images/LOGO.png"/></center>           
                        <li>
                            <a href="mail.php"><i class="fa fa-envelope-o"></i> Mail</a>
                        </li>
						<li>
                              <a href="index1.php"><i class="fa fa-send fa-fw"></i>Add Mail</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-user fa-fw"></i> Members information<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="staff.php">Staff</a>
                                </li>
                                <li>
                                    <a href="customer.php">Customer</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>    
							 
                        <li>
                            <a href="forms.php"><i class="fa fa-edit fa-fw"></i>Add Staff</a>
                        </li>
						 <li>
                            <a href="add_cust.php"><i class="fa fa-edit fa-fw"></i>Add Customer</a>
                        </li>
                        <li>
                            
                  
                                   </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Update Mail</h1>
						<?php
$sql_view = "SELECT * FROM storage WHERE storage_id ='".$_GET['storage_id']."'";
if ($result_view = mysqli_query($conn, $sql_view))
{
	$rows_view = $result_view->fetch_array();
}

if(isset($_POST['edit']))
{
	
	$sql_edit = "UPDATE storage SET mail = 
	'".$_POST['mail']."', cust_company = '".$_POST['company']."', cust_date = '".$_POST['date']."', cust_time = '".$_POST['time']."', cust_track = '".$_POST['track']."', phone = '".$_POST['phone']."'
	WHERE storage_id = '".$_GET['storage_id']."'";
	if($result_edit = mysqli_query($conn, $sql_edit))
	{
		echo "<script language=javascript>alert('UPDATED');
		window.location='mail.php';</script>";
	}
	else
	{
		echo" FAILED ";
	}
}
?>
<h3><h3/>
<form name="add-form" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Mail</label>
		<input class="form-control" name="mail" value="<?php echo $rows_view['mail'];?>">       
    </div>
	
	<div class="form-group">
		<label>Company</label>
		<input class="form-control" name="company" value="<?php echo $rows_view['cust_company'];?>">       
    </div>
	
	<div class="form-group">
		<label>Date</label>
		<input class="form-control" name="date" value="<?php echo $rows_view['cust_date'];?>">       
     </div>
	 
	<div class="form-group">
		<label>Time</label>
		<input class="form-control" name="time" value="<?php echo $rows_view['cust_time'];?>">       
     </div>
	 <div class="form-group">
		<label>Track Number</label>
		<input class="form-control" name="track" value="<?php echo $rows_view['cust_track'];?>">       
     </div>
	 <div class="form-group">
		<label>Phone Number</label>
		<input class="form-control" name="phone" value="<?php echo $rows_view['phone'];?>">       
     </div>
<input type="submit" name="edit" value="Update"/>
</form>
						
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
				
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>