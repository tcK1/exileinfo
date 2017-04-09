<?php
include(dirname(__FILE__)."/../requires/formatter.php");
//$this->assertArrayHasKey($array,'rows');

class tests extends PHPUnit_Framework_TestCase {
	
	public function test_ascendancies() {
		$array = unserialize('a:10:{s:24:"58e7b16d5cd85010b89b9fac";a:3:{s:3:"_id";C:7:"MongoId":24:{58e7b16d5cd85010b89b9fac}s:5:"Class";s:6:"Raider";s:5:"Count";i:15;}s:24:"58e7b16d5cd85010b89b9fad";a:3:{s:3:"_id";C:7:"MongoId":24:{58e7b16d5cd85010b89b9fad}s:5:"Class";s:9:"Occultist";s:5:"Count";i:3;}s:24:"58e7b16d5cd85010b89b9fae";a:3:{s:3:"_id";C:7:"MongoId":24:{58e7b16d5cd85010b89b9fae}s:5:"Class";s:10:"Pathfinder";s:5:"Count";i:11;}s:24:"58e7b16d5cd85010b89b9faf";a:3:{s:3:"_id";C:7:"MongoId":24:{58e7b16d5cd85010b89b9faf}s:5:"Class";s:6:"Slayer";s:5:"Count";i:1;}s:24:"58e7b16d5cd85010b89b9fb0";a:3:{s:3:"_id";C:7:"MongoId":24:{58e7b16d5cd85010b89b9fb0}s:5:"Class";s:11:"Necromancer";s:5:"Count";i:7;}s:24:"58e7b16d5cd85010b89b9fb1";a:3:{s:3:"_id";C:7:"MongoId":24:{58e7b16d5cd85010b89b9fb1}s:5:"Class";s:12:"Elementalist";s:5:"Count";i:4;}s:24:"58e7b16d5cd85010b89b9fb2";a:3:{s:3:"_id";C:7:"MongoId":24:{58e7b16d5cd85010b89b9fb2}s:5:"Class";s:8:"Assassin";s:5:"Count";i:2;}s:24:"58e7b16d5cd85010b89b9fb3";a:3:{s:3:"_id";C:7:"MongoId":24:{58e7b16d5cd85010b89b9fb3}s:5:"Class";s:10:"Inquisitor";s:5:"Count";i:4;}s:24:"58e7b16d5cd85010b89b9fb4";a:3:{s:3:"_id";C:7:"MongoId":24:{58e7b16d5cd85010b89b9fb4}s:5:"Class";s:9:"Berserker";s:5:"Count";i:2;}s:24:"58e7b16d5cd85010b89b9fb5";a:3:{s:3:"_id";C:7:"MongoId":24:{58e7b16d5cd85010b89b9fb5}s:5:"Class";s:8:"Guardian";s:5:"Count";i:1;}}');
  		$class = new formatter($array);
	}
}

?>
