<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Basic tests for Student</title>
</head>
<body>
<h1>Student tests</h1>

<?php
include_once("../models/Student.class.php");
include_once("../models/Messages.class.php");
?>

<h2>It should create a valid Student object when all input is provided</h2>
<?php 
$validTest = array("firstName" => "Kay", "lastName" => "Robbins", 
		           "ipAddress" => "129.10.20.130");
$s1 = new Student($validTest);
echo "The object is: $s1<br>";
$test1 = (is_object($s1))?'':
'Failed:It should create a valid object when valid input is provided<br>';
echo $test1;
$test2 = (empty($s1->getErrors()))?'':
'Failed:It not have errors when valid input is provided<br>';
echo $test2;
?>

<h2>It should extract the parameters that went in</h2>
<?php 
$props = $s1->getParameters();
print_r($props);
?>
<h2>The get methods should return the right values</h2>
<?php 
echo "First name:  ".$s1->getFirstName()." <br>";
echo "Last name:  ".$s1->getLastName()." <br>";
echo "IP address:  ".$s1->getIpAddress()." <br>"; 
?>

<h2>The getLabString should return the right values</h2>
<?php 
echo "lab1:  ".$s1->getLabString(1)." <br>";
echo "Lab2:  ".$s1->getLabString("2")." <br>";
?>

<h2>It should have an error when the first name contains invalid characters</h2>
$invalidTest = array("firstName" => "krobbins$");
$s1 = new Student($invalidTest);
$test2 = (empty($s1->getErrors()))?'':
'Failed:It should have errors when invalid input is provided<br>';
echo $test2;
echo "The error for firstName is: ". $s1->getError('firstName') ."<br>";
echo "The error for lastName is: ". $s1->getError('lastName') ."<br>";
echo "The error for ipAddress is: ". $s1->getError('ipAddress') ."<br>";
echo "The object is: $s1<br>";
?>
</body>
</html>
