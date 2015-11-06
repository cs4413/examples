<?php
require_once dirname(__FILE__).'\..\..\WebContent\models\Messages.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\Review.class.php';

class ReviewTest extends PHPUnit_Framework_TestCase {
	
  public function testValidReviewCreate() {
  	ob_start();
  	$validTest = array("reviewerName" => "Kay",
             	       "submissionId" => "R3023",
	           	       "score" => "5",
		               "review" => "This was a great presentation"
		              );
    $s1 = new Review($validTest);
    $this->assertTrue(is_a($s1, 'Review'), 
    	'It should create a valid Review object when valid input is provided');
    $this->assertEquals($s1->getErrorCount(), 0,
    		'It should not have errors when creating a valid review');
    ob_end_flush();
  }
  
  public function testInvalidReviewCreate() {
  	ob_start();
  	$invalidTest = array("reviewerName" => "Kay$",
  		                "submissionId" => "R3023",
  			            "score" => "5",
  		            	"review" => "This was a great presentation"
  	                    );
  	$s1 = new Review($invalidTest);
  	$this->assertTrue(is_a($s1, 'Review'),
  			'It should create a valid Review object when invalid input is provided');
  	$this->assertGreaterThan(0, $s1->getErrorCount(),
  			'It should errors if invalid input is provided');
  	ob_end_flush();
  }

}
?>