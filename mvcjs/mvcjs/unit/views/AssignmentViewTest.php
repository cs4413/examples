<?php
require_once dirname(__FILE__).'\..\..\WebContent\models\Assignment.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\Messages.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\views\AssignmentView.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\views\MasterView.class.php';

class AssignmentViewTest extends PHPUnit_Framework_TestCase {
	protected $base = 'mvcjs';
	
  public function testShowAssignmentViewWithAssignment() {
  	ob_start();
  	$validTest = array("assignmentOwnerName" => "Kay",
             	       "submissionId" => "1",
	           	       "assignmentTitle" => "Assignment Title 1",
		               "assignmentDescription" => "This was a great presentation"
		              );
    $s1 = new Assignment($validTest);
  	$_SESSION = array('assignment' => $s1, 'base' => $this->base);
    AssignmentView::show();
    $output = ob_get_clean();
    $this->assertFalse(empty($output), 
    		"It should show an AssignmentView when passed a valid Assignment ");
  }
  
  public function testShowAllAssignments() {
  	ob_start();
  	$validTest = array("assignmentOwnerName" => "Kay",
             	       "submissionId" => "1",
	           	       "assignmentTitle" => "Assignment Title 1",
		               "assignmentDescription" => "This was a great presentation"
		              );
    $s1 = new Assignment($validTest);
  	$s1 -> setAssignmentId(1);
  	$s2 = new Assignment($validTest);
  	$s2 -> setAssignmentId(2);
  	$assignments = array($s1, $s2);
  	$_SESSION = array('assignments' => $assignments, 'base' => $this->base,
  			          'headertitle' => 'Assignment table',
  			          'footertitle' => 'This is a footer');
  	AssignmentView::showall();
  	$output = ob_get_clean();
  	$this->assertFalse(empty($output),
  			"It should show a table of Assignments when passed valid input and a header and footer");
  }
  
  public function testShowAllWithNoAssignments() {
  	ob_start();
  	$_SESSION = array('base' => 'mvcsession');
  	AssignmentView::showall();
  	$output = ob_get_clean();
  	$this->assertFalse(empty($output),
  			"It should show a table of assignments when nothing is passed");
  }
  
  public function testUpdateAssignment() {
  	ob_start();
  	$validTest = array("assignmentOwnerName" => "Kay",
             	       "submissionId" => "1",
	           	       "assignmentTitle" => "Assignment Title 1",
		               "assignmentDescription" => "This was a great presentation"
  	);
  	$assignment = new Assignment($validTest);
  	$assignment->setAssignmentId(1);
  	$_SESSION = array('assignment' => $assignment, 'base' => $this->base);
  	AssignmentView::showUpdate();
  	$output = ob_get_clean();
  	$this->assertFalse(empty($output),
  			"It should show an update form");
  }
}
?>