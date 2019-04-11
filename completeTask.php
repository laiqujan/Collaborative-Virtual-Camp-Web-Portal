<?php
//Opening Connection
include("db/opendb.php");
$instance = ConnectDb::getInstance();
$con = $instance->getConnection();
// get the q parameter from URL
    $id=$_REQUEST["id"];
	$email = $_REQUEST["email"];
	$query1 = "UPDATE assigned SET status='Complete' where id='".$id."' and email='".$email."'";
    $con -> query($query1) or die("Update error");	  
?>