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
$name=$_REQUEST["name"];
//$now = new DateTime();
$now = new DateTime(null, new DateTimeZone('Asia/Karachi'));
$time=$now->format('Y-m-d H:i:s'); 
$time=$time." ".$name;
//query
$insert ="insert into message(senderId,recipient,message,teamId,time)                    
	     values('$nn','$rId','$message','$teamId','$time')";
		 $con->query ($insert);
		
		  
?>