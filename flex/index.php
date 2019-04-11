
<?php
include ("db/opendb.php");
$instance = ConnectDb::getInstance ();
$con = $instance->getConnection ();
ob_start ();
session_start ();
   $nn=$_SESSION['Id'];
    $teamName="CVC";
	$query1="select * from user,jointeam where user.email=jointeam.email and jointeam.teamName='$teamName' and user.email!='$nn' and status='joined'";
	$result1 = $con -> query($query1) or die("sql error");
	$username="";
	if (isset ( $_POST ['user'] ) == true) {
		$username=$_POST ['user'];
	}
    $query2="select * from message where (senderId='$nn' and recipient='$username') or (senderId='$username' and recipient='$nn') and teamId='$teamName'";
	$result2 = $con -> query($query2) or die("sql error");
    $url="index.php?user='$username'";
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
<meta http-equiv="refresh" content="200;url='<?php echo $url; ?>'">
 <!-- <meta http-equiv="refresh" content="100;url='<?php echo $url; ?>'"> --->
  <title>Flexboxin' it</title>
  <link rel="stylesheet" href="css/font-awesome.min.css">
  
      <link rel="stylesheet" href="css/style.css">
  
</head>

<body>
  <div class="container">
  <div class="contacts">
    <div class="buttons" style="margin-top:20px;">
      <a href="Home.php" style="margin-left:20px;font-size:24px;text-decoration:none;color:black">Dashboard</a>
    </div>
    <ul style="margin-left:-6px;margin-top:20px;">
	<form method="post" name="userForm">
	 			  <?php 
			  $i=0;
	        foreach($result1 as $row1)
	         {
		 $i++;
	            ?>
        <button type="submit" name="user" style="width:200px;height:40px;color:silver;font-size:16px;" value="<?php echo $row1['email'] ;?>">
		<?php echo $row1['name'] ;?></button><br/>
			 <?php
 
	  }
	  ?>
	 
	  </form>
    </ul>
  </div>
  <div class="messages">
    <ul>
   
     <?php 
	        foreach($result2 as $row2)
	         {
          	?>
      <li>
  <?php echo $row2['message'] ;?>
      </li>
	  <?php
	  }
	  ?>
    </ul>
  </div>
 <div class="stack-wrap"></div>
  <div class="form">
  <input type="text" name="message" id="message" style="width:1108px;height:50px" onkeypress="runScript(event,this.value)" />
  </div>
</div>
 <script>
	function runScript(e,v)
	{
         if (e.keyCode == 13)
		 {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
         if (this.readyState == 4 && this.status == 200) 
		{
                //document.getElementById("txtHint").innerHTML = this.responseText;
        }
        };
		var rId="<?php echo $username;?>";
		var teamId="<?php echo $teamName;?>";
		var n="<?php echo $nn; ?>";
		var msg=v;
		document.getElementById("message").value="";
        xmlhttp.open("GET", "send.php?message="+msg+"&rId="+rId+"&teamId="+teamId+"&nn="+n, true);
        xmlhttp.send();
		
		//alert("sent");
		}	
   }
</script>
<script src="js/index.js"></script>

</body>
</html>
