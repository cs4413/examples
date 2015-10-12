<?php
class Review {
	private $errorCount;
	private $errors;
	private $formInput;
	private $review;
	private $reviewId;
	private $score;
	private $submissionId;
	private $userName;

	
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
	
	public function getScore() {
		return $this->score;
	}
	
	public function getSubmissionId() {
		return $this->submissionId;
	}
	
	public function getUserName() {
		return $this->userName;
	}
	
	public function getParameters() {
		// Return data fields as an associative array
		$paramArray = array("userName" => $this->userName,
			            	"reviewId" => $this->reviewId,
				            "submissionID" => $this->submissionId,
				            "score" => $this->score,
				            "review" => $this->review
		); 
		return $paramArray;
	}
	
	public function setError($errorName, $errorValue) {
		// Set a particular error value and increments error count
		if (!isset($this->errors, $errorName)) {
			$this->errors[$errorName] =  Messages::getError($errorValue);
			$this->errorCount ++;
		}
	}
	
	public function setReviewId($id) {
		// Set the value of the reviewId to $id
		$this->reviewId = $id;
	}
	
	public function __toString() {
		$str = "User name: ".$this->userName.
		       " Submission ID: ".$this->submissionId.
		       " Score: ".$this->score.
		       " Review: ".$this->review.
		       " Review id: ".$this->reviewId;
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
		$errors = array ();
		if (is_null ( $this->formInput ))
			$this->initializeEmpty();
		else {
			$this->validateUserName();
			$this->validateSubmissionId();
			$this->validateScore();
			$this->validateReview();
		}
	}

	private function initializeEmpty() {
		$this->errorCount = 0;
		$errors = array();
		$this->review = "";
		$this->score = "";
	 	$this->userName = "";
	 	$this->submissionId = "";	
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
	
	private function validateSubmissionId() {
		// Submission ID should contain ..... TODO
		$this->submissionID = $this->extractForm('submissionId');
		if (empty($this->submissionId))
			$this->setError('submissionId', 'SUBMISSION_ID_EMPTY');
		// todo
	}
	
	private function validateUserName() {
		// Username should only contain letters, numbers, dashes and underscore
		$this->userName = $this->extractForm('userName');
		if (empty($this->userName))
			$this->setError('userName', 'USER_NAME_EMPTY');
		elseif (!filter_var($this->userName, FILTER_VALIDATE_REGEXP,
				array("options"=>array("regexp" =>"/^([a-zA-Z0-9\-\_])+$/i")) )) {
			$this->setError('userName', 'USER_NAME_HAS_INVALID_CHARS');
		}
	}
}
?>