<?php
class Message {
	private $recivier;
	private $sender;
	private $message;
	private $teamId;
	private $time;
	public function send($insert1, $con) {
		$con->query ( $insert1 );
	}
}
?>