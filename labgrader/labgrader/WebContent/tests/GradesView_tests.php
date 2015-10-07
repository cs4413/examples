<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Basic tests for Grades View</title>
</head>
<body>
<h1>Grades view tests</h1>

<?php
include_once("../views/GradesView.class.php");
include_once("../models/Student.class.php");
include_once("../models/Messages.class.php");
include_once("../models/Grades.class.php");
include_once("../models/Site.class.php");
?>

<h2>It should call show without crashing</h2>
<?php 
$validTest = array('listFile' => 'c:\\xampp\\htdocs\\classList.csv');
$s1 = new Grades($validTest);
GradesView::show($s1, 3);
?>
</body>
</html>
