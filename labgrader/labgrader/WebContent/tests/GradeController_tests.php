<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Basic tests for Grade Controller</title>
</head>
<body>
<h1>Grade controller tests</h1>

<?php
include_once("../models/Messages.class.php");
include_once("../controllers/GradeController.class.php");
include_once("../models/Student.class.php");
include_once("../models/Lab.class.php");
include_once("../views/HomeView.class.php");
?>

<h2>It should call the run method without crashing</h2>
<?php 
GradeController::run();
?>
</body>
</html>
