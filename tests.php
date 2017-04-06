<?php

class tests extends PHPUnit_Framework_TestCase {
	
	public function hasColsNRowsSCAscendancies() {
		require("softcore/ascendancies.php");
		$this->assertArrayHasKey($array,'cols');
		$this->assertArrayHasKey($array,'rows');
  	}
  	
  	public function hasColsNRowsHCAscendancies() {
		require("hardcore/ascendancies.php");
		$this->assertArrayHasKey($array,'cols');
		$this->assertArrayHasKey($array,'rows');
  	}
}

?>
