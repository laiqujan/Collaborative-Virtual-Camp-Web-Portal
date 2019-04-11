<?php 
include("db/opendb.php");
$instance = ConnectDb::getInstance();
$con = $instance->getConnection();
ob_start();
session_start();
if ( isset($_SESSION['user'])=="" ) {
        header("Location: login.php");
		exit;
}
if( isset($_GET['teamId'])== TRUE && ($_GET['email']) == TRUE)
	{
		$id = $_GET['teamId'];
		$mail=$_GET['email'];
	try {
    // set the PDO error mode to exception
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // sql to delete a record
    $sql = "delete from jointeam where teamName='" . $id . "' and email='" . $mail. "'";
    // use exec() because no results are returned
    $con->exec($sql);
	 header("Location: viewTeammates.php?teamId=$id");
	//echo "<script language = \"javascript\" type = \"text/javascript\">
	//	window.location.href=\"Home.php\"; </script>";
    //echo "Record deleted successfully ".$id." ".$mail;
    }
      catch(PDOException $e)
    {
      echo $sql . "<br>" . $e->getMessage();
    }

		
		
	  // $query = "delete from jointeam where teamName='" . $id . "' and email='" . $mail. "'";
	  //	$con -> query($query) or die("delete error");		
	}

	
	 $con=NULL; 
?>
