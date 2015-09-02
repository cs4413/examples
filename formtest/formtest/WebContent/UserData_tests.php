<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Basic tests for UserData</title>
</head>
<body>
<h1>UserData tests</h1>

<?php
include_once("UserData.class.php");
?>

<h2>It should create a valid UserData object when all input is provided</h2>
<?php 
$validTest = array("firstName" => "Janet",
                   "lastName" => "Green",
	               "email" => "jan@gmail.com",
                   "gender" => "female");
$s1 = new UserData($validTest);
echo "$s1";
?>

<h2>It should extract the parameters that went in</h2>
<?php 
$props = $s1->getParameters();
print_r($props);
?>
