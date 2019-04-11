<?php
class Notifications {
	private $recipientId;
	private $senderId;
	private $referennce;
	private $desc;//recipient_id,recipient_id,des,reference
	public function addNotification($teamName,$sender_id,$des,$reference,$con) {
       	 $sql="select * from jointeam where teamName='$teamName'";
		 $result = $con->query($sql);
		$unread="1";
		$now = new DateTime ( null, new DateTimeZone ( 'Asia/Karachi' ) );
        $ctime = $now->format ( 'Y-m-d H:i:s' );
		$created_at=$ctime;
	
	    foreach($result as $row)
		{			
        $recipient_id=$row['email'];
		if( $recipient_id!=$sender_id){
        //$insert2="insert into notifications(recipient_id,sender_id,unread,des,reference,created_at)values('$recipient_id',$sender_id,'$unread','$des','$reference','$created_at')";
		 try {
		    $sql2 = "insert into notifications(recipient_id,sender_id,unread,des,reference,created_at)values(:recipient_id,:sender_id,:unread,:des,:reference,:created_at)";
			$stmt = $con->prepare ( $sql2 );
			$stmt->bindParam ( ':recipient_id', $recipient_id);
			$stmt->bindParam ( ':sender_id', $sender_id);
			$stmt->bindParam ( ':unread',$unread);
			$stmt->bindParam ( ':des', $des);
			$stmt->bindParam ( ':reference',$reference);
			$stmt->bindParam ( ':created_at',$created_at);
			$stmt->execute ();
		} catch ( PDOException $e ) {
			$msg= $e->getMessage();
		
		}
		}
	   // $con->query($insert2);
		
		}
		
		
	}
}
?>