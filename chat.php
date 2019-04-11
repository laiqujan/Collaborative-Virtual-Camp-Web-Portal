<?php
include ("db/opendb.php");
$instance = ConnectDb::getInstance ();
$con = $instance->getConnection ();
ob_start ();
session_start ();
    $nn=$_SESSION['Id'];
    $teamName=$_GET['teamId'];
	
	//query for getting all teamates
	$query1="select * from user,jointeam where user.email=jointeam.email and jointeam.teamName='$teamName' and user.email!='$nn' and status='joined'";
	$result1 = $con -> query($query1) or die("sql error");
	//query for getting name of selected person
	$q="select * from user,jointeam where user.email=jointeam.email and jointeam.teamName='$teamName' and user.email!='$nn' and status='joined'";
	$res = $con -> query($q) or die("sql error");
	$username="";//for getting mail address
	$name="";//for getting name of teamates
    foreach($res as $row)
	        {
			$username=$row['email'];
			$name=$row['name'];
			break;
			}	
	if (isset ($_POST ['user'] ) == true) {
		$username=$_POST ['user'];
		$qu="select * from user where email='$username'";
		$re = $con -> query($qu) or die("sql error");
	    foreach($re as $r)
	         {
			$name=$r['name'];
			 }
	}
     //$url="chat.php?teamId='$teamName'";
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">

 <!-- <meta http-equiv="refresh" content="5;URL='chat.php?teamId=<//?php echo $teamName; ?>'">  --->
  <title>CVC-Messenger</title>
  <link rel="stylesheet" href="css/font-awesome.min1.css">
  
      <link rel="stylesheet" href="css/style1.css">
  	<script>
		function ajax(){
		
		var req = new XMLHttpRequest();
		
		req.onreadystatechange = function(){
		
		if(req.readyState == 4 && req.status == 200){
		
		document.getElementById('messages').innerHTML = req.responseText;
		} 
		}
		var rId="<?php echo $username;?>";
		var teamId="<?php echo $teamName;?>";
		var n="<?php echo $nn; ?>";
		req.open('GET','refresh.php?nn='+n+'&username='+rId+'&teamName='+teamId,true); 
		req.send();
		
		}
		setInterval(function(){ajax()},1000);
	</script>
</head>

<body onload="ajax();">
  <div class="container">
  <div class="contacts">
    <div class="buttons" style="margin-top:20px;">
      <a href="Home.php" style="margin-left:20px;font-size:24px;text-decoration:none;color:white">Dashboard</a><br/>
    </div>
	<div id="loadContacts">
    <ul style="margin-left:-6px;margin-top:20px;">
	<form method="post" name="userForm">
	 	<?php 
		$i=0;
	    foreach($result1 as $row1)
	    {
		 $i++;
	     ?>			
        <button type="submit" name="user" id="user" style="width:200px;height:50px;color:silver;font-size:16px;" onclick="changecolor(this);";
		value="<?php echo $row1['email'] ;?>">
		<?php echo $row1['name'] ;?></button><br/>
	    <?php
	    }
	  ?>
	 
	  </form>
    </ul>
	</div>
  </div>
   <div style="background-color:silver;height:80px;"><br/><h4 align="center" style="color:cadetblue;"><?php echo $name;?> (Team <?php echo $teamName; ?>)</h4></div>
  <div class="messages" id="messages">
 
  </div>
 <div class="stack-wrap"></div>
 
  <div class="form">
  <input type="text" name="message" id="message" style="width:1108px;height:50px" onkeypress="runScript(event,this.value)" />
  
  </div>

</div>
 <script>
 
    function changecolor(bt){
	//bt.style.borderColor="green";
	//document.getElementById("hid").value=bt.value;	
	}
	function runScript(e,v)
	{
	
         if (e.keyCode == 13)
		 {
        var xmlhttp = new XMLHttpRequest();
      /*  xmlhttp.onreadystatechange = function() {
         if (this.readyState == 4 && this.status == 200) 
		{
          //document.getElementById("txtHint").innerHTML = this.responseText;
        }
        };*/
		var rId="<?php echo $username;?>";
		var teamId="<?php echo $teamName;?>";
		var n="<?php echo $nn; ?>";
		var msg=v;
		var name="<?php echo $_SESSION['user']; ?>";
		document.getElementById("message").value="";
        xmlhttp.open("GET", "send.php?message="+msg+"&rId="+rId+"&teamId="+teamId+"&nn="+n+"&name="+name, true);
        xmlhttp.send();
		 
		
		
		//location.reload();
		//alert("sent");
		}	
   }
</script>
<script src="js/index1.js"></script>
</body>
</html>
