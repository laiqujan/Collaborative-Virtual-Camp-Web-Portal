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
if (isset ( $_POST ['invite'] ) == true) {
	$email = $_POST ['email'];
	$name = $_POST ['inputname'];
	$teamname = $_POST ['hiddenId'];
	// Send Email Notification
	$name = "CVC";
	$message = "Dear " . $name . ",
Welcome to CVC, You have been Invited by " . $_SESSION ['user'] . "
to Join His/Her Team on CVC ,click on link to Join Team http://www.cvc.com/jointeam.php?email=" . $email . "&teamId=" . $teamname . ".";
	$subject = "Notification for Join Team";
	$to = $email;
	$message = 'FROM: ' . $name . ' Message: ' . $message;
	$headers = 'From: support@cvc.com' . "\r\n";
	// this line checks that we have a valid email addres
	$errTyp = "success";
	$errMSG = "Inivitation Sent.";
	$isAdmin = "No";
	$status = "pending";
	$insert = "insert into jointeam(teamName,email,isAdmin,status)                    
	      values('$teamname','$email','$isAdmin','$status')";
	
	$sql = "select * from user where Email='$email'";
	$ctr = 0;
	try {
		$result = $con->query ( $sql );
		foreach ( $result as $row ) {
			$ctr ++;
		}
	} catch ( PDOException $e ) {
		$errTyp = "danger";
		$errMSG = "Something went wrong, try again later...";
	}
	
	$insert1 = "insert into user(email,name,contactNo,profession,password)                    
	values('$email','','','','')";
	
	if (filter_var ( $to, FILTER_VALIDATE_EMAIL )) {
		mail ( $to, $subject, $message, $headers );
		if ($con->query ( $insert ) == TRUE) {
			
			if ($ctr == 0) {
				$con->query ( $insert1 );
			}
			
			$errTyp = "success";
			$errMSG = "Inivitation Sent";
		}
	} 

	else {
		$errTyp = "danger";
		$errMSG = "User had already this team.!!";
	}
}

$idd = $_SESSION ['Id'];
$query = "select * from team where email='$idd'";
$result = $con->query ( $query ) or die ( "Query error" );
$query1 = "select * from team,jointeam where jointeam.teamName=team.teamName and jointeam.email='$idd' and isAdmin='No' and status='joined'";
$result1 = $con->query ( $query1 ) or die ( "Query error" );



?>

<!DOCTYPE html>
<html>
</head>
<title>Home</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">


<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-1.11.3.min.js"></script>

<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="notification.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script
	src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<style>
    .parentSelection {
        font-family: lato;
        width: 250px;
        height: 250px;
        margin: 40px auto;
    }

    /*-----template----*/
    #textA:link {
        text-decoration: none;
        color: white;
    }

    #textA:visited {
        text-decoration: none;
        color: white;
    }

    #textA:hover {
        text-decoration: none;
        color: white;
    }

    #textA:active {
        text-decoration: none;
        color: white;
    }

    .selectionBox {
        background-image: url('images/slider/bg1.jpg');
        width: 20%;
        min-width: 250px;
        height: 250px;
        position: relative;
        font-family: inherit;
        cursor: pointer;
        text-align: center;
        border-radius: 6px 6px 10px 10px;
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 3px 1px -2px rgba(0, 0, 0, 0.2), 0 1px 5px 0 rgba(0, 0, 0, 0.12);
        top: 0;
        -webkit-transition: all 0.3s;
        -moz-transition: all 0.3s;
        transition: all 0.3s;
        overflow: hidden;
    }

    .selectionBox h3 {
        margin: 0 auto;
        font-weight: 600;
        font-size: 30px;
        position: relative;
        margin: 25%;
        z-index: 2;
    }

    .bottom-boxDiv {
        color: rgba(0, 0, 0, 0.54);
        background: white;
        position: absolute;
        bottom: 0px;
        height: 31px;
        width: 100%;
        border-radius: 0 0 6px 6px;
        z-index: 3;
    }

    .selectionBox:hover {
        box-shadow: 0 6px 6px 0 rgba(0, 0, 0, 0.14), 0 7px 5px -2px rgba(0, 0, 0, 0.2), 0 5px 9px 0 rgba(0, 0, 0, 0.12);
        top: -4px;
        -webkit-transition: all 0.3s;
        -moz-transition: all 0.3s;
        transition: all 0.3s;
    }

    .selectionBox:active {
        box-shadow: 0 0 0 0 rgba(0, 0, 0, 0.14), 0 0 0 0 rgba(0, 0, 0, 0.2), 0 0 0 0 rgba(0, 0, 0, 0.12);
        top: 4px;
        -webkit-transition: all 0.3s;
        -moz-transition: all 0.3s;
        transition: all 0.3s;
    }
	
     
