<?php

class Test extends PHPUnit_Framework_TestCase
{
	public function hasColsNRows_SC_Ascendancies() {
		require("softcore/sc_ascendancies.php");
		$this->assertArrayHasKey($array,'cols');
		$this->assertArrayHasKey($array,'rows');
  	}
  	
  	public function hasColsNRows_HC_Ascendancies() {
		require("hardcore/hc_ascendancies.php");
		$this->assertArrayHasKey($array,'cols');
		$this->assertArrayHasKey($array,'rows');
  	}
}

?>
