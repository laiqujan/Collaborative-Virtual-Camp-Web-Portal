<?php

 $filecontent ="";
 $link="";
 if(isset($_GET['id'])==true){
  $filename = $_GET['id'];
  $ext = pathinfo($filename, PATHINFO_EXTENSION);
  if($ext=="txt")
  {  
      $myfile = fopen("$filename", "a+") or die("Unable to open file!");
	  if(filesize($filename)!=0){
	  $contentx= fread($myfile,filesize("$filename"));
      $filecontent = trim($contentx);
      fclose($myfile);
	  }
	  else{
      fwrite($myfile, "Dummy");
      fclose($myfile);
	  }
       
  }
}
//if(isset($_POST['col'])==true){
	//$link=(isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
//}
  ?>

<!doctype html>
<!-- See http://www.firepad.io/docs/ for detailed embedding docs. -->
<html>

<head>
  <meta charset="utf-8" />
  <!-- Firebase -->
  <script src="https://www.gstatic.com/firebasejs/3.3.0/firebase.js"></script>

  <!-- CodeMirror -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.17.0/codemirror.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.17.0/codemirror.css" />

  <!-- Firepad -->
  <link rel="stylesheet" href="https://cdn.firebase.com/libs/firepad/1.4.0/firepad.css" />
  <script src="https://cdn.firebase.com/libs/firepad/1.4.0/firepad.min.js"></script>

  <style>
    html { height: 100%; }
    body { margin: 0; height: 100%; position: relative; }
      /* Height / width / positioning can be customized for your use case.
         For demo purposes, we make firepad fill the entire browser. */
    #firepad-container {
      width: 100%;
      height: 100%;
    }
  </style>
   <script>
    function init() {
      //// Initialize Firebase.
      //// TODO: replace with your Firebase project configuration.
      var config = {
        apiKey: "AIzaSyC_JdByNm-E1CAJUkePsr-YJZl7W77oL3g",
        authDomain: "firepad-tests.firebaseapp.com",
        databaseURL: "https://firepad-tests.firebaseio.com"
      };
      firebase.initializeApp(config);

      //// Get Firebase Database reference.
      var firepadRef = getExampleRef();
	  <?php $link='<script>firepadRef</script>'; ?>

      //// Create CodeMirror (with lineWrapping on).
      var codeMirror = CodeMirror(document.getElementById('firepad-container'), { lineWrapping: true });

      //// Create Firepad (with rich text toolbar and shortcuts enabled).
      var firepad = Firepad.fromCodeMirror(firepadRef, codeMirror,
          { richTextToolbar: true, richTextShortcuts: true });
      //// Initialize contents.
     firepad.on('ready', function() {
        if (firepad.isHistoryEmpty()) {
          firepad.setHtml('<?php echo  $filecontent; ?>');
        }
      })
    }

    // Helper to get hash from end of URL or generate a random one.
    function getExampleRef() {
      var ref = firebase.database().ref();
      var hash = window.location.hash.replace(/#/g, '');
      if (hash) {
        ref = ref.child(hash);
      } else {
        ref = ref.push(); // generate unique location.
        window.location = window.location + '#' + ref.key; // add it as a hash to the URL.
		
		//var v=window.location + '#' + ref.key;
	    
		
      }
      if (typeof console !== 'undefined') {
        console.log('Firebase data: ', ref.toString());
      }
      return ref;
    }
  </script>
  
</head>

<body onload="init()">

<button  type="submit" name="col" onclick="test()">Collaborate</button>
<p id="link"></p>
  <div id="firepad-container"></div>
<script>
function test(){
	var str=window.location.href;
	document.getElementById("link").innerHTML=str;
	//alert(str);
}

</script>
</body>
</html>
