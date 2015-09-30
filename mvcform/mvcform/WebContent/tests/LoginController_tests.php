<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Basic tests for Login Controller</title>
</head>
<body>
<h1>Login controller tests</h1>

<?php
include_once("../controllers/LoginController.class.php");
include_once("../models/User.class.php");
include_once("../views/HomeView.class.php");
include_once("../views/LoginView.class.php");
include_once("../views/MasterView.class.php");
?>

<h2>It should call the run method for valid input during $POST</h2>
<?php 
$_SERVER ["REQUEST_METHOD"] = "POST";
$_POST = array("userName" => "krobbins");
LoginController::run();
?>



<h2>It should call show the login page for a $GET request</h2>
<?php 
$_SERVER ["REQUEST_METHOD"] = "GET";
LoginController::run();
?>
</body>
</html>
