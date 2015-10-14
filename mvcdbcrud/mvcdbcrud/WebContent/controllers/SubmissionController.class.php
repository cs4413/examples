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
        		break;
        	case  "showall":
        		$_SESSION['submissions'] = SubmissionsDB::getSubmissionsBy();
        		$_SESSION['headertitle'] = "ClassBash Submissions";
        		$_SESSION['footertitle'] = "<h3>The footer goes here</h3>";
        		SubmissionView::showall();
        		break;
        	default:
        }
	}
	
	public static function newSubmission() {
		// Process a new submission
		$user = null;
		$submission = null;
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$new_post = $_POST;
			if (isset($_FILES["submissionFile"]))
			   $new_post["submissionFile"] = $_FILES["submissionFile"];
			$submission = new Submission($new_post); 
			if (empty($submission->getError("userName"))) {
				$users = UsersDB::getUsersBy('userName', $submission->getUserName());
				if ($users != null && !empty($users))
					$user = $users[0];
				else
					$submission->setError('userName', 'USER_NAME_DOES_NOT_EXIST');
			}
		}
		if (is_null($submission) || $submission->getErrorCount() != 0) {
			$_SESSION['submission'] = $submission;
			SubmissionView::showNew();
		} else {
			HomeView::show();	
			header('Location: http://'.$_SERVER["HTTP_HOST"].'/'.$_SESSION['base']);
		}

	}
}
?>