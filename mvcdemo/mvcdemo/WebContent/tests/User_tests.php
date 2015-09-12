<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Basic tests for User</title>
</head>
<body>
<h1>User tests</h1>

<?php
include_once("../models/User.class.php");
?>

<h2>It should create a valid User object when all input is provided</h2>
<?php 
$validTest = array("userName" => "krobbins");
$s1 = new User($validTest);
?>
</body>
</html>
