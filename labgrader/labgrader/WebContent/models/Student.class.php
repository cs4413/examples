<?php
class Student {
	private $errorCount;
	private $errors;
	private $formInput;
	private $firstName;
	
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

	public function getFirstName() {
		return $this->firstName;
	}
	
	public function getParameters() {
		// Return data fields as an associative array
		$paramArray = array("firstName" => $this->firstName); 
		return $paramArray;
	}

	public function __toString() {
		$str = "First name: ".$this->firstName;
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
		   $this->validateFirstName();
	}

	private function initializeEmpty() {
		$this->errorCount = 0;
		$errors = array();
	 	$this->userName = "";
	}

	private function validateFirstName() {
		// Username should only contain letters 
		$this->firstName = $this->extractForm('firstName');
		if (empty($this->firstName))
			$this->setError('firstName', 'FIRST_NAME_EMPTY');
		elseif (!filter_var($this->firstName, FILTER_VALIDATE_REGEXP,
			array("options"=>array("regexp" =>"/^([a-zA-Z0-9\-\_])+$/i")) )) {
			$this->setError('firstName', 'FIRST_NAME_HAS_INVALID_CHARS');
			$this->errorCount ++;
		}
	}	
}
?>