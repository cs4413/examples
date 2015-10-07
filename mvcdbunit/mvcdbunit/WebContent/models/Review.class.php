<?php
class Review {
	private $errorCount;
	private $errors;
	private $formInput;
	private $firstName;
	private $lastName;
	private $submissionID;
	private $score;
	private $review;
	
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

	public function setError($errorName, $errorValue) {
		// Sets a particular error value and increments error count
		if (!isset($this->errors, $errorName)) {
   		   $this->errors[$errorName] =  Messages::getError($errorValue);
		   $this->errorCount ++;
		}
	}

	public function getErrorCount() {
		return $this->errorCount;
	}

	public function getErrors() {
		return $this->errors;
	}

	public function getFirstName() {
		return $this->firstName;
	}
	
	public function getParameters() {
		// Return data fields as an associative array
		$paramArray = array("firstName" => $this->firstName,
				            "lastName" => $this->lastName,
				            "submissionID" => $this->submissionID,
				            "score" => $this->score,
				            "review" => $this->review
		); 
		return $paramArray;
	}

	public function __toString() {
		$str = "First name: ".$this->firstName.
		       " Last name: ".$this->lastName.
		       " Submission ID: ".$this->submissionID.
		       " Score: ".$this->score.
		       " Review: ".$this->review;
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
		$errors = array ();
		if (is_null ( $this->formInput ))
			$this->initializeEmpty();
		else {
			$this->validateFirstName();
			$this->validateLastName();
			$this->validateSubmissionID();
			$this->validateScore();
			$this->validateReview();
		}
	}

	private function initializeEmpty() {
		$this->errorCount = 0;
		$errors = array();
	 	$this->firstName = "";
	 	$this->lastName = "";
	 	$this->submissionIDName = "";
	 	$this->score = "";
	 	$this->review = "";
	}

	private function validateFirstName() {
		// First name should only contain letters
		$this->firstName = $this->extractForm('firstName');
		if (empty($this->firstName))
			$this->setError('firstName', 'FIRST_NAME_EMPTY');
		elseif (!filter_var($this->firstName, FILTER_VALIDATE_REGEXP,
			array("options"=>array("regexp" =>"/^([a-zA-Z])+$/i")) )) {
			$this->setError('firstName', 'FIRST_NAME_HAS_INVALID_CHARS');
		}
	}
	
	private function validateLastName() {
		// Last name should only contain letters, blanks, hyphens and '
		$this->lastName = $this->extractForm('lastName');
		if (empty($this->lastName)) 
			$this->setError('lastName', 'LAST_NAME_EMPTY');
		elseif (!filter_var($this->lastName, FILTER_VALIDATE_REGEXP, //todo
				array("options"=>array("regexp" =>"/^([a-zA-Z])+$/i")) )) {
			$this->setError('lastName', 'LAST_NAME_HAS_INVALID_CHARS');
		}
	}
	
	private function validateSubmissionID() {
		// Submission ID should contain ..... TODO
		$this->submissionID = $this->extractForm('submissionID');
		if (empty($this->submissionID)) 
			$this->setError('submissionID', 'SUBMISSION_ID_EMPTY');
		// todo
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
}
?>