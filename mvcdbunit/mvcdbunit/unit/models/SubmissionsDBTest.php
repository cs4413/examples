<?php
require_once dirname(__FILE__).'\..\..\WebContent\models\Database.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\Messages.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\Submission.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\SubmissionsDB.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\User.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\UsersDB.class.php';
require_once dirname(__FILE__).'\DBMaker.php';


class SubmissionsDBTest extends PHPUnit_Framework_TestCase {
	
  public function testGetAllSubmissions() {
  	  $myDb = DBMaker::create ('ptest');
  	  Database::clearDB();
  	  $db = Database::getDB('ptest', 'C:\xampp\myConfig.ini');
  	  $submissions = SubmissionsDB::getAllSubmissions();
  	  $this->assertEquals(3, count($submissions), 
  	  		'It should fetch all of the submissions in the test database');

  	  foreach ($submissions as $submission) 
          $this->assertTrue(is_a($submission, 'Submission'), 
        		'It should return valid Submission objects');
  }

}
?>