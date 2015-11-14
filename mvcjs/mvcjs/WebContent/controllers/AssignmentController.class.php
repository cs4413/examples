<?php
class AssignmentController {

	public static function run() {
		// Perform actions related to a review
		$action = (array_key_exists('action', $_SESSION))?$_SESSION['action']:"";
		$arguments = $_SESSION['arguments'];
		switch ($action) {
			case "instructor":
				$assignmentRows = AssignmentsDB::getAssignmentRowSetsBy('assignmentOwnerName', $arguments);
				echo json_encode($assignmentRows);
				break;
			case "new":
				self::newAssignment();
				break;
			case "show":
				$assignments = AssignmentsDB::getAssignmentsBy('assignmentId', $arguments);
				$_SESSION['assignment'] = (!empty($assignments))?$assignments[0]:null;
	            AssignmentView::show();
				break;
			case  "showall":
				$_SESSION['assignments'] = AssignmentsDB::getAssignmentsBy();
				AssignmentView::showall();
				break;
			case "update":
				self::updateAssignment();
				break;
			default:
		}
	}
	
	
	public static function newAssignment() {
		// Process a new assignment
		$assignment = null;
		if ($_SERVER["REQUEST_METHOD"] == "POST")  {
			$assignment = new Assignment($_POST);
			$assignment =AssignmentsDB::addAssignment($assignment);
		}
		if (is_null($assignment) || $assignment->getErrorCount() != 0) {
			$_SESSION['assignment'] = $assignment;
			AssignmentView::showNew();
		} else {
			HomeView::show();	
			header('Location: /'.$_SESSION['base']);
		}		
	}
	
	public static function updateAssignment() {
		// Process updating assigntment
		$assignments = AssignmentsDB::getAssignmentsBy('assignmentId', $_SESSION['arguments']);
		if (empty($assignments)) {
			HomeView::show();
			header('Location: /'.$_SESSION['base']);
		} elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
			$_SESSION['assignment'] = $assignments[0];
			AssignmentView::showUpdate();
		} else {
			$parms = $assignments[0]->getParameters();
			$parms['assignmentTitle'] = (array_key_exists('assignmentTitle', $_POST))?
			                  $_POST['assignmentTitle']:$assignment[0]->getAssignmentTitle();
			$parms['assignmentDescription'] = (array_key_exists('assignmentDescription', $_POST))?
		                    	$_POST['assignmentDescription']:$assignments[0]->getAssignmentDescription();
			$assignment = new Assignment($parms);
			$assignment->setAssignmentId($assignments[0]->getAssignmentId());
			$assignment = AssignmentsDB::updateAssignment($assignment);
		
		    if ($assignment->getErrorCount() != 0) {
			   $_SESSION['assignment'] = $assignment;
		   	   AssignmentView::showUpdate();
		    } else {
			   HomeView::show();
			   header('Location: /'.$_SESSION['base']);
		    }
		}
	}
		
}
?>