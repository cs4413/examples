<?php
class Submission {
	private $uploadDir = 'uploads';
	private $errorCount;
	private $errors;
	private $formInput;
	private $assignmentNumber;
	private $submissionFile;
	private $submissionId;
	private $submitterName;
	
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
	
	public function getAssignmentNumber() {
		return $this->assignmentNumber;
	}
	
	public function getSubmissionFile() {
		return $this->submissionFile;
	}
	
	public function getSubmissionId() {
		return $this->submissionId;
	}
	
	public function getSubmission() {
		return "Placeholder for upload";
	}

	public function getSubmitterName() {
		return $this->submitterName;
	}
	
	public function getParameters() {
		// Return data fields as an associative array
		$paramArray = array("submitterName" => $this->submitterName,
				"assignmentNumber" => $this->assignmentNumber,
				"submissionFile" => $this->submissionFile,
				"submissionId" => $this->submissionId
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
	
	public function setSubmissionId($id) {
		// Set the value of the submissionId to $id
		$this->submissionId = $id;
	}
	
	public function __toString() {
		$errorStr = "";
		foreach($this->errors as $error)
			$errorStr = $errorStr . " ". $error;
			
		$str = "Submitter name: ".$this->submitterName."<br>".
			    "Assignment number: ".$this->assignmentNumber."<br>".
				"Submission file: ".$this->submissionFile."<br>".
		        "Submission id: ". $this->submissionId."<br>".
		        "Errors: " . $errorStr;
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
		$this->submissionId = 0;
		$this->errors = array();
		if (is_null($this->formInput)) {
			$this->submitterName = "";
	 	    $this->submissionFile = "";
		} else  {	 
		   $this->validateSubmitterName();
		   $this->validateAssignmentNumber();
		   $this->validateSubmissionFile();
		}
	}
	
	private function validateAssignmentNumber() {
		// Username should only contain letters, numbers, dashes and underscore
		$this->assignmentNumber = $this->extractForm('assignmentNumber');
		if (empty($this->assignmentNumber))
			$this->setError('assignmentNumber', 'ASSIGNMENT_NUMBER_EMPTY');
		elseif (!is_numeric($this->assignmentNumber))
	     	$this->setError('assignmentNumber', 'ASSIGNMENT_NUMBER_INVALID');
		elseif (!filter_var($this->assignmentNumber, FILTER_VALIDATE_REGEXP,
				array("options"=>array("regexp" =>"/^([0-9])+$/i")) )) {
			$this->setError('assignmentNumber', 'ASSIGNMENT_NUMBER_INVALID');
		} else {
			$value = intval($this->assignmentNumber);
			if ($value <= 0)
				$this->setError('assignmentNumber', 'ASSIGNMENT_NUMBER_INVALID');
		}
	}

	private function validateSubmitterName() {
		// Submitter name should only contain letters, numbers, dashes and underscore
		$this->submitterName = $this->extractForm('submitterName');
		if (empty($this->submitterName)) 
			$this->setError('submitterName', 'SUBMITTER_NAME_EMPTY');
		elseif (!filter_var($this->submitterName, FILTER_VALIDATE_REGEXP,
			array("options"=>array("regexp" =>"/^([a-zA-Z0-9\-\_])+$/i")) )) {
			$this->setError('submitterName', 'SUBMITTER_NAME_HAS_INVALID_CHARS');
		}
	}
	
	private function validateSubmissionFile() {
		// Submission file upload has not been done yet.
		$this->submissionFile = '';
		if (!isset($this->formInput['submissionFile'])) {
  		   $this->setError('submissionFile', 'SUBMISSION_EMPTY');
		   return;
		}
		$this->submissionFile = $this->formInput['submissionFile'];
		if (empty($this->submissionFile)) 
			$this->submissionFile = $this->submitterName . $this->assignmentNumber. '.txt';
			
	}
}
?>