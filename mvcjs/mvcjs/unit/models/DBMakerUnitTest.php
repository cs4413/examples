<?php
require_once dirname(__FILE__).'\..\..\WebContent\models\Configuration.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\Database.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\tests\DBMaker.class.php';
require_once dirname(__FILE__).'\DBMakerUnit.class.php';

class DBMakerUnitTest extends PHPUnit_Framework_TestCase {
  
  public function testValidCreate() {
    $myDb = DBMakerUnit::createDB ('ptest');
  }
}
?>