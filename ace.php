<html>

<head>
<script src="togetherjs-min.js" type="text/javascript"></script>
<script src="assets/wp-togetherjs.css" type="text/javascript"></script>
<script src="assets/wp-togetherjs.js" type="text/javascript"></script>
<!-- Include stylesheet -->
<link href="https://cdn.quilljs.com/1.2.2/quill.snow.css" rel="stylesheet">
</head>
<body>
<!-- Create the editor container -->
    <a href="#" id="start-togetherjs" class="togetherjs-button" onclick="TogetherJS(this); return false;">
  Collaborate</a>
<div id="editor">
  <p>Hello World!</p>
  <p>Some initial <strong>bold</strong> text</p>
  <p><br></p>
</div>

<!-- Include the Quill library -->
<script src="https://cdn.quilljs.com/1.2.2/quill.js"></script>

<!-- Initialize Quill editor -->
<script>
  var quill = new Quill('#editor', {
    theme: 'snow'
  });
</script>

</body>

</html>