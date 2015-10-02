<?php
class SubmissionController {

	public static function run() {
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$submission = new Submission($_POST);  
			if ($submission->getErrorCount() != 0) 
				SubmissionView::show($submission);
			else {
				$user = UsersDB::getUserBy('userName', $submission->getUserName());
			    if ($user != null) 
				   HomeView::show($user);		
		        else {
		           $submission->setError('userName', 'USER_NAME_DOES_NOT_EXIST');
				   SubmissionView::show($submission);
		        }
		     } 
		} else  // Initial link
			SubmissionView::show(null);
	}
}
?>