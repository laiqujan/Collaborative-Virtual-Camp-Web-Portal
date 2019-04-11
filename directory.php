<?php
// Opening Connection
include ("db/opendb.php");
$instance = ConnectDb::getInstance ();
$con = $instance->getConnection ();
ob_start ();
session_start ();
$rid = "";
$name = $_GET ['teamId'];
$rid = $_GET ['teamId'];

if (isset ( $_SESSION ['user'] ) == "" || $_GET ['teamId'] == "") {
	header ( "Location: index.php" );
	exit ();
}
if (isset ( $_POST ['createRepos'] ) == true) {
	include ("classes/Repository.php");
	$rep = new Repository ();
	// checking folder already exisits or not
	$target_file = $_POST ['repos'];
	$newFolder = $target_file;
	// Check if file already exists
	if (! file_exists ( $target_file )) {
		if ($rep->createRepository($rid, $target_file, $newFolder,$con)) {
		$errTyp = "success";
	    $errMSG = "Repository Created Sucessfully";
		} else {
			$errMSG = "oops some thing went wrong.";
			$errTyp = "danger";
		}
   	
	} else {	
		$errTyp = "danger";
		$errMSG = "Sorry, Folder already exists.";
	}
}
if (isset ( $_POST ['open'] ) == true) {
	  $dId = $_POST ['open'];
	  $_SESSION['workspace']=$dId;
      header("Location: files.php?teamId=$rid&dirId=$dId");
	}
	$query = "select * from directory where teamName='$rid' ";
	$result = $con->query ( $query ) or die ( "Query error" );
	$open = false;

?>

<html>
<head>
<title>CVC|Files</title>
<meta charset="utf-8">
<!-- Responsive Metatag -->
<meta name="viewport"
	content="width=device-width, initial-scale=1, maximum-scale=1">
<!-- Page Description and Author -->
<meta name="description"
	content="Real Time Collaboration| Collaborative Vistaual Camp">
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
	<div class="container">
		<nav class="navbar navbar-inverse navbar-fixed-top"
			style="background-color: cadetblue; border-color: transparent;">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="#"></a>
				</div>
				<ul class="nav navbar-nav">
					<li><a href="home.php" style="color: white;"><span style="color: white;" class="glyphicon glyphicon-th-large"></span>
							<span style="color: white; font-size: 16px;">Dashboard</span></a></li>
					<li><a href="createTeam.php" style="color: white;"><span style="color: white;"
							class="	glyphicon glyphicon-plus-sign"></span> <span
							style="color: white; font-size: 16px;">Create Team</span></a></li>

				</ul>
				<ul class="nav navbar-nav navbar-right">
				<li class="dropdown" style="margin-right:-12px;" id="notiff">

                </li>
					<li class="dropdown"><a class="dropdown-toggle" style="color: white;"
						data-toggle="dropdown" href="#"><span
							style="color: white; font-size: 16px;"><?php echo''.$_SESSION['user'];?></span>
							<span class="caret"></span></a>
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
		<!-- Start Page Banner -->
		<div class="panel panel-default"
			style="background: url(images/slide-02-bg.jpg) center #f9f9f9; margin-top: 60px; margin-left: 5px;">
			<div class="panel-body">
				<h2>Team <span style="text-transform: lowercase;"><?php echo $_GET['teamId']?></span> Files</h2>
				<ul class="breadcrumbs">
					<li><a href="Home.php">Home</a></li>
					<li>Files</li>
				</ul>
			</div>
		</div>
		<!-- End Page Banner -->
		<div class="container">
			<div class="row" style="margin-top: 20px;margin-left:-25px;">
				<div class="col-md-12">
                            <table class="table table-striped">
                          	<tr>

							<form class="form-inline" method="post"
								enctype="multipart/form-data">

								<td>
									<div class="form-group" autocomplete="off">
										<input type="text" class="form-control" id="repos"
											name="repos" placeholder="Repository Name">
									</div>
								</td>
								<td>
									<button type="submit" name="createRepos" method="post"
										class="btn btn-primary"
										onclick=" return checkRepositoryName();">Create Repository</button>
								</td>
							</form>
						</tr>
								  
					</table>
				</div>
			</div>
		</div>
	</div>
	<div>
 
       </div>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<form method="post">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>File Name</th>
							</tr>
						</thead>
						<tbody>
   <?php
			foreach ( $result as $row ) {
				
				?>
<tr>
								<td>
									<button type="submit" class="btn btn-link" id="open"
										name="open" value="<?php echo $row['dirId'];?>">
<p><span class="glyphicon glyphicon-folder-open"></span>&nbsp;
 <?php
	echo $row ['dirName'];
				
	?>
	 
										
										</p>
									</button>
								</td>
</tr>
  </tbody>
   <?php
			}
				
	?>
	 
					</table>
				</form>
			</div>
		</div>
	</div>
	<!-- Rename Model-->
	<form method="post" onsubmit="return checkName();">
		<!-- Modal -->
		<div class="modal fade" id="renameModel" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Rename</h4>
					</div>
					<div class="modal-body">
						<h4 id="par" style="font-size: 16px;"></h4>
						<input type="text" id="hiddenId" name="hiddenId" hidden> New Name:<input
							type="text" name="inputname" id="inputname" />
						<p id="msg"></p>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-default" data-submit="modal"
							method="post" name="rename" id="rename">Submit</button>
						<button type="button" class="btn btn-default" id="close"
							name="close" data-dismiss="modal">Close</button>
					</div>
				</div>

			</div>
		</div>
	</form>
	<!--Creeate Folder Model-->
	<form method="post">
		<!-- Modal -->
		<div class="modal fade" id="createNewFolder" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Create New Folder in Your Workspace</h4>
					</div>
					<div class="modal-body">

						<p>Name</p>
						<input type="text" id="hiddenId" name="hiddenId" hidden> <input
							type="text" name="inputname" id="inputname" />
						<p id="msg"></p>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-default" data-submit="modal"
							method="post" id="createFolder" name="createFolder">Submit</button>
						<button type="button" class="btn btn-default" id="close"
							name="close" data-dismiss="modal">Close</button>
					</div>
				</div>

			</div>
		</div>
	</form>
		
	<script>
