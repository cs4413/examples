<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Basic tests for Configuration</title>
</head>
<body>
<h1>Configuration tests</h1>

<?php
include_once("../models/Messages.class.php");
include_once("../models/Configuration.class.php");
?>

<h2>Set the configuration when a null path is given</h2>
<?php 
Configuration::setConfigurationPath(null);
echo 'The path: '. Configuration::getConfigurationPath() .'<br>';
$passArray = parse_ini_file(Configuration::getConfigurationPath());
print_r($passArray);
?>

<h2>Set the configuration when a null path is given</h2>
<?php 
Configuration::setConfigurationPath('C:\xampp\myConfig.ini');
echo 'The path: '. Configuration::getConfigurationPath() .'<br>';
$passArray = parse_ini_file(Configuration::getConfigurationPath());
print_r($passArray);
?>


</body>
</html>
