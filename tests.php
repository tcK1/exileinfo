<?php
include(dirname(__FILE__)."/api/ascendancies.php");

class tests extends PHPUnit_Framework_TestCase {
	
	public function test_ascendancies() {
		$class = new ascendancies('legacy', 'ascendancies');
		
		//fwrite(STDERR, print_r($class->get_array(), TRUE));
        
  		//$aux = $class->get_array();
  		//$this->assertContains(array("Ascendancy","Amount"), $aux);
	}
}

?>
