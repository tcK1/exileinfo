<?php

class tests extends PHPUnit_Framework_TestCase {
	
	public function test_hasColsNRows_SC_Ascendancies() {
		include($_SERVER['DOCUMENT_ROOT']."/softcore/ascendancies.php");
		$this->assertArrayHasKey($array,'cols');
		$this->assertArrayHasKey($array,'rows');
  	}
  	
  	public function test_hasColsNRows_HC_Ascendancies() {
		include($_SERVER['DOCUMENT_ROOT']."/hardcore/ascendancies.php");
		$this->assertArrayHasKey($array,'cols');
		$this->assertArrayHasKey($array,'rows');
  	}
}

?>
