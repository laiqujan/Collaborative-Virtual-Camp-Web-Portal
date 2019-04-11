<?php
$filecontent="";
if(isset($_GET['id'])==true){
  $filename = $_GET['id'];
  $myfile = fopen("$filename", "r") or die("Unable to open file!");
  $filecontent =  fread($myfile,filesize("$filename"));
  fclose($myfile);
}
?>

<html>
<head>
<script>
function sav(str) {
	 if (str.length == 0) { 
        //document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //document.getElementById("txtHint").innerHTML = this.responseText;
            }
        }
		
        xmlhttp.open("GET", "save.php?q="+str, true);
        xmlhttp.send();
				
    }
}
</script>

<title>Collaborative Virtual Camp</title>
  <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="css/bootstrap.min.css">
   <script src="js/bootstrap.min.js" ></script>
   <script src="js/jquery-1.11.3.min.js"></script>
<script src="togetherjs-min.js" type="text/javascript"></script>
<script src="assets/wp-togetherjs.css" type="text/javascript"></script>
<script src="assets/wp-togetherjs.js" type="text/javascript"></script>
</head>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">CVC </a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Home</a></li>
      <li><a href="#">Services</a></li>
      <li><a href="#">About</a></li> 
	  <li><a href="#">Contact</a></li> 
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
      <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
    </ul>
  </div>
</nav>

<div class="container">
<hr/>
   <form name="form1" method="post" enctype="multipart/form-data">
  
  <a href="#" id="start-togetherjs" class="togetherjs-button" onclick="TogetherJS(this); return false;">
  Collaborate</a>
<hr/>

  <div class="row">
    <div class="col-sm-12">
    <div class="form-group">
      <label for="comment"style="color:silver">Real-Time Editor</label>
      <textarea class="form-control" rows="20" cols="36" id="comment" name="text" onkeyup="sav(this.value)">
	  <?php echo $filecontent ?></textarea>
    </div>
  </form>
	</div>
    
  </div>

</div>
<footer style="background-color: #555;color: white;padding: 15px;" class="container-fluid text-center">
  <p> Copyright &copy; <a href="techwaly.com" style="color:white">Techwaly.com</a> &nbsp;2016</p>
  <p><a href="techwaly.com" style="color:white">Facbook</a></p>
  <p><a href="techwaly.com" style="color:white">Twiiter</a><p>
</footer>


</body>
</html>