<?php
//Opening Connection
include("db/opendb.php");
$instance = ConnectDb::getInstance();
$con = $instance->getConnection();
// get the q parameter from URL
$msgg = $_REQUEST["msg"];
//$date = $_REQUEST["date"];
//$n=$_SESSION ['user'];
//$date=$date."\nLast Modified by ".$n; 
$data = $_REQUEST["data"];
$filename=$_REQUEST["loc"];
$dirId = $_REQUEST["dirId"];
$teamId=$_REQUEST["teamId"];
$docId=$_REQUEST["docId"];
$email = $_REQUEST["email"];
$mlocation=$_REQUEST["mlocation"];
$myfile1 = fopen("$mlocation", "w") or die("Unable to open file!");
fwrite($myfile1, $data);
$myfile = fopen("$filename", "w") or die("Unable to open file!");
fwrite($myfile, $data);
fclose($myfile);


	/*require_once ("classes/Notificaton.php");
	$notf = new Notifications ();
	$sender_id=$_SESSION['Id'];
	$dess=$_SESSION['user']." commited new version of file in Team ".$mlocation;
	$ref="files.php?teamId=".$teamId."&dirId=".$dirId;
	*/
	$now = new DateTime ( null, new DateTimeZone ( 'Asia/Karachi' ) );
    $ctime = $now->format ( 'Y-m-d H:i:s' );
	$n=$_REQUEST['us'];
	$ctime=$ctime."\nLast Modified by  ".$n; 
    $msg="";
        try {
		    $sql2 = "insert into documentstate(dirId,docId,email,location,des,updationDate)values(:dirId,:docId,:email,:location,:des,:updationDate)";
			$stmt = $con->prepare ( $sql2 );
			$stmt->bindParam ( ':dirId', $dirId);
			$stmt->bindParam ( ':docId', $docId);
			$stmt->bindParam ( ':email', $email);
			$stmt->bindParam ( ':location',$filename);
			$stmt->bindParam ( ':des',$msgg);
			$stmt->bindParam ( ':updationDate',$ctime);
			$stmt->execute ();
			
			//$notf->addNotification ($teamId,$sender_id,$dess,$ref,$con);

			
		} catch ( PDOException $e ) {
			$msg= $e->getMessage();
		
		}


//$my = fopen("log.txt", "w") or die("Unable to open file!");
//fwrite($my, $msg);
//fclose($myfile);

?>