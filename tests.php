<?php
include(dirname(__FILE__)."/requires/formatter.php");
include(dirname(__FILE__)."/requires/connection.php");
//$this->assertArrayHasKey($array,'rows');

class tests extends PHPUnit_Framework_TestCase {
	
	public function test_ascendancies() {
		$class = new connection("legacy");
		$array = json_decode('{"58e7b16d5cd85010b89b9fac":{"_id":{"$id":"58e7b16d5cd85010b89b9fac"},"Class":"Raider","Count":15},"58e7b16d5cd85010b89b9fad":{"_id":{"$id":"58e7b16d5cd85010b89b9fad"},"Class":"Occultist","Count":3},"58e7b16d5cd85010b89b9fae":{"_id":{"$id":"58e7b16d5cd85010b89b9fae"},"Class":"Pathfinder","Count":11},"58e7b16d5cd85010b89b9faf":{"_id":{"$id":"58e7b16d5cd85010b89b9faf"},"Class":"Slayer","Count":1},"58e7b16d5cd85010b89b9fb0":{"_id":{"$id":"58e7b16d5cd85010b89b9fb0"},"Class":"Necromancer","Count":7},"58e7b16d5cd85010b89b9fb1":{"_id":{"$id":"58e7b16d5cd85010b89b9fb1"},"Class":"Elementalist","Count":4},"58e7b16d5cd85010b89b9fb2":{"_id":{"$id":"58e7b16d5cd85010b89b9fb2"},"Class":"Assassin","Count":2},"58e7b16d5cd85010b89b9fb3":{"_id":{"$id":"58e7b16d5cd85010b89b9fb3"},"Class":"Inquisitor","Count":4},"58e7b16d5cd85010b89b9fb4":{"_id":{"$id":"58e7b16d5cd85010b89b9fb4"},"Class":"Berserker","Count":2},"58e7b16d5cd85010b89b9fb5":{"_id":{"$id":"58e7b16d5cd85010b89b9fb5"},"Class":"Guardian","Count":1}}', true);
  		$class = new formatter($array);
  		$aux = $class->get_ascendancies_array();
  		//$this->assertContains(array("Ascendancy","Amount"), $aux);
	}
}

?>
