<?php
include ("db/opendb.php");
$instance = ConnectDb::getInstance ();
$con = $instance->getConnection ();
ob_start ();
session_start ();
if ($_GET ['email'] == "" || $_GET ['teamId'] == "") {
	header ( "Location: index.php" );
	exit ();
} else {
	$email = $_GET ['email'];
	$team = $_GET ['teamId'];
	// $sql = "select * from user where email='$email'";
	$sql = "select * from jointeam where email='$email' and teamName='$team' and status='pending'";
	$ctr = 0;
	$status = "";
	try {
		$result = $con->query ( $sql );
		foreach ( $result as $row ) {
			$ctr ++;
		}
	} catch ( PDOException $e ) {
		$errTyp = "danger";
		$errMSG = "Something went wrong, try again later...";
	}
	if ($ctr == 0) {
		header ( "Location: index.php" );
		exit ();
	}
}
$query = "select * from user where Email = '" . $_GET ['email'] . "'";
$result = $con->query ( $query ) or die ( "sql error" );
$name="";
$email="";
$phoneNumber="";
$profession="";
$password="";
foreach ( $result as $row ) {
	
	$name = $row ['name'];
	$email = $row ['email'];
	$phoneNumber = $row ['contactNo'];
	$profession = $row ['profession'];
	$password = $row ['password'];
}
if (isset ( $_POST ['join'] ) == true) {
	$name = $_POST ['name'];
	$contactNo = $_POST ['phoneNumber'];
	$profession = $_POST ['profession'];
	$password = $_POST ['pass'];
	
	$insert = "Update user SET name='" . $name . "', contactNo='" . $contactNo . "', 
			profession='" . $profession . "',password='" . $password . "' where email='" . $_GET ['email'] . "'";
	$st = "joined";
	$insert1 = "Update jointeam SET status='" . $st . "' where email='" . $_GET ['email'] . "' and teamName='" . $_GET ['teamId'] . "'";
	if ($con->query ( $insert ) == TRUE) {
		$con->query ( $insert1 );
		header ( "Location: login.php" );
		$errTyp = "success";
		$errMSG = "Successfully Joined";
	} else {
		$errTyp = "danger";
		$errMSG = "oops some went worng...!!";
	}
}

?>
<!doctype html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><html lang="en" class="no-js"> <![endif]-->
<html lang="en">
<head>
<!-- Basic -->
<title>CVC|EditInfo</title>
<!-- Define Charset -->
<meta charset="utf-8">
<!-- Responsive Metatag -->
<meta name="viewport"
	content="width=device-width, initial-scale=1, maximum-scale=1">
<!-- Page Description and Author -->
<meta name="description"
	content="Real Time Collaboration|Collaborative Vistaual Camp">
   <meta name="author" content="Rapto Tech">
<!-- Bootstrap CSS  -->
<link rel="stylesheet" href="asset/css/bootstrap.min.css"
	type="text/css" media="screen">
<!-- Font Awesome CSS -->
<link rel="stylesheet" href="css/font-awesome.min.css" type="text/css"
	media="screen">
<!-- Slicknav -->
<link rel="stylesheet" type="text/css" href="css/slicknav.css"
	media="screen">
<!-- Margo CSS Styles  -->
<link rel="stylesheet" type="text/css" href="css/style.css"
	media="screen">
<!-- Responsive CSS Styles  -->
<link rel="stylesheet" type="text/css" href="css/responsive.css"
	media="screen">
<!-- Css3 Transitions Styles  -->
<link rel="stylesheet" type="text/css" href="css/animate.css"
	media="screen">
<!-- Color CSS Styles  -->
<link rel="stylesheet" type="text/css" href="css/colors/green.css"
	title="green" media="screen" />
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-1.11.3.min.js"></script>
<!-- Margo JS  -->
<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="js/jquery.migrate.js"></script>
<script type="text/javascript" src="js/modernizrr.js"></script>
<script type="text/javascript" src="asset/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.fitvids.js"></script>
<script type="text/javascript" src="js/owl.carousel.min.js"></script>
<script type="text/javascript" src="js/nivo-lightbox.min.js"></script>
<script type="text/javascript" src="js/jquery.isotope.min.js"></script>
<script type="text/javascript" src="js/jquery.appear.js"></script>
<script type="text/javascript" src="js/count-to.js"></script>
<script type="text/javascript" src="js/jquery.textillate.js"></script>
<script type="text/javascript" src="js/jquery.lettering.js"></script>
<script type="text/javascript" src="js/jquery.easypiechart.min.js"></script>
<script type="text/javascript" src="js/jquery.nicescroll.min.js"></script>
<script type="text/javascript" src="js/jquery.parallax.js"></script>
<script type="text/javascript" src="js/jquery.slicknav.js"></script>
<script type="text/javascript" src="js/validation.js"></script>
<!--[if IE 8]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>

<body>
	<!-- Container -->
	<div id="container">

		<!-- Start Header -->
		<div class="hidden-header"></div>
		<nav class="navbar navbar-inverse navbar-fixed-top"
			style="background-color: #15243c; border-color: transparent;">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="#"></a>
				</div>
				<ul class="nav navbar-nav">
					<li><a href="index.php">CVC</a></li>
					<li><a href="index.php">Home</a></li>
				</ul>
			</div>
		</nav>
		<!-- End Header -->

		<!-- Start Page Banner -->
		<div class="page-banner"
			style="padding: 40px 0; background: url(images/slide-02-bg.jpg) center #f9f9f9; margin-top: 60px;">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<h2>Join Team:<?php echo $_GET['teamId'];?></h2>
					</div>
					<div class="col-md-6">
						<ul class="breadcrumbs">
							<li><a href="#">Home</a></li>
							<li>Join Team</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!-- End Page Banner -->
	</div>
	<!-- Start Content -->
	<div id="content">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<!-- Classic Heading -->
					<h4 class="classic-title">
						<span>Personal Inforamtion</span>
					</h4>
					<!-- Start Contact Form -->
					<form role="form" name="regForm" class="contact-form"
						id="contact-form" method="post"
						onSubmit="return validateRegistration();">
						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label">Full Name:</label>
								<div class="controls">
									<input type="text" placeholder="Full Name" name="name"
										value="<?php echo $name; ?>">
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">E-mail:</label>
								<div class="controls">
									<input type="email" class="email" placeholder="E-mail"
										name="email" disabled value="<?php echo $_GET['email'];?>">
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Phone Number:</label>
								<div class="controls">
									<input type="tel" placeholder="Phone Number" name="phoneNumber"
										value="<?php echo $phoneNumber; ?>">
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Profession:</label>
								<div class="controls">
									<input type="text" placeholder="Profession" name="profession"
										value="<?php echo $profession; ?>">
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Password:</label>
								<div class="controls">
									<input type="password" placeholder="Password" name="pass"
										value="<?php echo $password; ?>">
								</div>
							</div>
						</div>
						<div class="col-sm-12">
							<button type="submit" id="submit" name="join"
								class="btn-system btn-large">Join</button>
							<div id="success" style="color: #34495e;"></div>
						</div>

					</form>
					<!-- End Contact Form -->
					<div class="col-md-8"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Container -->
	<!-- Go To Top Link -->
	<a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>
	<script type="text/javascript" src="js/script.js"></script>
</body>

</html>