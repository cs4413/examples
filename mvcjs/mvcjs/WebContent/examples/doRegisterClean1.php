<!DOCTYPE html>
<html>
<head>
<title>JavaScript examples</title>
<script src="../js/checkPasswordMatch.js" type="text/javascript"></script>
<script>
  window.onload = 
	  function() {
        console.log("Loading ", Date.now());
        document.getElementById("retypedPassword").addEventListener("blur",  checkPasswordMatch);
      };
</script> 
</head>
<body>

<?php
require_once(dirname(__FILE__). "./registerFormClean.php");

registerFormClean(null);
?>
</body>
</html>