function setName(oldName){
	document.getElementById("rename").value=oldName;
	//document.getElementById("inputname").value=oldName;
	document.getElementById("hiddenId").value=oldName;
	var res = oldName.split("+");
	document.getElementById("par").innerHTML="Current Name:"+res[0];
	//document.getElementById("inputname").value=res[1];
	
	
}
function confirmDelete(){
    var r = confirm("Are Sure to delete Document!");
    if (r == true) {
       return true;
    } else {
       return false;
    }
}
function checkFile(){
/*	var fileName=document.getElementById("file");
	
	if(!('files' in fileName)){
		document.getElementById("file").style.borderColor = "red";
		//document.getElementById("file").placeholder="Please Select File";
		return false;
	}
	return true;
*/	
}
function checkRepositoryName(){
	var nname=document.getElementById("repos").value;
	if(nname==""){
		document.getElementById("repos").style.borderColor = "red";
		document.getElementById("repos").placeholder="Enter Repository Name";
		return false;
	}
    else{
  return true;
	}	
	
}
function checkNewDocumentName(){
	var nname=document.getElementById("documentName").value;
	var n = nname.search(".txt");
	var n1 = nname.match("^.*\.txt$");
	var v=nname.indexOf(".");
	
	if(nname==""){
		document.getElementById("documentName").style.borderColor = "red";
		document.getElementById("documentName").placeholder="Enter Doucment  Name";
		return false;
	}
	//else if(n1==null &&v!=-1){
		else if(n1==null){
		if(v!=-1){
		document.getElementById("documentName").value="";
		document.getElementById("documentName").placeholder ="Only .txt Document Allowed";
		document.getElementById("documentName").style.borderColor = "red";
		return false;
			}
			else{
			document.getElementById("documentName").value=nname+".txt";
			}
		
		
	}
	
	return true;
	
}	
	function checkName(){
	var nname=document.getElementById("inputname").value;
	 var n = nname.search(".");
	if(nname==""){
		document.getElementById("msg").innerHTML ="Please Enter Doucment  Name";
		document.getElementById("inputname").style.borderColor = "red";
		document.getElementById("msg").style.color = "red";
		return false;
	}
	else{
	return true;
	}
}
	
</script>


</body>

</html>