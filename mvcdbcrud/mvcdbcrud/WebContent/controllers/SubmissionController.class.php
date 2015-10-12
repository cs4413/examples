<?php
class SubmissionController {

	public static function run($sessionInfo) {
       // Perform actions related to a submission
		$action = $sessionInfo['action'];
		$arguments = $sessionInfo['arguments'];
        switch ($action) {
        	case "new":
        		self::newSubmission($sessionInfo);
        		break;
        	case "show":
        		break;
        	case  "showall":
        		$sessionInfo['submissions'] = SubmissionsDB::getAllSubmissions();
        		$sessionInfo['headertitle'] = "ClassBash Submissions";
        		$sessionInfo['footertitle'] = "<h3>The footer goes here</h3>";
        		SubmissionView::showall($sessionInfo);
        		break;
        	default:
        }
	}
	
	public static function newSubmission($sessionInfo) {
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
			$sessionInfo['submission'] = $submission;
			SubmissionView::showNew($sessionInfo);
		} else {
			HomeView::show($sessionInfo);	
			header('Location: http://'.$_SERVER["HTTP_HOST"].'/'.$sessionInfo['base']);
		}

	}
}
?>