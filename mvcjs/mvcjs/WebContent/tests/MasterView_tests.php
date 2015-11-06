<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Basic tests for Master View</title>
</head>
<body>
<h1>Master view tests</h1>

<?php
include_once("../models/Messages.class.php");
include_once("../models/User.class.php");
include_once("../views/MasterView.class.php");
?>

<h2>It should call showHeader with an empty array</h2>
<?php 
$_SESSION = array();
MasterView::showHeader();
?>

<h2>It should call showHeader with an actual title</h2>
<?php 
$_SESSION = array('headertitle' =>"This is my title");
MasterView::showHeader();
?>

<h2>It should call showFooter with an empty array</h2>
<?php 
$_SESSION = array();
MasterView::showFooter();
?>

<h2>It should call showFooter with an actual footer</h2>
<?php 
$_SESSION = array('footertitle' =>"<h3>The footer goes here</h3>");
MasterView::showFooter();
?>

<h2>It should call showNavBar with an empty array</h2>
<?php 
$_SESSION = array();
MasterView::showNavBar();
?>

<h2>It should call showNavbar with an actual user</h2>
<?php 
$validTest = array("userName" => "krobbins");
$s1 = new User($validTest);
$_SESSION = array('user' => $s1);
MasterView::showNavbar();
?>
</body>
</html>
