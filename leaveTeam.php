<?php
include ("db/opendb.php");
$instance = ConnectDb::getInstance ();
$con = $instance->getConnection ();
ob_start ();
session_start ();
if (isset ( $_SESSION ['user'] ) == "") {
	header ( "Location: login.php" );
	exit ();
}
if (isset ( $_GET ['teamId'] ) == TRUE) {
	$id = $_GET ['teamId'];
	$mail = $_SESSION ['Id'];
	include ("classes/Team.php");
	$team = new Team ();
	$team->leaveTeam ( $id, $mail, $con );
	echo "<script language = \"javascript\" type = \"text/javascript\">
	window.location.href=\"Home.php\"; </script>";
}

$con = NULL;
?>
