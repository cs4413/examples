<?php
require_once dirname ( __FILE__ ) . '\..\..\WebContent\controllers\AssignmentController.class.php';
require_once dirname ( __FILE__ ) . '\..\..\WebContent\models\Configuration.class.php';
require_once dirname ( __FILE__ ) . '\..\..\WebContent\models\Database.class.php';
require_once dirname ( __FILE__ ) . '\..\..\WebContent\models\Messages.class.php';
require_once dirname ( __FILE__ ) . '\..\..\WebContent\models\Assignment.class.php';
require_once dirname ( __FILE__ ) . '\..\..\WebContent\models\AssignmentsDB.class.php';
require_once dirname ( __FILE__ ) . '\..\..\WebContent\models\User.class.php';
require_once dirname ( __FILE__ ) . '\..\..\WebContent\models\UsersDB.class.php';
require_once dirname ( __FILE__ ) . '\..\..\WebContent\views\HomeView.class.php';
require_once dirname ( __FILE__ ) . '\..\..\WebContent\views\MasterView.class.php';
require_once dirname ( __FILE__ ) . '\..\..\WebContent\views\AssignmentView.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\tests\DBMaker.class.php';
require_once dirname(__FILE__).'\..\models\DBMakerUnit.class.php';

class AssignmentControllerTest extends PHPUnit_Framework_TestCase {
	protected $base = 'mvcjs';
	/**
	 * @runInSeparateProcess
	 */
	public function testCallRunFromPost() {
		ob_start ();
 	    DBMakerUnit::createDB('ptest');
		$_SERVER ["REQUEST_METHOD"] = "POST";
		$_POST =  array("assignmentOwnerName" => "Kay",
             	   "assignmentId" => "3",
	           	   "assignmentTitle" => "This title A",
		           "assignmentDescription" => "This was a great presentation",
				   "assignmentDueDate" => "12/30/2015 10:15"
		          );
		$_SESSION = array('base' => $this->base, 'control' =>'assignment', 
				          'action' => 'new', 'arguments' => null);
		AssignmentController::run ();
		$output = ob_get_clean();
		$this->assertFalse (empty ($output), "It should show something from a POST" );
	}
	
	/**
	 * @runInSeparateProcess
	 */
	public function testCallRunFromGet() {
		ob_start ();
 	    DBMakerUnit::createDB('ptest');
		$_SERVER ["REQUEST_METHOD"] = "GET";
		$_SESSION = array('base' => $this->base, 'control' =>'assignment',
				          'action' => 'new', 'arguments' => null);

		AssignmentController::run();
		$output = ob_get_clean();
		$this->assertFalse ( empty ( $output ), "It should show something from a GET" );
	}
	
	/**
	 * @runInSeparateProcess
	 */
	public function testCallRunFromSuccessfulPost() {
		ob_start();
		DBMakerUnit::createDB('ptest');
		$_SERVER ["REQUEST_METHOD"] = "POST";
		$_SESSION = array('base' => $this->base, 'control' => 'assignment',
				'action' =>'new', 'arguments' => null);
		$_POST = array('assignmentOwnerName' => 'George',
				'assignmentTitle' => 'A great assignment for all',
				'assignmentDueDate' => '11/18/2015 13:16',
				'assignmentDescription' => 'Write your life story');
		AssignmentController::run();
		$output = ob_get_clean();
		$this->assertFalse ( empty ( $output ), "It should show something from a SUCCESSFUL POST" );
	}

}

?>
