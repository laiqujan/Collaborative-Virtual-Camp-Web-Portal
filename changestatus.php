<?php
  include("db/opendb.php");
  $instance = ConnectDb::getInstance();
  $con = $instance->getConnection();
    $_SESSION['test']="work";
// get the q parameter from URL
  $q = $_REQUEST["q"];
  $query1 = "UPDATE assigned SET status='Complete' where id='10'";
  $con -> query($query1) or die("Update error");
  session_start();
  $con=NULL;
?>