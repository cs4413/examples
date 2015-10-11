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
MasterView::showHeader(array());
?>

<h2>It should call showHeader with an actual title</h2>
<?php 
MasterView::showHeader(array('headertitle' =>"This is my title"));
?>

<h2>It should call showFooter with an empty array</h2>
<?php 
MasterView::showFooter(array());
?>

<h2>It should call showFooter with an actual footer</h2>
<?php 
MasterView::showFooter(array('footertitle' =>"<h3>The footer goes here</h3>"));
?>

<h2>It should call showNavBar with an empty array</h2>
<?php 
MasterView::showNavBar(array());
?>

<h2>It should call showNavbar with an actual user</h2>
<?php 
$validTest = array("userName" => "krobbins");
$s1 = new User($validTest);
MasterView::showNavbar(array('user' => $s1));
?>
</body>
</html>
