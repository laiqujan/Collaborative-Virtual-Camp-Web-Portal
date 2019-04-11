<?php
class User {
	private $userName;
	private $email;
	private $profession;
	private $contactNo;
	private $pass;
	public function signup($name, $email, $contactNo, $profession, $password, $con) {
		$insert = "insert into user(email,name,contactNo,profession,password)
		values('$email','$name','$contactNo','$profession','$password')";
		if ($con->query ( $insert ) == TRUE) {
			return true;
		} else {
			return false;
		}
	}
	public function login($email, $password, $con) {
		$sql = "select * from user where Email='$email' and Password='$password'";
		$ctr = 0;
		try {
			$result = $con->query ( $sql );
			foreach ( $result as $row ) {
				$ctr ++;
			}
		} catch ( PDOException $e ) {
			$errTyp = "danger";
			$errMSG = "Something went wrong, try again later...";
		}
		if ($ctr == 0) {
			return false;
		} else {
			return true;
		}
	}
	public function getName($email, $password, $con) {
		$sql = "select * from user where Email='$email' and Password='$password'";
		$user = "";
		try {
			$result = $con->query ( $sql );
			foreach ( $result as $row ) {
				$user = $row ['name'];
			}
		} catch ( PDOException $e ) {
			$errTyp = "danger";
			$errMSG = "Something went wrong, try again later...";
		}
		return $user;
	}
}

?>