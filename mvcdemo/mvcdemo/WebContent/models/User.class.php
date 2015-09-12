<?php
class User {
	private $formInput;
	private $userName;
	
	public function __construct($formInput = null) {
		$this->formInput = $formInput;
		$this->initialize();
	}

	public function getUserName() {
		return $this->userName;
	}
	
	private function extractForm($valueName) {
		// Extract a stripped value from the form array
		$value = "";
		if (!is_null($this->formInput) &&
			isset($this->formInput[$valueName])) {
			$value = trim($this->formInput[$valueName]);
			$value = stripslashes ($value);
			$value = htmlspecialchars ($value);
			return $value;
		}
	}
	
	private function initialize() {
		$this->validateUserName();
	}

	private function validateUserName() {
		$this->userName = $this->extractForm('userName');
	}	
}
?>