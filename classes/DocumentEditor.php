<?php
class DocumentEditor {
	private $fileName;
	private $location;
	public function save($name, $email, $contactNo, $profession, $password, $con) {
		$insert = "insert into user(email,name,contactNo,profession,password)
		values('$email','$name','$contactNo','$profession','$password')";
		if ($con->query ( $insert ) == TRUE) {
			return true;
		} else {
			return false;
		}
	}
		public function commit($name, $email, $contactNo, $profession, $password, $con) {
		$insert = "insert into user(email,name,contactNo,profession,password)
		values('$email','$name','$contactNo','$profession','$password')";
		if ($con->query ( $insert ) == TRUE) {
			return true;
		} else {
			return false;
		}
	}
	
}

?>