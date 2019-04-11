<?php
include ("db/opendb.php");
$instance = ConnectDb::getInstance ();
$con = $instance->getConnection ();
ob_start ();
session_start ();
$nn=$_REQUEST["nn"];
$teamName=$_REQUEST["teamName"];
$query1="select * from user,jointeam where user.email=jointeam.email and jointeam.teamName='$teamName' and user.email!='$nn' and status='joined'";
$result1 = $con -> query($query1) or die("sql error");
?>
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


