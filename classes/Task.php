<?php
class Task {
	private $title;
	private $des;
	public function addTask($title, $description, $con) {
		$insert="insert into todo(title,description)                    
	      values('$title','$description')";
		if ($con->query ( $insert ) == TRUE) {
			return true;
		} else {
			return false;
		}
	}
	
		public function updateStaus($id,$email, $con) {
	    $query1 = "UPDATE assigned SET status='Complete' where id='".$id."' and email='".$email."'";
        $con -> query($query1) or die("Update error");
	}
}

?>