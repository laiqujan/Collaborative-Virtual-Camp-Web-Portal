<?php
class Team {
	private $name;
	private $category;
	private $description;
	public function createTeam($id, $name, $category, $message, $con) {
		$insert = "insert into team(email,teamName,category,description)
		values('$id','$name','$category','$message')";
		$isAdmin = "yes";
		$status = "joined";
		$insert1 = "insert into jointeam(teamName,email,isAdmin,status)
		values('$name','$id','$isAdmin','$status')";
		if ($con->query ( $insert ) == TRUE) {
			Team::invitePeople ( $insert1, $con );
			return true;
		} else {
			return false;
		}
	}
	public function invitePeople($insert1, $con) {
		$con->query ( $insert1 );
	}
	public function updateTeam($teamName, $category, $description, $con) {
		$insert = "Update team SET category='" . $category . "',
			description='" . $description . "' where teamName='$teamName'";
		if ($con->query ( $insert ) == TRUE) {
			return true;
		} else {
			return false;
		}
	}
	public function deleteTeam($id, $con) {
		$query1 = "delete from joinTeam where teamName='" . $id . "'";
		$query = "delete from team where teamName ='" . $id . "'";
		$con->query ( $query1 ) or die ( "delete error" );
		$con->query ( $query ) or die ( "delete error" );
	}
	public function leaveTeam($id, $mail, $con) {
		try {
			// set the PDO error mode to exception
			$con->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			// sql to delete a record
			$sql = "delete from jointeam where teamName='" . $id . "' and email='" . $mail . "'";
			// use exec() because no results are returned
			$con->exec ( $sql );
			// echo "Record deleted successfully";
		} catch ( PDOException $e ) {
			// echo $sql . "<br>" . $e->getMessage();
		}
	}
}

?>

