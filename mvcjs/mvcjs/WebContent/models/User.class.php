<?php
class User {
	private $errorCount;
	private $errors;
	private $formInput;
	private $password;
	private $passwordHash;
	private $userId;
	private $userName;

	
	public function __construct($formInput = null) {
		$this->formInput = $formInput;
		Messages::reset();
		$this->initialize();
	}

	public function getError($errorName) {
		// Return the error string associated with $errorName
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
	
	public function getPasswordHash() {
		return $this->passwordHash;
	}
	
	public function getUserId() {
		return $this->userId;
	}

	public function getUserName() {
		return $this->userName;
	}
	
	public function getParameters() {
		// Return data fields as an associative array
		$paramArray = array("userName" => $this->userName,
				            "userId" => $this->userId
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
	
	public function verifyPassword($hash) {
		// Set the value of passwordHash to hash
		return password_verify($this->password, $hash);
	}
	
	public function setUserId($id) {
		// Set the value of the userId to $id
		$this->userId = $id;
	}

	public function __toString() {
		$errorStr = "";
		foreach($this->errors as $error)
			$errorStr = $errorStr . " ". $error;
		$str = "User name: ".$this->userName."<br>
				Password hash: ".$this->passwordHash."<br> 
		        User id: ". $this->userId."<br> 
		        Errors:  ".$errorStr. "<br>";
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
		$this->errors = array();
		$this->userId = null;
		if (is_null($this->formInput)) {
			$this->userName = "";	   
	 	    $this->password = "";
	 	    $this->passwordHash = "";
		} else  {	 
		   $this->validateUserName();
		   $this->validatePassword();
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
	
	private function validatePassword() {
		// Password should not be blank
		if (isset($this->formInput['password'])) {
		    $this->password = $this->extractForm('password');
		    $this->passwordHash = password_hash($this->password, PASSWORD_DEFAULT);
		    if (empty($this->password))   
			   $this->setError('password', 'PASSWORD_EMPTY');	
		    // Other password requirements implemented here;
		   
		} elseif (isset($this->formInput['passwordHash'])) 
			$this->passwordHash =  $this->formInput['passwordHash'];
		else
			$this->setError('password', 'USER_PASSWORD_INCORRECT');
	}
}
?>