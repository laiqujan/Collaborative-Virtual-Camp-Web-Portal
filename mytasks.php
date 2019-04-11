<?php
include("db/opendb.php");
$instance = ConnectDb::getInstance();
$con = $instance->getConnection();
ob_start();
session_start();
if ( isset($_SESSION['user'])==""&&($_GET['teamId'])=="") {
        header("Location: login.php");
		exit;
}
$teamName=$_GET['teamId'];

if(isset($_POST['setStatus'])==true){
	
	$id=$_POST['setStatus'];
	include ("classes/Task.php");
	$task = new Task ();
	$task->updateStaus($id,$_SESSION['Id'], $con);
	
}

if(isset($_POST['addTask'])==true){
	require_once ("classes/Notificaton.php");
	$notf = new Notifications ();
	include ("classes/Task.php");
	$task = new Task ();
	
    $title=$_POST['title'];
    $description=$_POST['description'];
//	$insert="insert into todo(title,description) values('$title','$description')";
	 $sql="select * from jointeam where teamName='$teamName'";
	 $result = $con->query($sql);
	 $sender_id=$_SESSION['Id'];
		  
    if($task->addTask($title, $description, $con))
	  {
	$last_id = $con->lastInsertId(); 
       try{
		 
         //$insert2="insert into assigned(id,email,teamName,status)                    
	     // values('$last_id','".$_SESSION['Id']."','$teamName','progress')";
		//  $con->query($insert2); 	
		  $des=$_SESSION['user']." added new Task in ".$teamName." team.";
		  $ref="mytasks.php?teamId=".$teamName;
		foreach($result as $row)
		{			
          $mail=$row['email'];
          $insert1="insert into assigned(id,email,teamName,status)values('$last_id','$mail','$teamName','progress')";
		  $con->query($insert1); 
	      
		 // $insert2="insert into notifications(recipient_id,sender_id,des,reference)values('$mail',$sender_id,'$des','$ref')";
		 // $con->query($insert2); 
	    }
		$notf->addNotification ($teamName,$sender_id,$des,$ref,$con);
		$errTyp = "success";
        $errMSG = "Team Task Created Suceesfully.";
	}
	catch(PDOException $e)
	{
		$errTyp = "danger";
        $errMSG = "Something went wrong, try again later...";
    }
		   
	  }
	else
	  {
	     $errTyp = "danger";
         $errMSG = "Oops some thing went wrong..";
	  }
	  }
	$teamName=$_GET['teamId'];
	$query1="select * from todo,assigned where todo.id=assigned.id and assigned.teamName='$teamName' and assigned.email='".$_SESSION['Id']."' and status='progress'";
	$result1 = $con -> query($query1) or die("sql error");
	$query2="select * from todo,assigned where todo.id=assigned.id and assigned.teamName='$teamName' and assigned.email='".$_SESSION['Id']."' and status='Complete'";
	$result2 = $con -> query($query2) or die("sql error");
	
	$con=NULL;
?>
<!DOCTYPE html>
<html>
<head>
 <!-- Basic -->
    <title>CVC | MyTasks</title>
    <!-- Define Charset -->
    <meta charset="utf-8">
    <!-- Responsive Metatag -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- Page Description and Author -->
    <meta name="description" content="Real Time Collaboration| Collaborative Vistaual Camp>
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
	<li><a href="createTeam.php" style="color: white;"><span style="color: white;" class="glyphicon glyphicon-plus-sign"></span> Create Team</a></li>
	<li><a  style="color: white;" href="#" data-toggle="modal" data-target="#myModal"><span style="color: white;" class="glyphicon glyphicon-plus-sign"></span> Add Task</a></li>
	
    </ul>
    <ul class="nav navbar-nav navbar-right">
	<li class="dropdown" style="margin-right:-12px;" id="notiff">

                </li>
	   <li class="dropdown"><a style="color: white;" class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo''.$_SESSION['user'];?> <span class="caret"></span></a>
        <ul class="dropdown-menu" style="background-color:black;">
          <li><a href="editInfo.php" style="color:silver;"><span class="glyphicon glyphicon-user"></span>  My Account</a></li>
          <li><a href="#"style="color:silver;"><span class="glyphicon glyphicon-globe"></span>   Help</a></li>
          <li><a href="logout.php"style="color:silver;"><span class="glyphicon glyphicon-off"></span>  Logout</a></li>
        </ul>
      </li>
    </ul>
  </div>
