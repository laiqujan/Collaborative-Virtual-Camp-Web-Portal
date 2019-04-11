<?php

    include ("db/opendb.php");
    $instance = ConnectDb::getInstance ();
   $conn = $instance->getConnection ();
	 
	 // Check whether username or password is set from android	
     if(isset($_POST['username']) && isset($_POST['password']))
     {
		  // Innitialize Variable
		  $result='';
	   	  $username = $_POST['username'];
          $password = $_POST['password'];
		  
		  // Query database for row exist or not
          $sql = 'SELECT * FROM user WHERE  email = :username AND password = :password';
          $stmt = $conn->prepare($sql);
          $stmt->bindParam(':username', $username, PDO::PARAM_STR);
          $stmt->bindParam(':password', $password, PDO::PARAM_STR);
          $stmt->execute();
          if($stmt->rowCount())
          {
			 $result="true";	
          }  
          elseif(!$stmt->rowCount())
          {
			  	$result="false";
          }
		  
		  // send result back to android
   		  echo $result;
  	}
	
?>