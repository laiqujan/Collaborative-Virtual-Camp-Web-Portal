<?php
session_start();
if(isset($_SESSION['user'])){
        unset($_SESSION['user']);
        unset($_SESSION['Id']);
        echo "<script language='javascript' type='text/javascript'>window.location.href='login.php';</script>";
}
else{
 echo "<script language='javascript' type='text/javascript'>window.location.href='login.php';</script>";	
}
?>