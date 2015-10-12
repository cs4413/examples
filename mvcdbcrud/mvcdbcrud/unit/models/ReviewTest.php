<?php
require_once dirname(__FILE__).'\..\..\WebContent\models\Messages.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\Review.class.php';

class ReviewTest extends PHPUnit_Framework_TestCase {
	
  public function testValidReviewCreate() {
  	ob_start();
  	$validTest = array("userName" => "Kay",
             	       "submissionID" => "R3023",
	           	       "score" => "5",
		               "review" => "This was a great presentation"
		              );
    $s1 = new Review($validTest);
    $this->assertTrue(is_a($s1, 'Review'), 
    	'It should create a valid Review object when valid input is provided');
    ob_end_flush();
  }
  
  public function testInvalidReviewCreate() {
  	ob_start();
  	$invalidTest = array("userName" => "Kay$",
  		                "submissionID" => "R3023",
  			            "score" => "5",
  		            	"review" => "This was a great presentation"
  	                    );
  	$s1 = new Review($invalidTest);
  	$this->assertTrue(is_a($s1, 'Review'),
  			'It should create a valid Review object when valid input is provided');
  	ob_end_flush();
  }

}
?>