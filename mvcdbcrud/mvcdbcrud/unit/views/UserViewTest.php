<?php
require_once dirname(__FILE__).'\..\..\WebContent\models\Messages.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\User.class.php'; 
require_once dirname(__FILE__).'\..\..\WebContent\views\MasterView.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\views\UserView.class.php';

class UserViewTest extends PHPUnit_Framework_TestCase {
	
  public function testShowUserViewWithUser() {
  	ob_start();
  	$validTest = array("userName" => "krobbins", "password" =>"xxx");
  	$_SESSION = array('user' => new User($validTest), 'base' => 'mvcdbcrud');
  	$validSubmission = array("submitterName" => "krobbins", "assignmentNumber" => "1",
  			"submissionFile" => "myText.apl");
  	$_SESSION['userSubmissions'] = array(new Submission($validSubmission));
  	$input = array("reviewerName" => "krobbins",
  			"submissionID" => 2,
  			"score" => "5",
  			"review" => "This was a great presentation"
  	);
  	$_SESSION['userReviews'] = array(new Review($input));
  	UserView::show();
    UserView::show();
    $output = ob_get_clean();
    $this->assertFalse(empty($output), 
    		"It should show a User view when passed a valid user");
  }
  
  public function testShowUserViewWithNullUser() {
  	 ob_start();
     $_SESSION = array('user' => null, 'base' => 'mvcdbcrud');
     $return = UserView::show();
     $output = ob_get_clean();
     $this->assertFalse(empty($output),
    		"It should show a User view when passed a null user");
  }
  
  public function testShowAllUsers() {
     // Test that the showAll produces output for users
  	 ob_start();
     $s1 = new User(array("userName" => "Kay", "password" => "xxx"));
     $s1 -> setUserId(1);
     $s2 = new User(array("userName" => "John", "password" => "yyy"));
     $s2 -> setUserId(2);  
     $_SESSION['users'] = array($s1, $s2);
     $_SESSION['base'] = 'mvcdbdcrud';
     $_SESSION['arguments'] = null;
     UserView::showall();
     $output = ob_get_clean();
     $this->assertFalse(empty($output), "It should show the Users table");
  }
}
?>