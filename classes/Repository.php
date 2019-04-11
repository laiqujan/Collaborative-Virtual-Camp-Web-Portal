<?php
class Repository {
	private $repName;
	private $location;
		private $teamName;
	public function createRepository($rid, $target_file, $newFolder,$con) {
		  
		$sql = "insert into directory(teamName,dirName,location)values(:teamName,:dirName,:location)";
		// $dummy="3";
		try {
			$stmt = $con->prepare ( $sql );
			$stmt->bindParam ( ':teamName', $rid );
			$stmt->bindParam ( ':dirName', $target_file );
			$stmt->bindParam ( ':location', $newFolder );
			$stmt->execute ();
			mkdir ( $target_file );
			return true;
		} catch ( PDOException $e ) {
			// $msg= $e->getMessage();
			return false;
		}
		  
	}
	
}

?>