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
			header('Location: http://'.$_SERVER["HTTP_HOST"].'/'.$_SESSION['base']);
		}

	}
	
	public static function updateSubmission() {
		// Process updating submissions
		$submissions = SubmissionsDB::getSubmissionsBy('submissionId', $_SESSION['arguments']);
		if (empty($submissions)) {
			HomeView::show();
			header('Location: http://'.$_SERVER["HTTP_HOST"].'/'.$_SESSION['base']);
		} elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
			$_SESSION['review'] = $reviews[0];
			ReviewView::showUpdate();
		} else {
			$parms = $reviews[0]->getParameters();
			$parms['score'] = (array_key_exists('score', $_POST))?
			$_POST['score']:$reviews[0]->getScore();
			$parms['review'] = (array_key_exists('review', $_POST))?
			$_POST['review']:$reviews[0]->getReview();
			$newReview = new Review($parms);
			$newReview->setReviewId($reviews[0]->getReviewId());
			$reviewId = ReviewsDB::updateReview($newReview);
			if ($reviewId == 0)
				$newReview->setError('reviewId', 'REVIEW_IDENTITY_INVALID');
			if ($newReview->getErrorCount() != 0) {
				$_SESSION['review'] = $newReview;
				ReviewView::showUpdate();
			} else {
				HomeView::show();
				header('Location: http://'.$_SERVER["HTTP_HOST"].'/'.$_SESSION['base']);
			}
		}
	}

}
?>