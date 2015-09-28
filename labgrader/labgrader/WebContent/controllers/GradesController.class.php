<?php
class GradesController {
	
	public static function run($labs) {
		$classList = dirname(__FILE__).DIRECTORY_SEPARATOR."..".
				     DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR.
				     "classList.csv";
		$validTest = array('listFile' => $classList);
		echo $classList;
		$s1 = new Grades($validTest);
		GradesView::show($s1, $labs);
	}
}
?>