</nav> <!-- End Header -->
         <!-- Start Page Banner -->   
		<div class="panel panel-default" style="background: url(images/slide-02-bg.jpg) center #f9f9f9;margin-top:60px;">
         <div class="panel-body">
		  <h2>Team <span style="text-transform: lowercase;"><?php echo $teamName;?></span> Tasks</h2>
		<ul class="breadcrumbs">
     <li><a href="home.php">Home</a></li>
      <li>MyTasks</li>
	  
          </ul>
		 </div>
          </div>  
	      <!-- Start Content -->
    </div>	  
		  
	      <!-- Start Content -->
<div class="container" >
<div class="row">
<div class="col-md-12">
	 <?php
			if ( isset($errMSG) ) {
				
				?>
                    <div class="col-sm-12">
				<div class="form-group">
            	<div class="alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?>">
				<span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
				<a href="mytasks.php?teamId=<?php echo $teamName;?>">Refresh</a>
                </div>
            	</div>
                    </div>
                <?php
			}
			?>

<h3 style="color:cadetblue;">Tasks in Progress</h3>			
<form  method="post">
<table class="table table-striped">
    <thead>
      <tr>
        <th>Title</th>
        <th>Description</th>
        <th>Status</th>
		<th>Mark as Compelete</th>
      </tr>
    </thead>
  <tbody>
   <?php
	  foreach($result1 as $row1)
	  {
		 
	  ?>
<tr style="background-color:#b3cccc;">
<td>
<h4><?php echo $row1['title'];?></h4>
</td>
<td>
 <h4 id="des"><?php echo $row1['description'];?></h4>
 </td>
<td>
<h4><?php echo $row1['status'];?></h4> 
</td>
<td>
<button type="submit" name="setStatus" value="<?php echo $row1['id'];?>" class="btn btn-link">
<span class="glyphicon glyphicon-check"></span></button>
</td>
</tr>
 <?php
 
	  }
	  ?>
  </tbody>
</table>
</form>
</div>
</div>
</div>
      <!-- Start Content -->
<div class="container" >
<div class="row">
<div class="col-md-12">
<h3 style="color:cadetblue;">Completed Tasks</h3>		
<form  method="post">
<table class="table table-striped">
    <thead>
      <tr>
        <th>Title</th>
        <th>Description</th>
        <th>Status</th>
      </tr>
    </thead>
  <tbody>
   <?php
	  foreach($result2 as $row2)
	  {
		 
	  ?>
<tr style="background-color:#b3cccc;">
<td>
<h4><?php echo $row2['title'];?></h4>
</td>
<td>
 <h4 id="des" style="text-decoration:line-through;"><?php echo $row2['description'];?></h4>
 </td>
<td>
<h4><?php echo $row2['status'];?></h4> 
</td>
</tr>

 <?php
	  }
	  ?>
  </tbody>
</table>
</form>
</div>
</div>
</div>
  <form method="post" name="createTask" onsubmit="return validateTask();">
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background-color:LightSeaGreen;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Task</h4>
        </div>
        <div class="modal-body">
		  <p>Title:</p>
          <input type="text" name="title"  placeholder="Title" id="title" style="width:440px;border-radius:3px;height:40px;"/>
		  </br></br><p>Description:</p><input  type="text" id="hiddenId" name="hiddenId" hidden>
		   <input  type="text" name="description" placeholder="Description"  id="description" style="width:440px;border-radius:3px;height:60px;"/>
        </div>
        <div class="modal-footer" style="background-color:LightSeaGreen;">
		 <button type="submit" class="btn btn-default" data-submit="modal" method="post" 
		 name="addTask" id="addTask">Add </button>
          <button type="button" class="btn btn-default" id="close" name="close" data-dismiss="modal">Close</button> 
        </div>
      </div>
      
    </div>
  </form>
      </div>
</body>
</html>
