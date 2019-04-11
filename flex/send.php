<?php
//Opening Connection
include("db/opendb.php");
$instance = ConnectDb::getInstance();
$con = $instance->getConnection();
// get the q parameter from URL
$nn=$_REQUEST["nn"];
$rId = $_REQUEST["rId"];
$teamId=$_REQUEST["teamId"];
$message=$_REQUEST["message"];
//query
$insert ="insert into message(senderId,recipient,message,teamId,time)                    
	     values('$nn','$rId','$message','$teamId','4:41Pm')";
		 $con->query ($insert);
		  
?>