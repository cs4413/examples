<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Basic tests for Master View</title>
</head>
<body>
<h1>Master view tests</h1>

<?php
include_once("../views/MasterView.class.php");
?>

<h2>It should call showHeader with a null title</h2>
<?php 
MasterView::showHeader(null);
?>

<h2>It should call showHeader with an actual title</h2>
<?php 
MasterView::showHeader("This is my title");
?>

<h2>It should call showFooter with a null footer</h2>
<?php 
MasterView::showFooter(null);
?>

<h2>It should call showFooter with an actual footer</h2>
<?php 
MasterView::showFooter(	"<h3>The footer goes here</h3>"	);
?>
</body>
</html>
