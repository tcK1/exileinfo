<?php
//$this->assertArrayHasKey($array,'rows');

class tests extends PHPUnit_Framework_TestCase {
	
	public function test_hasColsNRows_SC_Ascendancies() {
		include(dirname(__FILE__)."/softcore/ascendancies.php");
		$class = new ascendancies();
  	}
  	
  	public function test_hasColsNRows_HC_Ascendancies() {
		include(dirname(__FILE__)."/hardcore/ascendancies.php");
		$class = new ascendancies();
  	}
}

?>
