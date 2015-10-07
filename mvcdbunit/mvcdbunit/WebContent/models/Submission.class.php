<?php
class Submission {
	private $uploadDir = 'uploads';
	private $errorCount;
	private $errors;
	private $formInput;
    private $assignmentNumber;
	private $submissionFile;   
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
	
	public function getAssignmentNumber() {
		return $this->assignmentNumber;
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
				            "assignmentNumber" => $this->assignmentNumber,
				            "submissionFile" => $this->submissionFile,
				          
		); 
		return $paramArray;
	}

	public function __toString() {
		$str = "User name: ".$this->userName."<br>".
			    "Assignment number: ".$this->assignmentNumber."<br>".
				"Submission file: ".$this->submissionFile;
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
		   $this->validateAssignmentNumber();
		   $this->validateSubmissionFile();
		}
	}

	private function initializeEmpty() {
		$this->errorCount = 0;
		$errors = array();
	 	$this->userName = "";
	 	$this->submissionFile = "";
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
		if (!isset($this->formInput['submissionFile'])) {
  		   $this->setError('submissionFile', 'SUBMISSION_EMPTY');
		   return;
		}
		$file = $this->formInput['submissionFile'];
		if (is_null($file) || !isset($file["name"]) || !isset($file["tmp_name"])) {
		   $this->setError('submissionFile', 'SUBMISSION_EMPTY');
		   return;
		}
		$info = new SplFileInfo(basename($file['name']));
		$this->submissionFile = $this->userName . $this->assignmentNumber. "." .
				                $info->getExtension();

		$targetFile = dirname(__FILE__).DIRECTORY_SEPARATOR."..".
		              DIRECTORY_SEPARATOR.$this->uploadDir.
		              DIRECTORY_SEPARATOR.$this->submissionFile;
		
		if (!move_uploaded_file($file["tmp_name"], $targetFile)) {
			$this->setError('submissionFile', 'SUBMISSION_UPLOAD_ERROR');
		    return;
		}
	}
}
?>