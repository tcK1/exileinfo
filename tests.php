<?php
spl_autoload_register('autoloader');

function autoloader($className)
{
    include(dirname(__FILE__)."/softcore/".$className.".php");

}
//$this->assertArrayHasKey($array,'rows');

class tests extends PHPUnit_Framework_TestCase {
	
	public function test_hasColsNRows_SC_Ascendancies() {
		$array = array();
		ascendancies::get_data_as_array($array);
  	}
  	
  	public function test_hasColsNRows_HC_Ascendancies() {
		//$class = new ascendancies(true);
  	}
}

?>
