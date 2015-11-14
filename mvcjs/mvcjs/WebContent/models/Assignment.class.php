<?php
class Assignment {
	private $errorCount;
	private $errors;
	private $formInput;
	private $assignmentDescription;
	private $assignmentId;
	private $assignmentOwnerName;
	private $assignmentTitle;
	private $assignmentCreationDate;
	private $assignmentDueDate;

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
	
	public function getAssignmentCreationDate() {
		return $this->assignmentCreationDate;
	}
	
	public function getAssignmentDescription() {
		return $this->assignmentDescription;
	}
	
	public function getAssignmentDueDate() {
		return $this->assignmentDueDate;
	}
		
	public function getAssignmentId() {
		return $this->assignmentId;
	}
	
	public function getAssignmentOwnerName() {
		return $this->assignmentOwnerName;
	}
	
	public function getAssignmentTitle() {
		return $this->assignmentTitle;
	}
	
	public function getParameters() {
		// Return data fields as an associative array
		$paramArray = array("assignmentId" => $this->assignmentId,
				            "assignmentTitle" => $this->assignmentTitle,
			            	"assignmentDescription" => $this->assignmentDescription,
				            "assignmentOwnerName" => $this->assignmentOwnerName,
				            "assignmentCreationDate" => $this->assignmentCreationDate,
				            "assignmentDueDate" => $this->assignmentDueDate
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
		       "Assignment title: ".$this->assignmentTitle.
		       " Assignment owner name: ".$this->assignmentOwnerName.
		       " Assignment description: ".$this->assignmentDescription. 
		       " Assignment creation date: ".$this->assignmentCreationDate.
		       " Assignment due date: ".$this->assignmentDueDate;
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
		$this->assignmentCreationDate = date('Y-m-d G:i:s');
		$this->assignmentDueDate = date('Y-m-d G:i:s');
		$this->errors = array ();
		if (is_null ($this->formInput)) {
			$this->assignmentDescription = "";
	 	    $this->assignmentOwnerName = "";	
		} else {
			$this->validateAssignmentDescription();
			$this->validateAssignmentOwnerName();
			$this->validateAssignmentTitle();
			$this->validateAssignmentDueDate();
		}
	}
	
	private function validateAssignmentDescription() {
		// Assignment description should not be empty
		$this->assignmentDescription = $this->extractForm('assignmentDescription');
		if (empty($this->assignmentDescription)) 
			$this->setError('assignmentDescription', 'ASSIGNMENT_DESCRIPTION_EMPTY');
	}
	
	private function validateAssignmentDueDate() {
		// Assignment due date should not be empty
		$this->assignmentDueDate = $this->extractForm('assignmentDueDate');
		if (empty($this->assignmentDueDate))
			$this->setError('assignmentDueDate', 'ASSIGNMENT_DUE_DATE_EMPTY');
	}
	
	private function validateAssignmentOwnerName() {
		// The assignment needs an owner
		$this->assignmentOwnerName = $this->extractForm('assignmentOwnerName');
		if (empty($this->assignmentOwnerName))
			$this->setError('assignmentOwnerName', 'ASSIGNMENT_OWNER_NAME_EMPTY');
	}
	
	private function validateAssignmentTitle() {
		// Assignment title should not be empty
		$this->assignmentTitle = $this->extractForm('assignmentTitle');
		if (empty($this->assignmentTitle))
			$this->setError('assignmentTitle', 'ASSIGNMENT_TITLE_EMPTY');
	}
}
?>