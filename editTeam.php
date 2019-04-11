<?php
include ("db/opendb.php");
$instance = ConnectDb::getInstance ();
$con = $instance->getConnection ();
ob_start ();
session_start ();
if (isset ( $_SESSION ['user'] ) == "") {
	header ( "Location: login.php" );
	exit ();
}
$teamName = $_GET ['teamId'];
if (isset ( $_POST ['update'] ) == true) {
	$category = $_POST ['category'];
	$description = $_POST ['description'];
	include ("classes/Team.php");
	$team = new Team ();
	if ($team->updateTeam ( $teamName, $category, $description, $con )) {
		$errTyp = "success";
		$errMSG = "Team Inforamtion Updated Successfully";
	} else {
		$errTyp = "danger";
		$errMSG = "Ooops some thing went wrong..!!";
	}
}
$query = "select * from team where teamName = '$teamName'";
$result = $con->query ( $query ) or die ( "sql error" );
foreach ( $result as $row ) {
	
	$cat = $row ['category'];
	$des = $row ['description'];
}
$con = NULL;
?>

<!doctype html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><html lang="en" class="no-js"> <![endif]-->
<html lang="en">
<head>
<!-- Basic -->
<title>CVC | EditInfo</title>
<!-- Define Charset -->
<meta charset="utf-8">
<!-- Responsive Metatag -->
<meta name="viewport"
	content="width=device-width, initial-scale=1, maximum-scale=1">
<!-- Page Description and Author -->
<meta name="description"
	content="Real Time Collaboration| Collaborative Vistaual Camp>
    <meta 
	
	
	
	
	name="author" content="Rapto Tech">
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

	<link rel="stylesheet" href="notification.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<!--[if IE 8]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<script>
function init(){
    var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("notiff").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "loadNotification.php", true);
        xmlhttp.send();
}
			setInterval(function(){init()},1000);
		</script>
</head>

<body onload="init();">
	<!-- Container -->
	<div class="container">
		<nav class="navbar navbar-inverse navbar-fixed-top"
			style="background-color: cadetblue; border-color: transparent;">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="#"></a>
				</div>
				<ul class="nav navbar-nav">
					<li><a href="home.php" style="color: white;"><span style="color: white;" class="glyphicon glyphicon-th-large"></span>
							Dashboard</a></li>
					<li><a href="createTeam.php" style="color: white;"><span style="color: white;"
							class="	glyphicon glyphicon-plus-sign"></span> Create Team</a></li>

				</ul>
				<ul class="nav navbar-nav navbar-right">
				<li class="dropdown" style="margin-right:-12px;" id="notiff">

                </li>

					<li class="dropdown"><a class="dropdown-toggle" style="color: white;"
						data-toggle="dropdown" href="#"><?php echo''.$_SESSION['user'];?> <span
							class="caret"></span></a>
						<ul class="dropdown-menu" style="background-color: black;">
							<li><a href="editInfo.php" style="color: silver;"><span
									class="glyphicon glyphicon-user"></span> My Account</a></li>
							<li><a href="#" style="color: silver;"><span
									class="glyphicon glyphicon-globe"></span> Help</a></li>
							<li><a href="logout.php" style="color: silver;"><span
									class="glyphicon glyphicon-off"></span> Logout</a></li>
						</ul></li>
				</ul>
			</div>
		</nav>
		<!-- End Header -->
		<!-- Start Page Banner -->
		<div class="panel panel-default"
			style="background: url(images/slide-02-bg.jpg) center #f9f9f9; margin-top: 60px;">
			<div class="panel-body">
				<h2>Edit Team <span style="text-transform: uppercase;"><?php echo''.$_GET['teamId'];?></span>  Inforamtion</h2>
				<ul class="breadcrumbs">
					<li><a href="home.php">Home</a></li>
					<li>EditTeam</li>
				</ul>
			</div>
		</div>
		<!-- Start Content -->
	</div>
	<!-- Start Content -->
	<div id="content" style="margin-top: -40px;">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<!-- Classic Heading -->
					<h4 class="classic-title">
						<span>Team Inforamtion</span>
					</h4>
					<!-- Start Contact Form -->
					<form role="form" name="editTeam" class="contact-form"
						id="contact-form" method="post"
						onSubmit="return validateEditTeam();">
						<div class="col-sm-12">
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
              <div class="form-group">
								<label class="control-label">Name:</label>
								<div class="controls">
									<input type="text" name="name"
										value="<?php echo $_GET['teamId'];?>" disabled>
								</div>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label">Category:</label>
								<div class="controls">
									<input type="text" placeholder="Category" name="category"
										value="<?php echo $cat;?>">
								</div>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label class="control-label">Description:</label>
								<div class="controls">
									<textarea rows="5" placeholder="Description" name="description"><?php echo $des;?></textarea>
								</div>
							</div>
						</div>
						<div class="col-sm-2">
							<button type="submit" id="update" name="update" method="Post"
								class="btn-system btn-large">Update</button>
							<div id="success" style="color: #34495e;"></div>
						</div>
						<div class="col-sm-2">

							<div id="success" style="color: #34495e;"></div>
						</div>
						<div class="col-sm-2">

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