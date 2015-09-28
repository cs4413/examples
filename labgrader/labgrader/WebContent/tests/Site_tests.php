<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Basic tests for Site</title>
</head>
<body>
<h1>Site tests</h1>

<?php
include_once("../models/Site.class.php");
include_once("../models/Messages.class.php");
?>

<h2>It should return 200 for a URL that can be accessed</h2>
<?php 
$ip = "http://www.cs.utsa.edu/~cs4413";
$code = Site::getHTTPReturnCode($ip);
echo "Return code: $code<br>";
?>

<h2>It should return 200 for a URL that can be accessed</h2>
<?php 
$ip = "http://www.google.com";
$code = Site::getHTTPReturnCode($ip);
echo "Return code: $code<br>";
?>
</body>
</html>
