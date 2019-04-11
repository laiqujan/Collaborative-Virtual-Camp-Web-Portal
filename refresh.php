<?php
include ("db/opendb.php");
$instance = ConnectDb::getInstance ();
$con = $instance->getConnection ();
ob_start ();
session_start ();
$nn=$_REQUEST["nn"];
$username = $_REQUEST["username"];
$teamName=$_REQUEST["teamName"];
$query2="select * from message where (senderId='$nn' and recipient='$username') or (senderId='$username' and recipient='$nn') and teamId='$teamName'";
$result2 = $con -> query($query2) or die("sql error");
?>
    <ul>
     <?php 
	        foreach($result2 as $row2)
	         {
				 $person=$row2['time'];
				 $cuser=$_SESSION ['user'];
				 $pos = strpos($person, $cuser);
                 if ($pos === false) {
          	?>
    	
  <li style="background-color:skyblue;float:right;border-bottom-right-radius: 2px;">
  <p style="color:black;"><?php
  $msgg=$row2['message'];
  $length=strlen($msgg);
  //echo $row2['message'] ;
  $div=$length/200;
  $modMessage="";
  $index=0;
  $check=0;
  $y=0;
  $limit=200;
 if($length>200){
 for ($y=0;$y<=$length; $y++) {
	  $check=$check+1;;
      $modMessage=$modMessage."". substr($msgg, $y, 1); //$msgg[$y];
	  if($check==200){
		$modMessage=$modMessage."\n"; 
		$check=0;
	  }
     }
   echo $modMessage;	 
  }
  else{
	  echo $row2['message'] ;
  }
  
  ?></p>
    <?php echo $row2['time'];?>

      </li>
	  <?php
				 }
				 else{
					 
					 ?>
 <li style="background-color:#66cc66;float:left;border-bottom-left-radius: 2px;">
  <p style="color:black;">
  <?php
  $msgg=$row2['message'];
  $length=strlen($msgg);
  //echo $row2['message'] ;
  $div=$length/200;
  $modMessage="";
  $index=0;
  $check=0;
  $y=0;
  $limit=200;
 if($length>200){
 for ($y=0;$y<=$length; $y++) {
	  $check=$check+1;;
      $modMessage=$modMessage."". substr($msgg, $y, 1); //$msgg[$y];
	  if($check==200){
		$modMessage=$modMessage."\n"; 
		$check=0;
	  }
     }
   echo $modMessage;	 
  }
  else{
	  echo $row2['message'] ;
  }
  
  ?>
  
  </p>
    <?php echo $row2['time'];?>

      </li>
	  <?php 
				 }
	  }
	  ?>
    </ul>
 