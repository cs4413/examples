<?php
require_once dirname ( __FILE__ ) . '\..\..\WebContent\controllers\SubmissionController.class.php';
require_once dirname ( __FILE__ ) . '\..\..\WebContent\models\Database.class.php';
require_once dirname ( __FILE__ ) . '\..\..\WebContent\models\Messages.class.php';
require_once dirname ( __FILE__ ) . '\..\..\WebContent\models\User.class.php';
require_once dirname ( __FILE__ ) . '\..\..\WebContent\models\UsersDB.class.php';
require_once dirname ( __FILE__ ) . '\..\..\WebContent\views\HomeView.class.php';
require_once dirname ( __FILE__ ) . '\..\..\WebContent\views\MasterView.class.php';
require_once dirname ( __FILE__ ) . '\..\..\WebContent\views\SubmissionView.class.php';
require_once dirname ( __FILE__ ) . '\..\..\WebContent\tests\makeDB.php';

class SubmissionControllerTest extends PHPUnit_Framework_TestCase {
	
	public function testCallRunFromPost() {
		DBMaker::create ( 'ptest1' );
		Database::clearDB ();
		$db = Database::getDB ( $dbName = 'ptest1', $configPath = "C:" . DIRECTORY_SEPARATOR . "xampp" . DIRECTORY_SEPARATOR . "myConfig.ini" );
		$_SERVER ["REQUEST_METHOD"] = "POST";
		$_POST = array("userName" => "krobbins", "assignmentNumber" => "1",
		           "submissionFile" => array("name" => "myText.apl", 
		           		                     "tmp_name" => "temp.1"));
		ob_start ();
		SubmissionController::run ();
		$output = ob_get_clean ();
		$this->assertFalse ( empty ( $output ), "It should show something from a POST" );
	}
	
	public function testCallRunFromGet() {
		DBMaker::create ( 'ptest1' );
		Database::clearDB ();
		$db = Database::getDB ( $dbName = 'ptest1', $configPath = "C:" . DIRECTORY_SEPARATOR . "xampp" . DIRECTORY_SEPARATOR . "myConfig.ini" );
		$_SERVER ["REQUEST_METHOD"] = "GET";
		ob_start ();
		SubmissionController::run ();
		$output = ob_get_clean ();
		$this->assertFalse ( empty ( $output ), "It should show something from a GET" );
	}
}

?>