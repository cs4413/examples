<?php
include ("Messages.class.php");
class UserData {
	private $errorCount;
	private $errors;
	private $formInput;
	private $firstName;
	private $lastName;
	private $email;
	private $gender;
	
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
	
	public function getEmail() {
		return $this->email;
	}

	public function getFirstName() {
		return $this->firstName;
	}
	
	public function getGender() {
		return $this->gender;
	}
	
	public function getLastName() {
		return $this->firstName;
	}
	
	public function getParameters() {
		// Return data fields as an associative array
		$paramArray = array("firstName" => $this->firstName,
				            "lastName" => $this->lastName,
			            	"email" => $this->email,
			              	"gender" => $this->gender); 
		return $paramArray;
	}

	public function __toString() {
		$str = "First name:[".$this->firstName."] lastName:[".$this->lastName."] ".
				"email:[" .$this->email ."] gender:[".$this->gender. "]";
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
	      $this->validateEmail();
	      $this->validateGender();
		  $this->validateFirstName();
		  $this->validateLastName();
		}	
	}

	private function initializeEmpty() {
		$this->errorCount = 0;
		$errors = array();
		$this->firstName = "";
		$this->lastName = "";
		$this->email = "";
		$this->gender = "";
	}



	
	private function validateEmail() {
		// Email should not have quoted characters
		$this->email = $this->extractForm('email');
		    // More validation goes here
	}
	
	private function validateGender() {
		// Gender should not have quoted characters
		$this->gender = $this->extractForm('gender');
		    // More validation goes here
	}
	
	private function validateFirstName() {
		// First name should not have quoted characters
		$this->firstName = $this->extractForm('firstName');
		// More validation goes here
	}
	
	private function validateLastName() {
		// Last name should not have quoted characters
		$this->lastName = $this->extractForm('lastName');
		// Last name should be at least 2 characters
		if (strlen($this->lastName) <= 1) {
			$this->setError('lastName', 'LAST_NAME_TOO_SHORT');
			$this->errorCount ++;
		}
	}
}
?>