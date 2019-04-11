<?php
// get the q parameter from URL
$data = $_REQUEST["data"];
$filename=$_REQUEST["loc"];
$myfile = fopen("$filename", "w") or die("Unable to open file!");
fwrite($myfile, $data);
fclose($myfile);

//$my = fopen("log.txt", "w") or die("Unable to open file!");
//fwrite($my, $data." ".$filename);
//fclose($myfile);

?>