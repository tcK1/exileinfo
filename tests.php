<?php
spl_autoload_register('autoloader');

function autoloader($className)
{
    include(dirname(__FILE__)."/softcore/ascendancies.php");
    include(dirname(__FILE__)."/hardcore/ascendancies.php");
}
//$this->assertArrayHasKey($array,'rows');

class tests extends PHPUnit_Framework_TestCase {
	
	public function test_hasColsNRows_SC_Ascendancies() {
		//$class = new ascendancies(true);
  	}
  	
  	public function test_hasColsNRows_HC_Ascendancies() {
		//$class = new ascendancies(true);
  	}
}

?>
