<?php
class SubmissionController {

	public static function run() {
		print_r($_FILES);
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$new_post = $_POST;
			if (isset($_FILES["submissionFile"]))
			   $new_post["submissionFile"] = $_FILES["submissionFile"];
			$submission = new Submission($new_post);  
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