<?php
require_once dirname(__FILE__).'\..\..\WebContent\tests\DBMaker.class.php';
require_once dirname(__FILE__).'\DBMakerUnit.class.php';

class makeDBTest extends PHPUnit_Framework_TestCase {
  
  public function testValidUserCreate() {
  	DBMaker::setConfigurationPath(DBMakerUnit::$unitTestPath);
    $myDb = DBMaker::create ('ptest');
  }
}
?>