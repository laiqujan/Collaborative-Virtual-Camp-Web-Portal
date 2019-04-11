<?php
// Opening Connection
include ("db/opendb.php");
$instance = ConnectDb::getInstance ();
$con = $instance->getConnection ();

ob_start ();
session_start ();
if (isset ( $_SESSION ['user'] ) == "") {
	header ( "Location: login.php" );
	exit ();
}
$filecontent = "";
$rid = $_GET ['id'];
$loc = $rid;
$now = new DateTime ( null, new DateTimeZone ( 'Asia/Karachi' ) );
$time = $now->format ( 'Y-m-d H:i:s' );
// $newloc=explode("/", $loc);
// $i=count($newloc)-1;
$n = str_replace ( ".txt", "", $loc );
$source = "D:/xampp/htdocs/dms/" . $loc;
$t = str_replace ( ":", "-", $time );
// $tt=str_replace(" ","",$t);
$nn = explode ( "/", $n );
$nn = $nn [0] . "/" . $nn [1];
$name = $nn . "(" . $t . ").txt";

// for saving document
$locc = explode ( "/", $rid );
$locc = $locc [0] . "/" . $locc [1];

// for versioning
$newDoc = $name;
$tid = $_GET ['teamId'];
$docId = $_GET ['docId'];
$dirId = $_GET ['dirId'];
$email = $_GET ['userId'];
;

if (isset ( $_GET ['id'] ) == true) {
	$filename = $_GET ['id'];
	$rid == $filename;
	$ext = pathinfo ( $filename, PATHINFO_EXTENSION );
	if ($ext == "txt") {
		
		$myfile = fopen ( "$filename", "r" ) or die ( "Unable to open file!" );
		if (filesize ( $filename ) != 0) {
			$contentx = fread ( $myfile, filesize ( "$filename" ) );
			$filecontent = trim ( $contentx );
			fclose ( $myfile );
		} else {
			fwrite ( $myfile, "Dummy" );
			fclose ( $myfile );
		}
	} else {
		$striped_content = '';
		$content = '';
		$zip = zip_open ( $filename );
		if (! $zip || is_numeric ( $zip ))
			return false;
		while ( $zip_entry = zip_read ( $zip ) ) {
			if (zip_entry_open ( $zip, $zip_entry ) == FALSE)
				continue;
			if (zip_entry_name ( $zip_entry ) != "word/document.xml")
				continue;
			$content .= zip_entry_read ( $zip_entry, zip_entry_filesize ( $zip_entry ) );
			zip_entry_close ( $zip_entry );
		} // end while
		zip_close ( $zip );
		$content = str_replace ( '</w:r></w:p></w:tc><w:tc>', " ", $content );
		$content = str_replace ( '</w:r></w:p>', "\r\n", $content );
		$striped_content = strip_tags ( $content );
		$filecontent = $striped_content;
	}
}
if (isset ( $_POST ['invite'] ) == true) {
	$email = $_POST ['email'];
	$link = $_POST ['link'];
	// Send Email Notification
	$Aname = "CVC";
	$message = "Please Open Provided Link..<br>" . $link;
	$subject = "Welcome to CVC";
	$to = $email;
	$message = 'FROM: ' . $Aname . ' Message: ' . $message;
	$headers = 'From: support@cvc.com' . "\r\n";
	if (filter_var ( $to, FILTER_VALIDATE_EMAIL )) { // this line checks that we have a valid email address
		mail ( $to, $subject, $message, $headers ); // This method sends the mail.
		$errTyp = "success";
		$errMSG = "Inivitation Sent";
	}
}
if (isset ( $_POST ['share'] ) == true) {
	$link1 = $_POST ['link1'];
	$qu = "select * from jointeam where teamName='$tid'";
	$re = $con->query ( $qu ) or die ( "sql error" );
	$now = new DateTime ( null, new DateTimeZone ( 'Asia/Karachi' ) );
	$time = $now->format ( 'Y-m-d H:i:s' );
	$name = $_SESSION ['user'];
	$nn = $_SESSION ['Id'];
	$time = $time . " " . $name;
	foreach ( $re as $r ) {
		{
			$email = $r ['email'];
			$insert = "insert into message(senderId,recipient,message,teamId,time)                    
	         values('$nn','$email','$link1','$tid','$time')";
			$con->query ( $insert );
		}
	}
	$errTyp = "success";
	$errMSG = "Inivitation Sent";
}

