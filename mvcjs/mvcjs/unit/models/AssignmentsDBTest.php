<?php
require_once dirname(__FILE__).'\..\..\WebContent\models\Assignment.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\AssignmentsDB.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\Configuration.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\Database.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\Messages.class.php';

require_once dirname(__FILE__).'\..\..\WebContent\models\Submission.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\SubmissionsDB.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\User.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\UsersDB.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\tests\DBMaker.class.php';
require_once dirname(__FILE__).'\DBMakerUnit.class.php';

class AssignmentsDBTest extends PHPUnit_Framework_TestCase {
	
  public function testGetAllAssignments() {
  	  DBMakerUnit::createDB('ptest');
  	  $assignments = AssignmentsDB::getAssignmentsBy();
  	  $this->assertEquals(8, count($assignments), 
  	  		'It should fetch all of the assignments in the test database');

  	  foreach ($assignments as $assignment) 
          $this->assertTrue(is_a($assignment, 'Assignment'), 
        		'It should return valid Assignment objects');
  }
  
  public function testInsertValidAssignment() {
    DBMakerUnit::createDB('ptest');
  	$beforeCount = count(AssignmentsDB::getAssignmentsBy());
  	$validTest = array("assignmentOwnerName" => "Kay",
  			"assignmentId" => "1",
  			"assignmentTitle" => "This was a title",
  			"assignmentDescription" => "This was a great presentation",
  			"assignmentDueDate" => '2015-11-30 20:10:15'
  	);
  	$s1 = new Assignment($validTest);
  	$assignment = AssignmentsDB::addAssignment($s1);
  	$this->assertTrue(!is_null($assignment), 'The inserted assignment should not be null');
  	$this->assertTrue(empty($assignment->getErrors()), 'The returned assignment should not have errors');
  	$afterCount = count(AssignmentsDB::getAssignmentsBy());
  	$this->assertEquals($afterCount, $beforeCount + 1,
  			'The database should have one more assignment after insertion');
  }
  

  
  public function testUpdateAssignment() {
  	 DBMakerUnit::createDB('ptest');
  	 $beforeCount = count(AssignmentsDB::getAssignmentsBy());
	 $assignments = AssignmentsDB::getAssignmentsBy('assignmentId', 1);
	 $currentAssignment = $assignments[0];
	 $parms = $currentAssignment->getParameters();
	 $parms['assignmentDescription'] = 'new assignment text';
	 $parms['assignmentDueDate'] = '2015-11-30 20:10:15';
	 $newAssignment = new Assignment($parms);
	 $newAssignment->setAssignmentId($currentAssignment->getAssignmentId());
	 $updatedAssignment = AssignmentsDB::updateAssignment($newAssignment);
	 $afterCount = count(AssignmentsDB::getAssignmentsBy());
	 $this->assertEquals($beforeCount, $afterCount, 
	 		'The number of assignments in the database should not change after update');
	 $this->assertEquals($updatedAssignment->getAssignmentId(), $newAssignment->getAssignmentId(),
	 		'The id of the updated assignment should remain the same'); 
	 $this->assertEquals($updatedAssignment->getAssignmentDescription(), 'new assignment text',
	 		'The assignment description should be updated');
	 $date = $updatedAssignment->getAssignmentDueDateFormatted('Y-m-d G:i:s');
	 $this->assertEquals($date, '2015-11-30 20:10:15',
	 		'The assignment due date should be updated');
  } 

  public function testGetAssignmentByAssignmentOwnerName() {
  	DBMakerUnit::createDB('ptest');
    $assignments = AssignmentsDB::getAssignmentsBy('assignmentOwnerName', 'Kay');
    $this->assertEquals(count($assignments), 4, 'Kay should have four assignments');
    foreach($assignments as $assignment) {
    	$this->assertTrue(is_a($assignment, "Assignment"),
    			'The returned values should be Assignment objects');
    	$this->assertTrue(empty($assignment->getErrors()), 
    			"The returned assignments should have no errors");
    }
  }
  
  public function testGetAssignmentRowSetsByAssignmentOwnerName() {
  	DBMakerUnit::createDB('ptest');
  	$assignments = AssignmentsDB::getAssignmentRowSetsBy('assignmentOwnerName', 'Kay');
  	
  	$this->assertEquals(count($assignments), 4, 'Kay should have four assignments');
  }
  
}
?>