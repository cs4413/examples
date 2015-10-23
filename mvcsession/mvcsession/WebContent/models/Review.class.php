<?php
class Review {
	private $errorCount;
	private $errors;
	private $formInput;
	private $review;
	private $reviewId;
	private $score;
	private $submissionId;
	private $reviewerName;

	
	public function __construct($formInput = null) {
		$this->formInput = $formInput;
		Messages::reset();
		$this->initialize();
	}

	public function getError($errorName) {
		if (isset($this->errors[$errorName]))
			return $this->errors[$errorName];
		else
			return "";
	}


	public function getErrorCount() {
		return $this->errorCount;
	}

	public function getErrors() {
		return $this->errors;
	}
	
	public function getReview() {
		return $this->review;
	}
	
	public function getReviewId() {
		return $this->reviewId;
	}
	
	public function getReviewerName() {
		return $this->reviewerName;
	}
	
	public function getScore() {
		return $this->score;
	}
	
	public function getSubmissionId() {
		return $this->submissionId;
	}
	
	public function getParameters() {
		// Return data fields as an associative array
		$paramArray = array("reviewerName" => $this->reviewerName,
			            	"reviewId" => $this->reviewId,
				            "submissionId" => $this->submissionId,
				            "score" => $this->score,
				            "review" => $this->review
		); 
		return $paramArray;
	}
	
	public function setError($errorName, $errorValue) {
		// Set a particular error value and increments error count
		if (!array_key_exists($errorName, $this->errors)) {
			$this->errors[$errorName] =  Messages::getError($errorValue);
			$this->errorCount ++;
		}
	}
	
	public function setReviewId($id) {
		// Set the value of the reviewId to $id
		$this->reviewId = $id;
	}
	
	public function __toString() {
		$errorStr = "";
		foreach($this->errors as $error)
			$errorStr = $errorStr . " ". $error;
		$str = "Reviewer name: ".$this->reviewerName.
		       " Submission Id: ".$this->submissionId.
		       " Score: ".$this->score.
		       " Review: ".$this->review.
		       " Review Id: ".$this->reviewId.
		       " Errors: [$errorStr.]";
		return $str;
	}
	
	private function extractForm($valueName) {
		// Extract a stripped value from the form array
		$value = "";
		if (isset($this->formInput[$valueName])) {
			$value = trim($this->formInput[$valueName]);
			$value = stripslashes ($value);
			$value = htmlspecialchars ($value);
			return $value;
		}
	}
	private function initialize() {
		$this->errorCount = 0;
		$this->reviewId = 0;
		$this->errors = array ();
		if (is_null ( $this->formInput )) {
			$this->review = "";
		    $this->score = "";
	 	    $this->reviewerName = "";
	 	   $this->submissionId = "";	
		} else {
			$this->validateReviewerName();
			$this->validateSubmissionId();
			$this->validateScore();
			$this->validateReview();
		}
	}

	private function validateScore() {
		// Score such contain ... TODO
		$this->score = $this->extractForm('score');
		if (empty($this->score)) 
			$this->setError('score', 'SCORE_EMPTY');
	}
	
	private function validateReview() {
		// Review such contain ... TODO
		$this->review = $this->extractForm('review');
		if (empty($this->review)) 
			$this->setError('review', 'REVIEW_EMPTY');
	}
	
	private function validateReviewerName() {
		// The reviwerName should only contain letters, numbers, dashes and underscore
		$this->reviewerName = $this->extractForm('reviewerName');
		if (empty($this->reviewerName))
			$this->setError('reviewerName', 'REVIEWER_NAME_EMPTY');
		elseif (!filter_var($this->reviewerName, FILTER_VALIDATE_REGEXP,
				array("options"=>array("regexp" =>"/^([a-zA-Z0-9\-\_])+$/i")) )) {
			$this->setError('reviewerName', 'REVIEWER_NAME_HAS_INVALID_CHARS');
		}
	}
	
	private function validateSubmissionId() {
		// Submission ID should contain ..... TODO
		$this->submissionId = $this->extractForm('submissionId');
		if (empty($this->submissionId))
			$this->setError('submissionId', 'SUBMISSION_ID_EMPTY');
		// todo
	}
}
?>