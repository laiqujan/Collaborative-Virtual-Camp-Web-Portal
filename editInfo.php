
<?php
include("db/opendb.php");
$instance = ConnectDb::getInstance();
$con = $instance->getConnection();
ob_start();
session_start();
if ( isset($_SESSION['user'])=="" ) {
        header("Location: index.php");
		exit;
}
if(isset($_POST['update'])==true){
	$name=$_POST['name'];
	$contactNo=$_POST['phoneNumber'];	
	$profession=$_POST['profession'];
	$password=$_POST['pass'];
	
	$insert = "Update user SET name='" . $name . "', contactNo='" . $contactNo. "', 
			profession='" . $profession. "',password='" . $password. "' where email='" . $_SESSION['Id']. "'";	

    if($con->query($insert)==TRUE)
	{		
		$errTyp = "success";
        $errMSG = "Successfully Updated";
        $_SESSION['user']=$name;
	}
	else{
       $errTyp = "danger";
        $errMSG ="oops some went worng...!!";
	}
	
}

	$query = "select * from user where Email = '" .$_SESSION['Id']. "'";
	$result = $con -> query($query) or die("sql error");
	
	foreach($result as $row)
	{
		
		$name = $row['name'];
		$email = $row['email'];
		$phoneNumber = $row['contactNo'];
		$profession= $row['profession'];
		$password = $row['password'];
	}
	 $con=NULL; 
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
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- Page Description and Author -->
    <meta name="description" content="Real Time Collaboration| Collaborative Vistaual Camp">
    <meta name="author" content="Rapto Tech">
    <!-- Bootstrap CSS  -->
    <link rel="stylesheet" href="asset/css/bootstrap.min.css" type="text/css" media="screen">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" media="screen">
    <!-- Slicknav -->
    <link rel="stylesheet" type="text/css" href="css/slicknav.css" media="screen">
    <!-- Margo CSS Styles  -->
    <link rel="stylesheet" type="text/css" href="css/style.css" media="screen">
    <!-- Responsive CSS Styles  -->
    <link rel="stylesheet" type="text/css" href="css/responsive.css" media="screen">
    <!-- Css3 Transitions Styles  -->
    <link rel="stylesheet" type="text/css" href="css/animate.css" media="screen">
    <!-- Color CSS Styles  -->
    <link rel="stylesheet" type="text/css" href="css/colors/green.css" title="green" media="screen" />
     <link rel="stylesheet" href="css/bootstrap.min.css">
   <script src="js/bootstrap.min.js" ></script>
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
   <nav class="navbar navbar-inverse navbar-fixed-top"style="background-color:cadetblue;border-color: transparent;">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#"></a>
    </div>
    <ul class="nav navbar-nav">
	<li><a href="home.php" style="color: white;"><span style="color: white;" class="glyphicon glyphicon-th-large"></span> Dashboard</a></li>
	<li><a href="createTeam.php" style="color: white;"><span style="color: white;" class="	glyphicon glyphicon-plus-sign"></span> Create Team</a></li>
	
    </ul>
    <ul class="nav navbar-nav navbar-right">
	<li class="dropdown" style="margin-right:-12px;" id="notiff">

                </li>

	   <li class="dropdown"><a  style="color: white;" class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo''.$_SESSION['user'];?> <span class="caret"></span></a>
        <ul class="dropdown-menu" style="background-color:black;">
          <li><a href="editInfo.php" style="color:silver;"><span class="glyphicon glyphicon-user"></span>  My Account</a></li>
          <li><a href="#"style="color:silver;"><span class="glyphicon glyphicon-globe"></span>   Help</a></li>
          <li><a href="logout.php"style="color:silver;"><span class="glyphicon glyphicon-off"></span>  Logout</a></li>
        </ul>
      </li>
    </ul>
  </div>
</nav>
 <!-- End Header -->
         <!-- Start Page Banner -->   
		<div class="panel panel-default" style="background: url(images/slide-02-bg.jpg) center #f9f9f9;margin-top:60px;">
         <div class="panel-body">
		  <h2 style="">Edit Personal Inforamtion</h2>
		<ul class="breadcrumbs">
     <li><a href="home.php">Home</a></li>
      <li>EditInfo</li>
          </ul>
		 </div>
          </div>  
	      <!-- Start Content -->
    <div id="content" style="margin-top:-30px;">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- Classic Heading -->
                <h4 class="classic-title"><span>Personal Inforamtion</span></h4>
                <!-- Start Contact Form -->
                <form role="form" name="regForm" class="contact-form" id="contact-form" method="post" 
				onSubmit="return validateRegistration();">
												                    <?php
			if ( isset($errMSG) ) {
				
				?>
                    <div class="col-sm-12">
				<div class="form-group">
            	<div class="alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?>">
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
                  <input type="text" placeholder="Full Name" name="name"  value="<?php echo $name; ?>">
                </div>
              </div>
                    </div>
                  <div class="col-sm-6">
              <div class="form-group">
                  <label class="control-label">E-mail:</label>
                <div class="controls">
                  <input type="email" class="email" placeholder="E-mail" name="email" disabled  value="<?php echo $email; ?>">
                </div>
              </div>
                  </div>
                    <div class="col-sm-6">
                <div class="form-group">
                  <label class="control-label">Phone Number:</label>
                <div class="controls">
                  <input type="tel" placeholder="Phone Number" name="phoneNumber"  value="<?php echo $phoneNumber; ?>">
                </div>
              </div>
                </div>
                <div class="col-sm-6">
              <div class="form-group">
                  <label class="control-label">Profession:</label>
                <div class="controls">
                  <input type="text" placeholder="Profession" name="profession"  value="<?php echo $profession; ?>">
                </div>
              </div>
                    </div>
					 <div class="col-sm-6">
              <div class="form-group">
                  <label class="control-label">Password:</label>
                <div class="controls">
                  <input type="password" placeholder="Password" name="pass"  value="<?php echo $password; ?>" 
				  minlength="8" 
				pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" 
				  />
                </div>
              </div>
                  </div>
                        <div class="col-sm-12">
                        <button type="submit" id="submit" name="update" class="btn-system btn-large">Update</button>
                        <div id="success" style="color:#34495e;"></div>
                        </div>
                        
            </form>
                <!-- End Contact Form -->
            <div class="col-md-8">
        </div>
            </div>
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