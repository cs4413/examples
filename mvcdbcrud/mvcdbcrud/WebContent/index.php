<?php
	include("includer.php");   
	$url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
	//echo "URL: $url <br>";
	$urlPieces = split("/", $url);
	
	//print_r($urlPieces);
	if (count($urlPieces) < 2)
		$control = "none";
	else {
		$control = $urlPieces[2];
		$action = array_slice($urlPieces, 2);
	}
	print_r($action);
	switch ($control) {
		case "login" :
			LoginController::run ($action);
			break;
		case "review" :
			ReviewController::run ($action);
			break;
		case "submission" :
			SubmissionController::run ($action);
			break;
		default:
			HomeView::show(null);
		};
?>	
