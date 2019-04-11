<?php
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
if (isset ( $_POST ['login'] ) == true) {
	$email = $_POST ['username'];
	$password = $_POST ['password'];
	$user = "";
	include ("classes/User.php");
	$user = new User ();
	if ($user->login ( $email, $password, $con )) {
		$user = $user->getName ( $email, $password, $con );
		$_SESSION ['Id'] = $email;
		$_SESSION ['user'] = $user;
		echo "<script language='javascript' type='text/javascript'>
	            window.location.href='Home.php';</script>";
	} else {
		$errTyp = "danger";
		$errMSG = "Invalid Username | Password";
	}
	$con = NULL;
}

?>

<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>CVC - Login</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

  <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
<link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

      <link rel="stylesheet" href="css/loginStyle.css">

  
</head>

<body>
  
<!-- Form Mixin-->
<!-- Input Mixin-->
<!-- Button Mixin-->
<!-- Pen Title-->
<div class="pen-title">
  <h1>Collaborative Virtual Camp</h1>
    <img class="img-responsive" style="height: 130px; width: 140px; margin-top: -20px;" src="images/logo1.png" alt="logo">
</div>
<!-- Form Module-->
<div class="module form-module">
  <div class="toggle"><i>
      <a style="text-decoration:none;" href="index.php">X</a>
      </i>
    
  </div>
  <div class="form" style="margin-top: -30px;">
    <h2>Login to your account</h2>
    <form role="form" name="loginForm" id="contact-form" method="post" onSubmit="return userLogin();" style="text-align:center;">
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
      <input type="text" placeholder="Username" name="username" required/>
      <input type="password" placeholder="Password" name="password" required/>
      <button type="submit" id="submit" name="login">Login</button>
      <a style="text-decoration:none;" href="forgot.php">Forgot your password?</a>
        <br/>
    </form>
    </div>
  <div class="cta"><a href="signup.php">Create a new Account</a></div>
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='http://codepen.io/andytran/pen/vLmRVp.js'></script>

    <script src="js/loginIndex.js"></script>

</body>
</html>
