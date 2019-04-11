<?php
class Document {
	private $name;
	private $Id;
	private $location;
	public function create($email, $teamId, $newDoc,$dId,$loc,$time,$con) {		
		$sql1 = "insert into document(email,teamName,docName,location,dirId,creationDate)values(:email,:teamName,:docName,:location,:dirId,:creationDate)";
	    $d="Initial Version";
		try {
			$stmt = $con->prepare ( $sql1);
			$stmt->bindParam ( ':email', $email );
			$stmt->bindParam ( ':teamName', $teamId );
			$stmt->bindParam ( ':docName', $newDoc );
			$stmt->bindParam ( ':location', $loc);
			$stmt->bindParam ( ':dirId', $dId);
			$stmt->bindParam ( ':creationDate', $time );
			$stmt->execute ();
			$last_id = $con->lastInsertId ();
			$loc2=str_replace(".txt","(0).txt",$loc);
			$sql2 = "insert into documentstate(dirId,docId,email,location,des,updationDate)values(:dirId,:docId,:email,:location,:des,:updationDate)";
			$stmt = $con->prepare ( $sql2 );
			$stmt->bindParam ( ':dirId', $dId);
			$stmt->bindParam ( ':docId', $last_id);
			$stmt->bindParam ( ':email', $email);
			$stmt->bindParam ( ':location', $loc2);
			$stmt->bindParam ( ':des', $d);
			$stmt->bindParam ( ':updationDate', $time);
			$stmt->execute ();
			$myfile = fopen ( $loc, "w" ) or die ( "Unable to open file!" );
			fclose ( $myfile );
		
			$myfile1 = fopen ( $loc2, "w" ) or die ( "Unable to open file!" );
			fclose ( $myfile1 );
			
			return true;
		} catch ( PDOException $e ) {
			// $msg= $e->getMessage();
			return false;
		}
	}
public function upload($email, $teamId, $newDoc,$dId,$loc,$time,$con) {		
	$sql1 = "insert into document(email,teamName,docName,location,dirId,creationDate)values(:email,:teamName,:docName,:location,:dirId,:creationDate)";
	    $d="Initial Version";
		try {
			$stmt = $con->prepare ( $sql1);
			$stmt->bindParam ( ':email', $email );
			$stmt->bindParam ( ':teamName', $teamId );
			$stmt->bindParam ( ':docName', $newDoc );
			$stmt->bindParam ( ':location', $loc);
			$stmt->bindParam ( ':dirId', $dId);
			$stmt->bindParam ( ':creationDate', $time );
			$stmt->execute ();
			$last_id = $con->lastInsertId ();
		    $loc2=str_replace(".txt","(0).txt",$loc);
			$sql2 = "insert into documentstate(dirId,docId,email,location,des,updationDate)values(:dirId,:docId,:email,:location,:des,:updationDate)";
			$stmt = $con->prepare ( $sql2 );
			$stmt->bindParam ( ':dirId', $dId);
			$stmt->bindParam ( ':docId', $last_id);
			$stmt->bindParam ( ':email', $email);
			$stmt->bindParam ( ':location', $loc2);
			$stmt->bindParam ( ':des', $d);
			$stmt->bindParam ( ':updationDate', $time);
			$stmt->execute ();
			$myfile = fopen ( $loc, "w" ) or die ( "Unable to open file!" );
			fclose ( $myfile );
			$myfile1 = fopen ( $loc2, "w" ) or die ( "Unable to open file!" );
			fclose ( $myfile1 );
			return true;
		} catch ( PDOException $e ) {
			// $msg= $e->getMessage();
			return false;
		}
	}
	public function deleteRevision($delname,$RevId,$con) {
		if(unlink ( $delname ))
		{
		//$query1 = "delete from document where docName='" . $delname . "'";
		//$con->query ( $query1 ) or die ( "Delete error" );
		$query2 = "delete from documentstate where RevId='" . $RevId  . "'";
		$con->query ( $query2 ) or die ( "Delete error" );
		return true;
	     }
		 else{
			 return false;
		 }
	}
	public function deleteMaster($delname,$docId,$con) {
		if(unlink ( $delname ))
		{
		//$query1 = "delete from document where docName='" . $delname . "'";
		//$con->query ( $query1 ) or die ( "Delete error" );
		$query2 = "delete from document where Id='" . $docId  . "'";
		$con->query ( $query2 ) or die ( "Delete error" );
		return true;
	     }
		 else{
			 return false;
		 }
	}
	public function rename($oldname, $newname,$titleName,$RevId,$docId, $con) {
		// Getting Extension
		// $ext = pathinfo($oldname, PATHINFO_EXTENSION);
		$titleName=$titleName.".txt";
		if(rename ($oldname, $newname )){
		$query1 = "UPDATE document SET docName='" . $titleName . "' where Id='" . $docId . "'";
		$con->query ( $query1 ) or die ( "Update error" );
		$query3 = "UPDATE document SET location='" . $newname . "' where Id='" . $docId . "'";
		$con->query ( $query3 ) or die ( "Update error" );
		//quotemeta($newname);
		//$query2 = "UPDATE documentstate SET location='" . $newname . "' where RevId='" . $RevId . "'";
		//$con->query ( $query2 ) or die ( "Update error" );
		return true;
		}
		else{
			return false;
		}
	
	}
	public function download($file) {
		if (file_exists ( $file )) {
			header ( 'Content-Description: File Transfer' );
			header ( 'Content-Type: application/octet-stream' );
			header ( 'Content-Disposition: attachment; filename="' . basename ( $file ) . '"' );
			header ( 'Expires: 0' );
			header ( 'Cache-Control: must-revalidate' );
			header ( 'Pragma: public' );
			header ( 'Content-Length: ' . filesize ( $file ) );
			readfile ( $file );
			exit ();
		}
	}
	public function getDirName($dId, $con) {
		$sql = "select * from directory where dirId='$dId'";
		$name = "";
		try {
			$result = $con->query ( $sql );
			foreach ( $result as $row ) {
				$name = $row ['dirName'];
			}
		} catch ( PDOException $e ) {
			$errTyp = "danger";
			$errMSG = "Something went wrong, try again later...";
		}
		return $name;
	}
}
?>