?>

<html>
<head>
<title>CVC|Real Time Collaboration</title>
<meta charset="utf-8">
<!-- Responsive Metatag -->
<meta name="viewport"
	content="width=device-width, initial-scale=1, maximum-scale=1">
<!-- Page Description and Author -->
<meta name="description"
	content="Real Time Collaboration| Real time editing">
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
<!--<script src="togetherjs-min.js" type="text/javascript"></script>
<script src="assets/wp-togetherjs.css" type="text/javascript"></script>
<script src="assets/wp-togetherjs.js" type="text/javascript"></script> -->

<!--[if IE 8]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->



<!-- Firebase -->
<script src="https://www.gstatic.com/firebasejs/3.3.0/firebase.js"></script>

<!-- CodeMirror -->
<script
	src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.17.0/codemirror.js"></script>
<link rel="stylesheet"
	href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.17.0/codemirror.css" />

<!-- Firepad -->
<link rel="stylesheet"
	href="https://cdn.firebase.com/libs/firepad/1.4.0/firepad.css" />
<script src="https://cdn.firebase.com/libs/firepad/1.4.0/firepad.min.js"></script>

<style>
html {
	height: 100%;
}

#firepad-container {
	width: 100%;
	height: 100%;
}
</style>


</head>
<body onload="init()">
	<div class="container">
		<nav class="navbar navbar-inverse navbar-fixed-top"
			style="background-color: cadetblue; border-color: transparent;">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="#"></a>
				</div>
				<ul class="nav navbar-nav">
					<li><a href="home.php"><span style="color: white;" class="glyphicon glyphicon-th-large"></span>
							<span style="color: white; font-size: 16px;">Dashboard</span></a></li>
					<li><a href="createTeam.php"><span style="color: white;"
							class="	glyphicon glyphicon-plus-sign"></span> <span 
							style="color: white; font-size: 16px;">Create Team</span></a></li>
					<li><a href="#" data-toggle="modal" data-target="#myModal"><span style="color: white;"
							class="glyphicon glyphicon-share"></span><span
							style="color: white; font-size: 16px;"> Collaborate With Team</span></a></li>
					<li><a href="#" data-toggle="modal" data-target="#myModal2"><span style="color: white;"
							class="glyphicon glyphicon-share"></span><span
							style="color: white; font-size: 16px;"> Share Link</span></a></li>
					<li>
						<button class="btn btn-link" onclick="sav();"
							style="margin-top: 8px">
							<span style="color: white;" class="glyphicon glyphicon-save-file"></span><span
								style="color: white; font-size: 16px;"> Save</span>
						</button>
					</li>
					<li><a href="#" data-toggle="modal" data-target="#myModal3"> <span style="color: white;"
							class="glyphicon  glyphicon-save-file"></span><span
							style="color: white; font-size: 16px;"> Committ</span>
					</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown"><a class="dropdown-toggle"
						data-toggle="dropdown" href="#"><span
							style="color: white; font-size: 16px;">
	   <?php echo''.$_SESSION['user'];?></span> <span class="caret"></span></a>
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
			style="background: url(images/slide-02-bg.jpg) center #f9f9f9; margin-top: 60px; margin-left: 16px; height: 130px;">
			<div class="panel-body">
				<h2 style="">Real-Time Collaboration</h2>
				<ul class="breadcrumbs">
				
					<li><a href="files.php?teamId=<?php echo $tid;?>">Files</a></li>
					<li><a href="files.php?teamId=<?php echo $tid;?>&dirId=<?php echo $_GET ['dirId']; ?>"><?php echo $_GET ['dirName'];?></a></li>
					<li>Editor</li>
				</ul>
			</div>
		</div>
		<!-- End Page Banner -->

		<div class="container">
			<div class="row" style="margin-top: 20px;">
				<div class="col-md-12">
 <?php
	if (isset ( $errMSG )) {
		
		?>
                    <div class="col-sm-12">
						<div class="form-group">
							<div
								class="alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?>">
								<span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
				<a
									href="editDocument.php?id=<?php echo $rid;?>&teamId=<?php echo $tid;?>">Refresh</a>
							</div>
						</div>
					</div>
                <?php
	}
	?>

 
