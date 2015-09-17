<?php
class Lab {
	private $errorCount;
	private $errors;
	private $formInput;
	private $labName;
	
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

	public function getLabName() {
		return $this->labName;
	}
	
	public function getParameters() {
		// Return data fields as an associative array
		$paramArray = array("labName" => $this->labName); 
		return $paramArray;
	}

	public function __toString() {
		$str = "Lab name: ".$this->labName;
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
		else  	 
		   $this->validateLabName();
	}

	private function initializeEmpty() {
		$this->errorCount = 0;
		$errors = array();
	 	$this->labName = "";
	}

	private function validateLabName() {
		// Firstname should only contain letters
		$this->labName = $this->extractForm('labName');
		if (empty($this->labName)) {
			$this->setError('labName', 'LAB_NAME_EMPTY');
			$this->errorCount ++;
		}
	}	
}
?>