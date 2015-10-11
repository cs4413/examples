<?php
    ob_start();
	include("includer.php"); 
	$url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
	list($fill, $base, $control, $action, $arguments) =  
	     explode('/', $url, 5) + array("", "", "", "", null);
	$session_info = array('base' => $base, 'control' => $control, 
	                      'action' =>$action, 'arguments' => $arguments);
	switch ($control) {
		case "login" :
			LoginController::run ($session_info);
			break;
		case "review" :
			ReviewController::run ($session_info);
			break;
		case "submission" :
			SubmissionController::run ($session_info);
			break;
		default:
			HomeView::show($session_info);
	};
	ob_end_flush();
	
?>	
