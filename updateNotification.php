<?php 
include ("db/opendb.php");
$instance = ConnectDb::getInstance ();
$con = $instance->getConnection ();
ob_start ();
session_start ();
$f="0";
$u=$_SESSION['Id'];
$query1 = "UPDATE notifications SET unread='$f' where recipient_id='".$u."'";
    $con -> query($query1) or die("Update error");

?>