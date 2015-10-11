<?php
	include("includer.php"); 

	$url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
	//echo "URL: $url <br>";
	echo "index.php".$_SERVER["REQUEST_URI"]."<br>";
	list($fill, $base, $control, $action, $arguments) =  
	     explode('/', $url, 5) + array("", "", "", "", null);
	$session_info = array('base' => $base, 'control' => $control, 
	                      'action' =>$action, 'arguments' => $arguments);
	$urlPieces = split("/", $url);
// 	$base = getValue(array_slice($urlPieces, 1, 1));
// 	$control = getValue(array_slice($urlPieces, 2, 1));
// 	$action = array_slice($urlPieces, 3, 1);
// 	$arguments = array_slice($urlPieces, 4);
	echo "<br>URL pieces: ";
	print_r($urlPieces);
	echo "<br>control: ";
	print_r($control);
	echo "<br>action: ";
	print_r($action);
	echo "<br>arguments: ";
	print_r($arguments);
	echo "<br>";
	switch ($control) {
		case "login" :
			LoginController::run ($session_info);
			break;
		case "review" :
			ReviewController::run ($session_info);
			break;
		case "submission" :
			echo("new submission<br>");
			SubmissionController::run ($session_info);
			break;
		default:
			HomeView::show($base, null);
	};
	
?>	
