<?php
class Assignment {
	private $errorCount;
	private $errors;
	private $formInput;
	private $description;
	private $assignmentId;
	private $assignmentOwnerId;

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
	
	public function getAssignmentOwnerId() {
		return $this->assignmentOwnerId;
	}
	
	public function getDescription() {
		return $this->description;
	}	

	public function getParameters() {
		// Return data fields as an associative array
		$paramArray = array("assignmentId" => $this->assignmentId,
			            	"description" => $this->description,
				            "assignmentOwnerId" => $this->assignmentOwnerId
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
	
	public function setAssignmentId($id) {
		// Set the value of the assignmentId to $id
		$this->assignmentId = $id;
	}
	
	public function __toString() {
		$errorStr = "";
		foreach($this->errors as $error)
			$errorStr = $errorStr . " ". $error;
		$str = "Assignment Id: ".$this->assignmentId.
		       " Assignment owner Id: ".$this->assignmentOwnerId;
		if (!empty($errorStr))
		    $str = $str. " Errors: [$errorStr.]";
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
		$this->assignmentId = 0;
		$this->errors = array ();
		if (is_null ($this->formInput)) {
			$this->description = "";
	 	    $this->assignmentOwnerId = "";	
		} else {
			$this->validateDescription();
			$this->validateAssignmentOwnerId();
		}
	}
	
	private function validateDescription() {
		// Assignment description should not be empty
		$this->description = $this->extractForm('description');
		if (empty($this->description)) 
			$this->setError('description', 'ASSIGNMENT_DESCRIPTION_EMPTY');
	}
	
	private function validateAssignmentOwnerId() {
		// The assignment needs an owner
		$this->assignmentOwnerId = $this->extractForm('assignmentOwnerId');
		if (empty($this->assignmentOwnerId))
			$this->setError('assignmentOwnerId', 'ASSIGNMENT_OWNER_ID_EMPTY');
	}
}
?>