</div>
				<div>
					<form method="post" name="inviteTeam">
						<!-- Modal -->
						<div class="modal fade" id="myModal" role="dialog">
							<div class="modal-dialog">

								<!-- Modal content-->
								<div class="modal-content">
									<div class="modal-header"
										style="background-color: LightSeaGreen;">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title">Share Link With Team</h4>
									</div>
									<div class="modal-body">

										<p>LINK</p>
										<input type="text" name="link1" placeholder="Paste Link"
											id="link1"
											style="width: 400px; border-radius: 3px; height: 40px;" /> <br />
										<br />
									</div>
									<div class="modal-footer"
										style="background-color: LightSeaGreen;">
										<button type="submit" class="btn btn-default"
											data-submit="modal" method="post" name="share" id="share">Invite</button>
										<button type="button" class="btn btn-default" id="close"
											name="close" data-dismiss="modal">Close</button>
									</div>
								</div>

							</div>
						</div>
					</form>
				</div>
				<!-- Modal -->
				<div>
					<form method="post" name="inviteForm"
						onsubmit="return ValidateEmail();">
						<!-- Modal -->
						<div class="modal fade" id="myModal2" role="dialog">
							<div class="modal-dialog">

								<!-- Modal content-->
								<div class="modal-content">
									<div class="modal-header"
										style="background-color: LightSeaGreen;">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title">Share Link Via Email</h4>
									</div>
									<div class="modal-body">
										<p>LINK</p>
										<input type="text" name="link2" placeholder="Paste Link"
											id="link2"
											style="width: 400px; border-radius: 3px; height: 40px;" /> <br />
										<br />
										<p>Email</p>
										<input type="text" name="email" placeholder="Email"
											class="form-control" id="email"
											style="width: 400px; border-radius: 3px; height: 40px;" /> <br />
										<br />
									</div>
									<div class="modal-footer"
										style="background-color: LightSeaGreen;">
										<button type="submit" class="btn btn-default"
											data-submit="modal" method="post" name="share" id="share">Invite</button>
										<button type="button" class="btn btn-default" id="close"
											name="close" data-dismiss="modal">Close</button>
									</div>
								</div>

							</div>
						</div>
					</form>
				</div>
				<!-- Modal -->
				<div>
					<form method="post" name="commitForm">
						<!-- Modal -->
						<div class="modal fade" id="myModal3" role="dialog">
							<div class="modal-dialog">

								<!-- Modal content-->
								<div class="modal-content">
									<div class="modal-header"
										style="background-color: LightSeaGreen;">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title">What is New In this Version</h4>
									</div>
									<div class="modal-body">

										<p>Message(<span style="color:red;font-size:12px;">*</span>)</p>
										<textarea rows="5" cols="60" name="message" id="message"
											placeholder="message"></textarea>
									</div>
									<div class="modal-footer"
										style="background-color: LightSeaGreen;">
										<button type="submit" class="btn btn-default"
											data-submit="modal" method="post" name="commit" id="commit"
											onclick="return make_version();">Committ</button>
										<button type="button" class="btn btn-default" id="close"
											name="close" data-dismiss="modal">Close</button>
									</div>
								</div>

							</div>
						</div>
					</form>
				</div>
				<!-- Modal -->
				<!-- Modal -->
				<div class="modal fade" id="messageModel" role="dialog">
					<div class="modal-dialog">

						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">File Saved</h4>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default"
									data-dismiss="modal">Close</button>
							</div>
						</div>

					</div>
				</div>
				<!-- Modal -->
				<script>
      var firepad;
    function init() {
      //// Initialize Firebase.
      //// TODO: replace with your Firebase project configuration.
      var config = {
        apiKey: "AIzaSyC_JdByNm-E1CAJUkePsr-YJZl7W77oL3g",
        authDomain: "firepad-tests.firebaseapp.com",
        databaseURL: "https://firepad-tests.firebaseio.com"
      };
      firebase.initializeApp(config);
      //// Get Firebase Database reference.
      var firepadRef = getExampleRef();
      //// Create CodeMirror (with lineWrapping on).
      var codeMirror = CodeMirror(document.getElementById('firepad-container'), { lineWrapping: true });

      //// Create Firepad (with rich text toolbar and shortcuts enabled).
      firepad = Firepad.fromCodeMirror(firepadRef, codeMirror,
          { richTextToolbar: true, richTextShortcuts: true });
      //// Initialize contents.
     firepad.on('ready', function() {
        if (firepad.isHistoryEmpty()) {
          firepad.setHtml('<?php echo  $filecontent; ?>');
        }
      })
	var str=window.location.href;
	//document.getElementById("link").value=str;
	document.getElementById("link1").value=str;
	document.getElementById("link2").value=str;
    }

    // Helper to get hash from end of URL or generate a random one.
    function getExampleRef() {
      var ref = firebase.database().ref();
      var hash = window.location.hash.replace(/#/g, '');
      if (hash) {
        ref = ref.child(hash);
      } else {
        ref = ref.push(); // generate unique location.
        window.location = window.location + '#' + ref.key; // add it as a hash to the URL.
		
		//var v=window.location + '#' + ref.key;
	    
		
      }
      if (typeof console !== 'undefined') {
        console.log('Firebase data: ', ref.toString());
      }
      return ref;
    }

function checkDes(){
	//alert(document.getElementById("hiddenId").value);
	//var email=document.getElementById("email");
	var nname=document.getElementById("message").value;
	if(nname==""){
		document.getElementById("message").placeholder ="Please Enter Link For Collaboration";
		document.getElementById("message").style.borderColor = "red";
		document.getElementById("message").style.color = "red";
		return false;
	}
}

function ValidateEmail()   
{  
var email=document.getElementById("email").value;
var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/; 
var link=document.getElementById("link2").value; 
if(email.match(mailformat)&&link!="")  
{  
return true;  
}  
else  
{  
if(link==""){
document.getElementById("link2").style.borderColor = "red";
document.getElementById("link2").placeholder="Please Enter Link";
return false; 
}
if(!email.match(mailformat)){
document.getElementById("email").style.borderColor = "red";
document.getElementById("email").placeholder="Invalid Email";
return false; 
}
}
}

function sav(){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
		var content=firepad.getHtml();
		//var v=firepad.getHtml();
		var name="<?php echo $locc;?>";
		//alert(v);
        xmlhttp.open("GET", "save.php?data="+content+"&loc="+name, true);
        xmlhttp.send();
        $('#messageModel').modal('show');
}

function make_version(){
	var nname=document.getElementById("message").value;
	if(nname==""){
		document.getElementById("message").placeholder ="Please Enter Link For Collaboration";
		document.getElementById("message").style.borderColor = "red";
		document.getElementById("message").style.color = "red";
		return false;
	}
	else{
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
		var content=firepad.getHtml();
		//var v=firepad.getHtml();
		var dirId="<?php echo $dirId;?>";
		var docId="<?php echo $docId;?>";
		var email="<?php echo $email;?>";
		var location="<?php echo $newDoc;?>";
        var teamId="<?php echo $tid ;?>";		
		var mlocation="<?php echo $rid;?>";
		var us="<?php echo $_SESSION['user'];?>";
	   //  alert(dirId+docId+email+location);
       xmlhttp.open("GET", "comit.php?data="+content+"&loc="+location+"&dirId="+dirId+"&docId="+docId+"&email="+email+"&msg="+nname+"&us="+us+"&mlocation="+mlocation+"&teamId="+teamId, true);
       xmlhttp.send();
       return true;
				
	}
}
</script>


				<div class="row">
					<div class="col-md-12">
						<label for="comment" style="color: silver">&nbsp;&nbsp;&nbsp;&nbsp;Real-Time
							Collaborative Editor</label>
						<div id="firepad-container"></div>

					</div>

				</div>
			</div>
		</div>
	</div>
</body>
</html>