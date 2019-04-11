﻿<?php
include ("db/opendb.php");
$instance = ConnectDb::getInstance ();
$con = $instance->getConnection ();
ob_start ();
session_start ();
// it will never let you open index(login) page if session is set
if (isset ( $_SESSION ['user'] ) != "") {
	header ( "Location: Home.php" );
	exit ();
}
if (isset ( $_POST ['signup'] ) == true) {
	$name = $_POST ['name'];
	$email = $_POST ['email'];
	$contactNo = $_POST ['phoneNumber'];
	$profession = $_POST ['profession'];
	$password = $_POST ['pass'];
	include ("classes/User.php");
	$user = new User ();
	if ($user->signup ( $name, $email, $contactNo, $profession, $password, $con )) {
		$errTyp = "success";
		$errMSG = "Successfully registered, You can login now";
		
		
	} else {
		$errTyp = "danger";
		$errMSG = "This Email is Already Registered Please Use Another..!!";
	}
	$con = NULL;
}

?>

<!doctype html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><html lang="en" class="no-js"> <![endif]-->
<html lang="en">
<head>
<!-- Basic -->
<title>CVC |SignUp</title>
<!-- Define Charset -->
<meta charset="utf-8">
<!-- Responsive Metatag -->
<meta name="viewport"
	content="width=device-width, initial-scale=1, maximum-scale=1">
<!-- Page Description and Author -->
<meta name="description" content="User|SignUp">
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
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign
							Up</a></li>
					<li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span>
							Login</a></li>
				</ul>
			</div>
		</nav>
		<!-- End Header -->
		<!-- Start Content -->
		<div id="content" style="margin-top: 40px;">
			<div class="container">
				<div class="row">
					<div class="col-md-8">
						<!-- Classic Heading -->
						<h4 class="classic-title">
							<span>Sign Up</span>
						</h4>
						<!-- Start Contact Form -->
						<form role="form" name="regForm" class="contact-form" enctype="multipart/form-data"
							id="contact-form" method="post" 
							onSubmit="return validateRegistration();">
								                    <?php
																												if (isset ( $errMSG )) {
																													
																													?>
                    <div class="col-sm-12">
								<div class="form-group">
									<div
										class="alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?>">
										<span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                </div>
								</div>
							</div>
                <?php
																												}
																												?>
				
				
              <div class="col-sm-12">
								<div class="form-group">
									<label class="control-label">Full Name:</label>
									<div class="controls">
										<input type="text" placeholder="Full Name" name="name">
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">E-mail:</label>
									<div class="controls">
										<input type="email" class="email" placeholder="E-mail"
											name="email">
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Phone Number:</label>
									<div class="controls">
										<input type="tel" placeholder="Phone Number"
											name="phoneNumber">
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Profession:</label>
									<div class="controls">
										<input type="text" placeholder="Profession" name="profession">
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label class="control-label">Password:</label>
									<div class="controls">
										<input type="password" placeholder="Password" name="pass" minlength="8" 
										pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" />
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<button type="submit" id="submit" name="signup"
									class="btn-system btn-large">Sign Up</button>
								<div id="success" style="color: #34495e;"></div>
							</div>
							<div class="col-sm-12">
								<label> Already a member? </label> <a href="login.php">Log In</a>
							</div>

						</form>
						<!-- End Contact Form -->
						<div class="col-md-8"></div>
					</div>
				</div>
			</div>
		</div>
		<!-- Divider -->
		<div class="hr1" style="margin-bottom: 50px;"></div>


		<!-- Start Footer -->
		<footer
			style="margin-top: -60px; background-color: #15243c; border-color: transparent;">
			<div class="container"
				style="background-color: #15243c; border-color: transparent;">

				<div class="copyright-section" style="margin-top: 50px;">
					<div class="row">
						<div class="col-md-6">
							<p>
								&copy; 2016 CVC - All Rights Reserved <a href="">Rapto Tech</a>
							</p>
						</div>
						<div class="col-md-6 footer-widget social-widget">
							<ul class="footer-nav social-icons">
								<li><a href="#" style="color: white;">Contact</a></li>
								<li><a href="#" style="color: white;">FAQs</a></li>
								<li><a href="#" style="color: white;">Privacy Policy</a></li>
								<li><a href="#" style="color: white;">Terms of Use</a></li>
								<li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- End Copyright -->
			</div>
		</footer>
		<!-- End Footer -->
	</div>
	<!-- End Container -->
	<!-- Go To Top Link -->
	<a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>
	<script type="text/javascript" src="js/script.js"></script>
</body>

</html>