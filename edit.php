<?php
$filecontent="";
if(isset($_GET['id'])==true){
  $filename = $_GET['id'];
  $myfile = fopen("$filename", "r") or die("Unable to open file!");
  $filecontent =  fread($myfile,filesize("$filename"));
  fclose($myfile);

}
?>
<html>
<head>
<script>
function sav(str) {
	 if (str.length == 0) { 
        //document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //document.getElementById("txtHint").innerHTML = this.responseText;
            }
        }
		
        xmlhttp.open("GET", "save.php?q="+str, true);
        xmlhttp.send();
				
    }
}
</script>

 <link rel="stylesheet" href="css/bootstrap.min.css">
   <script src="js/bootstrap.min.js" ></script>
   <script src="js/jquery-1.11.3.min.js"></script>
</head>
<body>

<form  method="post" >
<table>
<tr>
<td><textarea name="str"  rows="20" cols="50" onkeyup="sav(this.value)"><?php echo $filecontent;?></textarea> </td>
</tr>
</table>
</form>

</body>
</html>