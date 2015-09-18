<?php
class Student {
	private $errorCount;
	private $errors;
	private $formInput;
	private $firstName;
	private $lastName;
	private $ipAddress;
	
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
	
	public function getLastName() {
		return $this->lastName;
	}
	
	public function getIpAddress() {
		return $this->ipAddress;
	}
	
	public function getParameters() {
		// Return data fields as an associative array
		$paramArray = array("firstName" => $this->firstName,
				            "lastName"  => $this->lastName,
				            "ipAddress" => $this->ipAddress
		); 
		return $paramArray;
	}

	public function __toString() {
		$str = "First name: ".$this->firstName.
		        " Last name: ".$this->lastName.
		        " IP address: ".$this->ipAddress;
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
	   	   $this->validateLastName();
		   $this->validateIpAddress();
	}

	private function initializeEmpty() {
		$this->errorCount = 0;
		$errors = array();
	 	$this->userName = "";
	}

	private function validateFirstName() {
		// First name should only contain letters 
		$this->firstName = $this->extractForm('firstName');
		if (empty($this->firstName)) {
			$this->setError('firstName', 'FIRST_NAME_EMPTY');
			$this->errorCount ++;
		}elseif (!filter_var($this->firstName, FILTER_VALIDATE_REGEXP,
			array("options"=>array("regexp" =>"/^([a-zA-Z0-9\-\_])+$/i")) )) {
			$this->setError('firstName', 'FIRST_NAME_HAS_INVALID_CHARS');
			$this->errorCount ++;
		}
	}
	
	private function validateLastName() {
		// Last name should only contain letters
		$this->lastName = $this->extractForm('lastName');
		if (empty($this->lastName)) {
			$this->setError('lastName', 'LAST_NAME_EMPTY');
			$this->errorCount ++;
		} elseif (!filter_var($this->lastName, FILTER_VALIDATE_REGEXP,
				array("options"=>array("regexp" =>"/^([a-zA-Z0-9\-\_])+$/i")) )) {
			$this->setError('lastName', 'LAST_NAME_HAS_INVALID_CHARS');
			$this->errorCount ++;
		}
	}
	
	private function validateIpAddress() {
		// IP address should only contain numbers and periods
		$this->ipAddress = $this->extractForm('ipAddress');
		if (empty($this->ipAddress)) {
			$this->setError('ipAddress', 'IP_ADDRESS_EMPTY');
			$this->errorCount ++;
		}
		// TODO: Find regular expression to check IP address validity
	}
}
?>