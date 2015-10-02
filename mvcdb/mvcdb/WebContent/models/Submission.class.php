<?php
class Submission {
	private $errorCount;
	private $errors;
	private $formInput;
	private $userName;
	private $submissionFile;   // will ultimately be a hash
	
	public function __construct($formInput = null) {
		$this->formInput = $formInput;
		Messages::reset();
		$this->initialize();
		echo "<br> in submission: ";
		print_r($formInput);
	}

	public function getError($errorName) {
		if (isset($this->errors[$errorName]))
			return $this->errors[$errorName];
		else
			return "";
	}

	public function setError($errorName, $errorValue) {
		// Sets a particular error value and increments error count
		$this->errors[$errorName] =  Messages::getError($errorValue);
		$this->errorCount ++;
	}

	public function getErrorCount() {
		return $this->errorCount;
	}

	public function getErrors() {
		return $this->errors;
	}
	
	public function getSubmissionFile() {
		return $this->submissionFile;
	}

	public function getUserName() {
		return $this->userName;
	}
	
	public function getParameters() {
		// Return data fields as an associative array
		$paramArray = array("userName" => $this->userName,
				            "submissionFile" => $this->submissionFile
		); 
		return $paramArray;
	}

	public function __toString() {
		$str = "User name: ".$this->userName."<br>SubmissionFile: ".$this->submissionFile;
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
		$errors = array();
		if (is_null($this->formInput))
			$this->initializeEmpty();
		else  {	 
		   $this->validateUserName();
		   $this->validateSubmissionFile();
		}
	}

	private function initializeEmpty() {
		$this->errorCount = 0;
		$errors = array();
	 	$this->userName = "";
	 	$this->submissionFile = "";
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
	
	private function validateSubmissionFile() {
		// Password should not be blank
		$this->submissionFile = '';
		if (isset($this->formInput['submissionFile'])) {
			$file = $this->formInput['submissionFile'];
			if (is_null($file) || !isset($file["name"]))
		   	    $this->setError('submissionFile', 'SUBMISSION_EMPTY');
		    else
		    	$this->submissionFile = $file["name"];
		} else
			$this->setError('submissionFile', 'SUBMISSION_EMPTY');
		print_r($this->errors);
	}
}
?>