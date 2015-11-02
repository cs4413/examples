<?php
class Submission {

	private $errorCount;
	private $errors;
	private $formInput;
	private $assignmentId;
	private $submissionFile;
	private $submissionId;
	private $submitterId;
	private $submitterName;
	private $filename;
	private $fileTempName;
	
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
	
	public function getAssignmentId() {
		return $this->assignmentId;
	}
	
	
	public function getSubmissionFile() {
		return $this->submissionFile;
	}
	
	public function getSubmissionId() {
		return $this->submissionId;
	}
	
	public function getSubmitterId() {
		return $this->submitterId;
	}
	
	public function getSubmitterName() {
		return $this->submitterName;
	}
	
	public function getParameters() {
		// Return data fields as an associative array
		$paramArray = array("submitterName" => $this->submitterName,
				"assignmentId" => $this->assignmentId,
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
	
	public function setSubmissionFile($filename) {
		// Set the value of the submissionFile to $filename
		$this->submissionFile = $filename;
	}
	
	public function setSubmissionId($id) {
		// Set the value of the submissionId to $id
		$this->submissionId = $id;
	}
	
	public function setSubmitterId($id) {
		// Set the value of the submitterId to $id
		$this->submitterId = $id;
	}
	
	public function __toString() {
		$errorStr = "";
		foreach($this->errors as $error)
			$errorStr = $errorStr . " ". $error;
		echo $this->assignmentId;	
		$str = 'Submitter name: '.$this->submitterName.'<br>'.
			   'Assignment id: '.$this->assignmentId.'<br>'.
			   'Submission file: '.$this->submissionFile.'<br>'.				
		       'Submission id: '. $this->submissionId.'<br>'.
		       'Errors: ' . $errorStr;
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
		$this->submissionFile = "";
		$this->errors = array();
		if (is_null($this->formInput)) {
			$this->submitterName = "";
			$this->assignmentId = 0;
		} else  {	 
		   $this->validateSubmitterName();
		   $this->validateAssignmentId();
		}
	}
	
	private function validateAssignmentId() {
		// Assignment Id should be a positive integer
		$this->assignmentId = $this->extractForm('assignmentId');
		if (empty($this->assignmentId))
			$this->setError('assignmentId', 'ASSIGNMENT_NUMBER_EMPTY');
		elseif (!is_numeric($this->assignmentId))
	     	$this->setError('assignmentId', 'ASSIGNMENT_NUMBER_INVALID');
		elseif (!filter_var($this->assignmentId, FILTER_VALIDATE_REGEXP,
				array("options"=>array("regexp" =>"/^([0-9])+$/i")) )) {
			$this->setError('assignmentId', 'ASSIGNMENT_NUMBER_INVALID');
		} else {
			$value = intval($this->assignmentId);
			if ($value <= 0)
				$this->setError('assignmentId', 'ASSIGNMENT_NUMBER_INVALID');
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
	
}
?>