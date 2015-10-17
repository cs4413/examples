<?php
class SubmissionController {

	public static function run() {
       // Perform actions related to a submission
		$action = $_SESSION['action'];
		$arguments = $_SESSION['arguments'];
        switch ($action) {
        	case "new":
        		self::newSubmission();
        		break;
        	case "show":
        		$_SESSION['submissions'] = SubmissionsDB::getSubmissionsBy('submissionId', $arguments);
        		SubmissionView::show();
        		break;
        	case  "showall":
        		$_SESSION['submissions'] = SubmissionsDB::getSubmissionsBy();
        		$_SESSION['headertitle'] = "ClassBash Submissions";
        		$_SESSION['footertitle'] = "<h3>The footer goes here</h3>";
        		SubmissionView::showall();
        		break;
        	case "update":
        		self::updateSubmission();
        		break;
        	default:
        }
	}
	
	public static function newSubmission() {
		// Process a new submission
		$submission = null;
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if (isset($_FILES["submissionFile"]))
			   $_POST["submissionFile"] = $_FILES["submissionFile"];
			$submission = new Submission($_POST); 
			$submission = SubmissionsDB::addSubmission($submission);
		}
		if (is_null($submission) || $submission->getErrorCount() != 0) {
			$_SESSION['submission'] = $submission;
			SubmissionView::showNew();
		} else {
			HomeView::show();	
			header('Location: /'.$_SESSION['base']);
		}

	}
	
	public static function updateSubmission() {
		// Process updating submissions
		$submissions = SubmissionsDB::getSubmissionsBy('submissionId', $_SESSION['arguments']);
		if (empty($submissions)) {
			HomeView::show();
			header('Location: /'.$_SESSION['base']);
		} elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
			$_SESSION['submission'] = $submissions[0];
			SubmissionView::showUpdate();
		} else {
			$parms = $submissions[0]->getParameters();
			$parms['submissionFile'] = (array_key_exists('submissionFile', $_POST))?
			                       $_POST['submissionFile']:"";
			$newSubmission = new Submission($parms);
			$newSubmission->setSubmissionId($submissions[0]->getSubmissionId());
			$submission = SubmissionsDB::updateSubmission($newSubmission);
		
			if ($submission->getErrorCount() != 0) {
				$_SESSION['submission'] = $newSubmission;
				SubmissionView::showUpdate();
			} else {
				HomeView::show();
				header('Location: /'.$_SESSION['base']);
			}
		}
	}

}
?>