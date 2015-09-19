<?php
class Grades {
	private $errorCount;
	private $errors;
	private $formInput;
	private $classList = array();
	private $listFile = 'c:\xampp\htdocs\classList.csv';
	
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

	public function getclassList() {
		return $this->classList;
	}
	
	public function getListFile() {
		return $this->listFile;
	}
	
	public function getParameters() {
		// Return data fields as an associative array
		$paramArray = array("classList" => $this->classList,
				            "listFile"  => $this->listFile
		); 
		return $paramArray;
	}

	public function __toString() {
		$str = "File name: ".$this->listFile.
		        "<br><br>ClassList: ". print_r($this->classList, true);
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
		else {
		   $this->validateListFile();
		   if (empty($this->getError('classList')))
		       $this->validateClassList();
		   else
		   	   $this->setError('classList', CLASS_LIST_INPUT_FILE_INVALID);
		}
	}

	private function initializeEmpty() {
		$this->errorCount = 0;
		$errors = array();
	 	$this->classList = array();
	 	$this->listFile = "";
	}

	private function validateClassList() {
		// This is going to read in a course file and create an array of student objects
	}
	
	private function validateListFile() {
		$this->listFile = "";
		if (isset($this->formInput['listFile'])) 
			$this->listFile = trim($this->formInput[$valueName]);
		setClassList($this->listFile);
	}
	
	private function setClassList($filename) {
		if (empty($this->listFile)) {
			$this->setError('listFile', 'LIST_FILE_ADDRESS_EMPTY');
			$this->errorCount ++;
		if (($handle = fopen($filename, "r")) == FALSE) {
			$this->setError('listFile', 'LIST_FILE_INVALID');
			$this->errorCount ++;
			while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
				$num = count($data);
				echo "<p> $num fields in line $row: <br /></p>\n";
				$row++;
				for ($c=0; $c < $num; $c++) {
					echo $data[$c] . "<br />\n";
				}
			}
			fclose($handle);
		}
// 		foreach (file($filename) as $line) {
// 			list($lastName, $firstName, $ipAddress) = 
// 			    explode(',', $line, 3) + array(NULL, NULL, NULL);
// 			if ($lastName !== NULL) {
// 				$array = array('lastName' => $lastName, 
// 						       'firstName' => $firstName,
// 						       'ipAddress' => $ipAddress);
// 				array_push($this->classList, new Student($array));
// 			}	 
// 		}
		
		
	}
	
	
}
?>