<?php 
include('../config.php');

if (!$_SESSION['id'])
{
	header ('Location:index.php');
}

$sql_admin = "SELECT * FROM admin WHERE id = '".$_SESSION['id']."'";
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
               <a class="navbar-brand" href="admin.php"><b><?php echo $rows_admin['name']; ?>.</b></a>
			  
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
						</ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

	  <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Mail</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
		
				<?php
if(isset($_POST['add']))
{
	for($i=0; $i<count($_POST['name']); $i++){
	$sql_add = "INSERT INTO customer (name, phone_no, tracking_no) VALUES
	('".$_POST['name'][$i]."','".$_POST['matrix'][$i]."','".$_POST['track'][$i]."')";
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

      $destination = urlencode($_POST["matrix"]);
      $message = $_POST['name'].$_POST['track']."Your message to customer";
      $message = html_entity_decode($message, ENT_QUOTES, 'utf-8'); 
      $message = urlencode($message);
      
      $username = urlencode("isms_usernama");
      $password = urlencode("isms_pass");
      $sender_id = urlencode("");
      $type = 1;

      $fp = "http://www.isms.com.my/isms_send.php";
      $fp .= "?un=$username&pwd=$password&dstno=$destination&msg=$message&type=$type&sendid=$sender_id";
      //echo $fp;
      
      $result = ismscURL($fp);
		echo "<script language=javascript>alert('SUCCESS');
		window.location='mail.php';</script>";
	}
	else
	{
		echo "FAILED";
	}
	}
}
?>
 <div class="card card-register mx-auto mt-5">
      <h4><div class="card-header">Add Mail</div></h4>
      <div class="card-body">
        <form method="post">
          <div class="form-group">
            </div><br>
			   <div class="form-row">
              <div class="col-md-4">
                <h4><label for="exampleInputName">Customer's Name</label></h4>
                <input class="form-control" name="name[]" type="text" aria-describedby="nameHelp" placeholder="Enter name" required>
              </div>
              <div class="col-md-4">
                <h4><label for="exampleInputLastName">Phone No.</label></h4>
                <input class="form-control" name="matrix[]" type="text" aria-describedby="nameHelp" placeholder="Enter phone number" required>
              </div>
			   <div class="col-md-4">
                <h4><label for="exampleInputLastName">Tracking No.</label></h4>
                <input class="form-control" name="track[]" type="text" aria-describedby="nameHelp" placeholder="Enter tracking number" required>
              </div>
            </div><br>
			<div class="form-row">
              <div class="col-md-4">             
                <input class="form-control" name="name[]" type="text" aria-describedby="nameHelp" placeholder="Enter name">
              </div>
              <div class="col-md-4">
                <input class="form-control" name="matrix[]" type="text" aria-describedby="nameHelp" placeholder="Enter phone number">
              </div>	
			  <div class="col-md-4">
                <input class="form-control" name="track[]" type="text" aria-describedby="nameHelp" placeholder="Enter tracking number">
              </div>
            </div><br>
				<div class="form-row">
              <div class="col-md-4">             
                <input class="form-control" name="name[]" type="text" aria-describedby="nameHelp" placeholder="Enter name">
              </div>
              <div class="col-md-4">
                <input class="form-control" name="matrix[]" type="text" aria-describedby="nameHelp" placeholder="Enter phone number">
              </div>	
			  <div class="col-md-4">
                <input class="form-control" name="track[]" type="text" aria-describedby="nameHelp" placeholder="Enter tracking number">
              </div>
            </div><br>
			<div class="form-row">
              <div class="col-md-4">             
                <input class="form-control" name="name[]" type="text" aria-describedby="nameHelp" placeholder="Enter name">
              </div>
              <div class="col-md-4">
                <input class="form-control" name="matrix[]" type="text" aria-describedby="nameHelp" placeholder="Enter phone number">
              </div>	
			  <div class="col-md-4">
                <input class="form-control" name="track[]" type="text" aria-describedby="nameHelp" placeholder="Enter tracking number">
              </div>
            </div><br>
			<div class="form-row">
              <div class="col-md-4">             
                <input class="form-control" name="name[]" type="text" aria-describedby="nameHelp" placeholder="Enter name">
              </div>
              <div class="col-md-4">
                <input class="form-control" name="matrix[]" type="text" aria-describedby="nameHelp" placeholder="Enter phone number">
              </div>	
			  <div class="col-md-4">
                <input class="form-control" name="track[]" type="text" aria-describedby="nameHelp" placeholder="Enter tracking number">
              </div>
            </div><br>
			<div class="form-row">
              <div class="col-md-4">             
                <input class="form-control" name="name[]" type="text" aria-describedby="nameHelp" placeholder="Enter name">
              </div>
              <div class="col-md-4">
                <input class="form-control" name="matrix[]" type="text" aria-describedby="nameHelp" placeholder="Enter phone number">
              </div>	
			  <div class="col-md-4">
                <input class="form-control" name="track[]" type="text" aria-describedby="nameHelp" placeholder="Enter tracking number">
              </div>
            </div><br>
			<div class="form-row">
              <div class="col-md-4">             
                <input class="form-control" name="name[]" type="text" aria-describedby="nameHelp" placeholder="Enter name">
              </div>
              <div class="col-md-4">
                <input class="form-control" name="matrix[]" type="text" aria-describedby="nameHelp" placeholder="Enter phone number">
              </div>	
			  <div class="col-md-4">
                <input class="form-control" name="track[]" type="text" aria-describedby="nameHelp" placeholder="Enter tracking number">
              </div>
            </div><br>
			<div class="form-row">
              <div class="col-md-4">             
                <input class="form-control" name="name[]" type="text" aria-describedby="nameHelp" placeholder="Enter name">
              </div>
              <div class="col-md-4">
                <input class="form-control" name="matrix[]" type="text" aria-describedby="nameHelp" placeholder="Enter phone number">
              </div>	
			  <div class="col-md-4">
                <input class="form-control" name="track[]" type="text" aria-describedby="nameHelp" placeholder="Enter tracking number">
              </div>
            </div><br>
			<div class="form-row">
              <div class="col-md-4">             
                <input class="form-control" name="name[]" type="text" aria-describedby="nameHelp" placeholder="Enter name">
              </div>
              <div class="col-md-4">
                <input class="form-control" name="matrix[]" type="text" aria-describedby="nameHelp" placeholder="Enter phone number">
              </div>	
			  <div class="col-md-4">
                <input class="form-control" name="track[]" type="text" aria-describedby="nameHelp" placeholder="Enter tracking number">
              </div>
            </div><br>
			<div class="form-row">
              <div class="col-md-4">             
                <input class="form-control" name="name[]" type="text" aria-describedby="nameHelp" placeholder="Enter name">
              </div>
              <div class="col-md-4">
                <input class="form-control" name="matrix[]" type="text" aria-describedby="nameHelp" placeholder="Enter phone number">
              </div>	
			  <div class="col-md-4">
                <input class="form-control" name="track[]" type="text" aria-describedby="nameHelp" placeholder="Enter tracking number">
              </div>
            </div><br>
          </div>
         <input class="btn btn-primary btn-block" type="submit" name="add" value="Add Mail"/>
        </form>
      </div>
    </div>
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
