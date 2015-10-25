<?php
require_once dirname ( __FILE__ ) . '\..\..\WebContent\controllers\ReviewController.class.php';
require_once dirname ( __FILE__ ) . '\..\..\WebContent\models\Database.class.php';
require_once dirname ( __FILE__ ) . '\..\..\WebContent\models\Messages.class.php';
require_once dirname ( __FILE__ ) . '\..\..\WebContent\models\Review.class.php';
require_once dirname ( __FILE__ ) . '\..\..\WebContent\models\ReviewsDB.class.php';
require_once dirname ( __FILE__ ) . '\..\..\WebContent\models\User.class.php';
require_once dirname ( __FILE__ ) . '\..\..\WebContent\models\UsersDB.class.php';
require_once dirname ( __FILE__ ) . '\..\..\WebContent\views\HomeView.class.php';
require_once dirname ( __FILE__ ) . '\..\..\WebContent\views\MasterView.class.php';
require_once dirname ( __FILE__ ) . '\..\..\WebContent\views\ReviewView.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\tests\DBMaker.class.php';

class ReviewControllerTest extends PHPUnit_Framework_TestCase {
	
	/**
	 * @runInSeparateProcess
	 */
	public function testCallRunFromPost() {
		ob_start ();
 	    DBMakerUnit::createDB('ptest');
		$_SERVER ["REQUEST_METHOD"] = "POST";
		$_POST =  array("reviewerName" => "Kay",
             	   "submissionId" => "3",
	           	   "score" => "5",
		           "review" => "This was a great presentation"
		          );
		$_SESSION = array('base' => 'mvcsession', 'action' => 'new', 'arguments' => null);
		ReviewController::run ();
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
		$_SESSION = array('base' => 'mvcsession', 'action' => 'new', 'arguments' => null);

		ReviewController::run();
		$output = ob_get_clean();
		$this->assertFalse ( empty ( $output ), "It should show something from a GET" );
	}
}

?>
