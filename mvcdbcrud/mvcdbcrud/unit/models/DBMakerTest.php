<?php
require_once dirname(__FILE__).'\..\..\WebContent\tests\DBMaker.class.php';


class makeDBTest extends PHPUnit_Framework_TestCase {
	
  public function testValidUserCreate() {
    $myDb = DBMaker::create ('ptest');
  }
}
?>