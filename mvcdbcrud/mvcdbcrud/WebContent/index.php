<?php
    ob_start();
    session_start();
	include("includer.php"); 
	$url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
	list($fill, $base, $control, $action, $arguments) =
			explode('/', $url, 5) + array("", "", "", "", null);
	 $_SESSION['base'] = $base;
	 $_SESSION['control'] = $control; 
	 $_SESSION['action'] = $action;
	 $_SESSION['arguments'] = $arguments;
	     
// 	$session_info = array('base' => $base, 'control' => $control, 
// 	                      'action' =>$action, 'arguments' => $arguments);
	switch ($control) {
		case "login" :
			LoginController::run ();
			break;
		case "review" :
			ReviewController::run ();
			break;
		case "submission" :
			SubmissionController::run ();
			break;
		default:
			HomeView::show();
	};
	ob_end_flush();
	
?>	
