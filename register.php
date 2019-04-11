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
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>CVC - Register</title>
  
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
</div>
<!-- Form Module-->
<div class="module form-module">
  <div class="toggle"><i class="fa fa-times fa-pencil">
      <a style="text-decoration:none;" href="index.php">X</a>
      </i>
  </div>
  
  <div class="form">
    <h2>Create an account</h2>
    <form role="form" name="regForm" class="contact-form"
							id="contact-form" method="post"
							onSubmit="return validateRegistration();" style="text-align:center;">
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
      <input type="text" placeholder="Username" name="name" required/>
      <input type="email" placeholder="Email Address" name="email" required/>
      <input type="tel" placeholder="Phone Number" name="phoneNumber" required/>
      <input type="text" placeholder="Profession" name="profession" required/>
      <input type="password" placeholder="Password" name="pass" required/>
      <button type="submit" id="submit" name="signup">Register</button>
    </form>
  </div>
  <div class="cta"><a href="login.php">Already have an Account</a></div>
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='http://codepen.io/andytran/pen/vLmRVp.js'></script>

    <script src="js/loginIndex.js"></script>

</body>
</html>
