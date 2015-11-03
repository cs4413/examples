<!DOCTYPE html>
<html>
<head>
<title>JavaScript examples</title>
<script src="../js/jquery-2.1.4.min.js"></script>
<script src="../js/checkPasswordMatch2.js" type="text/javascript"></script>
<script>
   $(window).load(
		  function() {
	         console.log("Loading ", Date.now());
	         $("#retypedPassword").blur(checkPasswordMatch);
          });
</script> 
</head>
<body>

<?php
require_once(dirname(__FILE__). "./registerFormRevisited.php");

registerFormRevisited(null);
?>
</body>
</html>