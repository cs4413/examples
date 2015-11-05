<?php
    ob_start();
	include("includer.php"); 

	session_start();
	$url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
	list($fill, $base, $control, $action, $arguments) =
			explode('/', $url, 5) + array("", "", "", "", null);
	$_SESSION['base'] = $base;
	$_SESSION['control'] = $control; 
	$_SESSION['action'] = $action;
	$_SESSION['arguments'] = $arguments;
	if (!isset($_SESSION['authenticated'])) 
		$_SESSION['authenticated'] = false;
	switch ($control) {
		default:
				header("Location: /$base/examples/index.html");		
	};
	ob_end_flush();
	
?>	
