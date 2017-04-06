<?php

class Test extends PHPUnit_Framework_TestCase
{
	public function hasColsNRows() {
		require("softcore/sc_ascendancies.php");
		$this->assertArrayHasKey($array,'cols');
		$this->assertArrayHasKey($array,'rows');
  	}
}

?>
