<?php
require_once dirname(__FILE__).'\..\..\WebContent\models\Messages.class.php';
require_once dirname(__FILE__).'\..\..\WebContent\models\Configuration.class.php';

class ConfigurationTest extends PHPUnit_Framework_TestCase {
	
  public function testValidAssignmentCreate() {
  	Configuration::setConfigurationPath('C:\xampp\myConfig.ini');
    $path = Configuration::getConfigurationPath();
    $passArray = parse_ini_file(Configuration::getConfigurationPath());
    $this->assertEquals($passArray['username'], "root", 
    		"It should return a username of root for default configuration");
  }
}
?>