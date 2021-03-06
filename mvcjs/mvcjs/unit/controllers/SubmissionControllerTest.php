<?php
require_once dirname ( __FILE__ ) . '\..\..\WebContent\controllers\SubmissionController.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\Configuration.class.php';
require_once dirname ( __FILE__ ) . '\..\..\WebContent\models\Database.class.php';
require_once dirname ( __FILE__ ) . '\..\..\WebContent\models\Messages.class.php';
require_once dirname ( __FILE__ ) . '\..\..\WebContent\models\User.class.php';
require_once dirname ( __FILE__ ) . '\..\..\WebContent\models\UsersDB.class.php';
require_once dirname ( __FILE__ ) . '\..\..\WebContent\views\HomeView.class.php';
require_once dirname ( __FILE__ ) . '\..\..\WebContent\views\MasterView.class.php';
require_once dirname ( __FILE__ ) . '\..\..\WebContent\views\SubmissionView.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\tests\DBMaker.class.php';

class SubmissionControllerTest extends PHPUnit_Framework_TestCase {
	protected $base = 'mvcjs';
	/**
	 * @runInSeparateProcess
	 */
	public function testCallRunFromPost() {
		ob_start ();
		DBMakerUnit::createDB('ptest');
		$_SERVER ["REQUEST_METHOD"] = "POST";
		$_POST = array("userName" => "krobbins", "assignmentNumber" => "1",
		           "submissionFile" => array("name" => "myText.apl", 
		           		                     "tmp_name" => "temp.1"));
		$_SESSION = array('base' => $this->base, 'control' => 'submission',
				'action' =>'new', 'arguments' => null);

		SubmissionController::run ();
		$output = ob_get_clean();
		$this->assertFalse ( empty ( $output ), "It should show something from a POST" );
	}
	
	/**
	 * @runInSeparateProcess
	 */
	public function testCallRunFromGet() {
		ob_start ();
 	    DBMakerUnit::createDB('ptest');
		$_SERVER ["REQUEST_METHOD"] = "GET";
		$_SESSION = array('base' => $this->base, 'control' => 'submission',
				'action' =>'new', 'arguments' => null);

		SubmissionController::run ();
		$output = ob_get_clean();
		$this->assertFalse ( empty ( $output ), "It should show something from a GET" );
	}
}

?>
