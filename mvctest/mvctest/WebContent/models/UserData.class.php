<?php
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
		if (is_null($formInput))
			$this->initializeEmpty();
		else
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
		$this->errors[$errorName] = $errorValue;
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
	private function initialize() {
		$this->errorCount = 0;
		$errors = array();
		$this->validateFirstName();
		$this->validateLastName();
		$this->validateEmail();
		$this->validateGender();
	}

	private function initializeEmpty() {
		$this->errorCount = 0;
		$errors = array();
		$this->firstName = "";
		$this->lastName = "";
		$this->email = "";
		$this->gender = "";
	}

	private function stripInput($data) {
		// Require most data be free of blanks, slashes and special characters
		$data = trim ( $data );
		$data = stripslashes ( $data );
		$data = htmlspecialchars ( $data );
		return $data;
	}

	private function validateFirstName() {
		// First name should not have quoted characters
		if (!isset($this->formInput['firstName']))
			$this->firstName = '';
		else 
			$this->firstName = $this->stripInput($this->formInput['firstName']);
		    // More validation goes here
	}
	
	private function validateLastName() {
		// First name should not have quoted characters
		if (!isset($this->formInput['lastName']))
			$this->lastName = '';
		else {
			$this->lastName = $this->stripInput($this->formInput['lastName']);
			if (strlen($this->lastName) <= 1)   
		        $this->setError('lastName', "Last name too short"); 
		}
	}
	
	private function validateEmail() {
		// Email should not have quoted characters
		if (!isset($this->formInput['email']))
			$this->email = '';
		else 
			$this->email = $this->stripInput($this->formInput['email']);
		    // More validation goes here
	}
	
	private function validateGender() {
		// First name should not have quoted characters
		if (!isset($this->formInput['gender']))
			$this->gender = '';
		else 
			$this->gender = $this->stripInput($this->formInput['gender']);
		    // More validation goes here
	}
}
?>