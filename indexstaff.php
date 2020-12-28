<?php 
include('../config.php');

if (!$_SESSION['staff_id'])
{
	header ('Location:index.php');
}

$sql_staff = "SELECT * FROM staff WHERE staff_id = '".$_SESSION['staff_id']."'";
if($result_staff = mysqli_query($conn, $sql_staff))
{	
	$rows_staff = $result_staff->fetch_array();
}
?>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Staff</title>

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
               <a class="navbar-brand" href="admin.php"><b><?php echo $rows_staff['staff_name']; ?>.</b></a>
			  
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
                            <a href="mailstaff.php"><i class="fa fa-envelope-o"></i> Mail</a>
                        </li>
						<li>
                              <a href="indexstaff.php"><i class="fa fa-send fa-fw"></i>Add Mail</a>
                        </li>
						<li>
                              <a href="customerstaff.php"><i class="fa fa-user fa-fw"></i>Customer</a>
                        </li>			                     
						 <li>
                            <a href="add_custstaff.php"><i class="fa fa-edit fa-fw"></i>Add Customer</a>
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

		 <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
    <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Add New Mail</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
		
				<?php
if(isset($_POST['add']))
{
	
	$sql_add = "INSERT INTO storage (cust_company, cust_date, cust_time, cust_track, mail, phone) VALUES
	('".$_POST['company']."','".$_POST['date']."','".$_POST['time']."', '".$_POST['track']."', '".$_POST['mail']."', '".$_POST['phone']."')";
	if($result_add = mysqli_query($conn, $sql_add))
	{ 
			

     //We create our own function to submit our link
     //Certain hosts do not support the usage of "fopen"
     function ismscURL($link){

      $http = curl_init($link);

      curl_setopt($http, CURLOPT_RETURNTRANSFER, TRUE);
      $http_result = curl_exec($http);
      $http_status = curl_getinfo($http, CURLINFO_HTTP_CODE);
      curl_close($http);

      return $http_result;
     }

 

      $destination = urlencode($_POST["phone"]);
      $message = $_POST['date']. $_POST['time'].$_POST['company']."Anda telah menerima surat";
      $message = html_entity_decode($message, ENT_QUOTES, 'utf-8'); 
      $message = urlencode($message);
      
      $username = urlencode("afiqsalehin");
      $password = urlencode("afiqsalehin1234");
      $sender_id = urlencode("66300");
      $type = 1;

      $fp = "http://www.isms.com.my/isms_send.php";
      $fp .= "?un=$username&pwd=$password&dstno=$destination&msg=$message&type=$type&sendid=$sender_id";
      //echo $fp;
      
      $result = ismscURL($fp);
		echo "<script language=javascript>alert('SUCCESS');
		window.location='mailstaff.php';</script>";
	}
	else
	{
		echo "FAILED";
	}
}
?>
<?php
$sql_storage = "SELECT * FROM customer";
$result = mysqli_query($conn, $sql_storage);
?>


<h3><h3/>
<form name="add-form" method="post" enctype="multipart/form-data">
	 <div class="form-group">
	 <label>Company</label><br>
    <select name="company">
		<?php while($row1 = mysqli_fetch_array($result)):; ?>
		<option value= "<?php echo $row1[5];?>"><?php echo $row1[5];?></option>
		<?php endwhile; ?>
	</select>
     </div>
	 <div class="form-group">
     <label>Date</label>
     <input type="date" class="form-control" name="date">       
     </div>
	  <div class="form-group">
     <label>Time</label>
      <input type="time" class="form-control" name="time"> 
     </div>
	  <div class="form-group">
     <label>Tracking Number</label>
     <input class="form-control" name="track">
     </div>
	 <div class="form-group">
	   <label>Mail</label>
     <input class="form-control" name="mail">
     </div>
	 <div class="form-group">
	   <label>Phone</label>
     <input type="tel" class="form-control" name="phone">  
     </div>
    
	<input type="submit" name="add" value="Add"/>
</form>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
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

    <!-- Morris Charts JavaScript -->
    <script src="../vendor/raphael/raphael.min.js"></script>
    <script src="../vendor/morrisjs/morris.min.js"></script>
    <script src="../data/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