</style>
<style>
.dropbtn {
	border: none;
	cursor: pointer;
}

.dropdown {
	position: relative;
	display: inline-block;
}

.dropdown-content {
	display: none;
	position: absolute;
	background-color: #f9f9f9;
	min-width: 130px;
	box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
	z-index: 1;
}

.dropdown-content a {
	color: black;
	padding: 12px 16px;
	text-decoration: none;
	display: block;
}

.dropdown:hover .dropdown-content {
	display: block;
}
</style>
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
	<!-- Top container -->
	<div class="container">
		<nav class="navbar navbar-inverse navbar-fixed-top"
			style="background-color: cadetblue; border-color: transparent;">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="#"></a>
				</div>
				<ul class="nav navbar-nav">
					<li><a href="#"><span  style="color: white;" class="glyphicon glyphicon-th-large"></span>
							<span style="color: white; font-size: 16px;">Dashboard</span></a></li>
					<li><a href="createTeam.php"><span style="color: white;"
							class="	glyphicon glyphicon-plus-sign"></span> <span
							style="color: white; font-size: 16px;">Create Team</span></a></li>

				</ul>
				<ul class="nav navbar-nav navbar-right">
				 <li class="dropdown" style="margin-right:-12px;" id="notiff">

                </li>
					<li class="dropdown">
					<a class="dropdown-toggle"
						data-toggle="dropdown" href="#"><span
							style="color: white; font-size: 16px;"><?php echo''.$_SESSION['user'];?></span>
							<span class="caret"></span></a>
						<ul class="dropdown-menu"
							style="background-color: #15243c; border-color: transparent;">
							<li><a href="editInfo.php" style="color: silver;"><span
									class="glyphicon glyphicon-user"></span> My Account</a></li>
							<li><a href="#" style="color: silver;"><span
									class="glyphicon glyphicon-globe"></span> Help</a></li>
							<li><a href="logout.php" style="color: silver;"><span
									class="glyphicon glyphicon-off"></span> Logout</a></li>
						</ul>
						</li>
						
				</ul>
			</div>
		</nav>

		<div class="row" style="margin-top: 100px;">
            <h2 style="text-align: center;">Hi, <?php echo''.$_SESSION['user'];?></h2>
            <p style="text-align: center;">Welcome to the <b>Collaborative Virtual Camp</b>, Here You can share your Workspace in no Time.</p>
            <div class="col-md-3">
                <div id="start-tour" class='parentSelection'>
                    <a href='Home.php?value=myteams'>
                        <div class='selectionBox'>
                            <h3 style="color: white;">My Teams</h3>
                            <h4 style="color: white">
							
							<span class="glyphicon glyphicon-user">
								<?php
                                foreach ( $con->query ( "SELECT COUNT(*) FROM team where email='$idd'" ) as $row ) {
                                    echo $row ['COUNT(*)'];
                                }
                                ?>
                               </span>
                            </h4>
                            <div class='bottom-boxDiv'>
                                <h4>View</h4>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div id="start-tour" class='parentSelection'>
                    <a href='Home.php?value=joinedteams'>
                        <div class='selectionBox'>
                            <h3 style="color: white;">Joined Teams</h3>
                            <h4 style="color: white">
							<span class="glyphicon glyphicon-user">

								<?php
                                foreach ( $con->query ( "SELECT COUNT(*) from team,jointeam where jointeam.teamName=team.teamName and jointeam.email='$idd' and isAdmin='No' and status='joined'" ) as $row ) {
                                    echo $row ['COUNT(*)'];
                                }
                                ?>

								</span>
                            </h4>
                            <div class='bottom-boxDiv'>
                                <h4>View</h4>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div id="start-tour" class='parentSelection'>
                    <a href='#'>
                        <div class='selectionBox'>
                            <h3 style="color: white;">My </br>Tasks</h3>

                            <h4 style="color: white">
							<span class="glyphicon glyphicon-tasks">

								<?php
    foreach ( $con->query ( "select COUNT(*) from todo,assigned where todo.id=assigned.id and assigned.email='" . $_SESSION ['Id'] . "' and status='progress'" ) as $row ) {
                                    echo $row ['COUNT(*)'];
                                }
                                ?>

								</span>
                            </h4>
                            <div class='bottom-boxDiv'>
                                <h4>View</h4>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
			            <div class="col-md-3">
                <div id="start-tour" class='parentSelection'>
                    <a href='editInfo.php'>
                        <div class='selectionBox'>
                            <h3 style="color: white;">My Account</h3>
                            <h4 style="color: white">
                                <span class="glyphicon glyphicon-user"></span>
                            </h4>
                            <div class='bottom-boxDiv'>
                                <h4>View</h4>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
				 <?php
					
					if (isset ( $_GET ['value'] ) == TRUE && ($_GET ['value']) == 'myteams') {
						?>		
      <div class="col-lg-12" id="myteams">
				<h3 style="color: #15243c;"><?php echo''.$_SESSION['user'];?> Teams</h3>
			</div>
		</div>
		<div class="row">
	  <?php
						if (isset ( $errMSG )) {
							
							?>
                    <div class="col-sm-12">
				<div class="form-group">
					<div
						class="alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?>">
						<span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
				<a href="home.php">Refresh</a>
					</div>
				</div>
			</div>
                <?php
						}
						?>
  		   <?php
						foreach ( $result as $row ) {
							?>
    <div class="col-lg-12">
				<div class="panel panel-info">
					<div class="panel-heading" style="background-color: cadetblue">
						<a href="#"><strong style="color: #15243c;"><?php echo $row['teamName']; ?> </strong></a>
					</div>
					<div class="panel-body">
   <?php echo $row['description']; ?> 
    <button type="button" class="btn btn-link" data-toggle="modal"
							data-target="#myModal" value="<?php echo $row['teamName']; ?>"
							onclick="setTeamValue(this.value);">
							<span class="glyphicon glyphicon-plus-sign"></span> <span
								style="color: silver;">Invite More People</span>

						</button>

						<div class="dropdown" style="float: right">
							<a style="float: right; color: silver;" class="dropbtn"><span
								style="font-size: 20px;" class="glyphicon glyphicon-cog"></span></a>
							<div class="dropdown-content">
								<a
									href="viewTeammates.php?teamId=<?php echo $row['teamName'];?>"
									target="_blank">My Teammates</a> <a
									href="editTeam.php?teamId=<?php echo $row['teamName'];?>"
									target="_blank">Edit Team</a> <a
									href="deleteTeam.php?teamId=<?php echo $row['teamName'];?>">Delete</a>
							</div>
						</div>

						<a style="float: right; margin-right: 15px; color: silver;"
							href="directory.php?teamId=<?php echo $row['teamName']; ?>"
							target="_blank" data-toggle="tooltip" data-placement="bottom"
							title="Files"><span style="font-size: 20px;"
							class="glyphicon glyphicon-folder-open"></span>
					   </a>
							<a
							style="float: right; margin-right: 15px; color: silver;"
							href="chat.php?teamId=<?php echo $row['teamName']; ?>" data-toggle="tooltip" target="_blank"
							data-placement="bottom" title="Chat"><span
							style="font-size: 20px;" class="glyphicon glyphicon-inbox "></span>
							</a>
						<a style="float: right; margin-right: 15px; color: silver;"
							href="mytasks.php?teamId=<?php echo $row['teamName']; ?>"
							data-toggle="tooltip" target="_blank" data-placement="bottom"
							title="Tasks"> <span style="font-size: 20px;"
							class="glyphicon glyphicon-tasks"></span></a>
					</div>
				</div>
			</div>
	 <?php
						}
						?>
</div>
<?php
					}
					?>
	 <?php
		
		if (isset ( $_GET ['value'] ) == TRUE && ($_GET ['value']) == 'joinedteams') {
			
			?>
 <div class="row" style="margin-top: 5px;">
			<div class="col-lg-12" id="joinedteams">
				<h3 style="color: #15243c;">Joined Teams</h3>
			</div>
		</div>
		<div class="row">
  	<?php
			foreach ( $result1 as $row1 ) {
				?>
    <div class="col-lg-12">
				<div class="panel panel-info">
					<div class="panel-heading" style="background-color: cadetblue">
						<a href="#"><strong style="color: #15243c;"><?php echo $row1['teamName']; ?> </strong></a>
					</div>
					<div class="panel-body">
   <?php echo $row1['description']; ?> 
  
 <div class="dropdown" style="float:right;margin-right: 8px;">
							<a style="float: right; color: silver;" class="dropbtn"><span
								style="font-size: 20px;" class="glyphicon glyphicon-cog"></span></a>
							<div class="dropdown-content">
								<a href="leaveTeam.php?teamId=<?php echo $row1['teamName'];?>">Leave
									Team</a>

							</div>
						</div>


						<a style="float: right; margin-right: 15px; color: silver;"
							href="directory.php?teamId=<?php echo $row1['teamName'];?>"
							data-toggle="tooltip" target="_blank" data-placement="bottom"
							title="Files"><span style="font-size: 20px;"
							class="glyphicon glyphicon-folder-open"></span></a> <a
							style="float: right; margin-right: 15px; color: silver;"
							href="chat.php?teamId=<?php echo $row1['teamName']; ?>" data-toggle="tooltip" target="_blank"
							data-placement="bottom" title="Chat"><span
							style="font-size: 20px;" class="glyphicon glyphicon-inbox "></span></a>
						<a style="float: right; margin-right: 15px; color: silver;"
							href="mytasks.php?teamId=<?php echo $row1['teamName']; ?>"
							data-toggle="tooltip" target="_blank" data-placement="bottom"
							title="Tasks"> <span style="font-size: 20px;"
							class="glyphicon glyphicon-tasks"></span></a>
					</div>
				</div>
			</div> 
	 <?php
			}
			?>
</div>

<?php
		}
		?>
  <form method="post" name="inviteForm" onsubmit="return checkName();">
			<!-- Modal -->
			<div class="modal fade" id="myModal" role="dialog">
				<div class="modal-dialog">

					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header" style="background-color: LightSeaGreen;">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Invite Team Member</h4>
						</div>
						<div class="modal-body">

							<p>Email</p>
							<input type="text" name="email" placeholder="E-mail" id="email"
								style="width: 400px; border-radius: 3px; height: 40px;" /> <br />
							<br />
							<p>Name</p>
							<input type="text" id="hiddenId" name="hiddenId" hidden> <input
								type="text" name="inputname" placeholder="Name (Optional)"
								id="inputname"
								style="width: 400px; border-radius: 3px; height: 40px;" />
						</div>
						<div class="modal-footer" style="background-color: LightSeaGreen;">
							<button type="submit" class="btn btn-default" data-submit="modal"
								method="post" name="invite" id="invite">Invite</button>
							<button type="button" class="btn btn-default" id="close"
								name="close" data-dismiss="modal">Close</button>
						</div>
					</div>

				</div>
			</div>
		</form>
	</div>
	<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});

function setTeamValue(name){
	document.getElementById("hiddenId").value=name;
}
function checkName(){
	//alert(document.getElementById("hiddenId").value);
	var email=document.getElementById("email");
	var nname=document.getElementById("email").value;
	if(nname==""){
		document.getElementById("email").placeholder ="Please Enter Email Address";
		document.getElementById("email").style.borderColor = "red";
		document.getElementById("email").style.color = "red";
		return false;
	}
	else{
		if(ValidateEmail(email)){	
		return true;	
		}
		else{
			return false;
		}
		
	}
}
	function ValidateEmail(uemail){
    var emaill = uemail.value.length;
    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if(uemail.value.match(mailformat) && emaill != 0)
    {
        uemail.style.borderColor = "green";
        return true;
    }
    else
    {
        uemail.focus();
        uemail.style.borderColor = "red";
		uemail.style.color = "red";
        uemail.value="";
        uemail.placeholder="You have entered an invalid email address!";
        return false;
    }
}	
</script>

		  <script>
		  function setStatus(){
		   var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
             //   document.getElementById("notiff").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "updateNotification.php", true);
        xmlhttp.send();
		  }
		  </script>
</body>
</html>
