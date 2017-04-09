<?php
class connection {
    
    private $db;
    
    public function __construct() {
        $string = file_get_contents(dirname(__FILE__)."/credentials.json");
        $json = json_decode($string, true);
        $connection = new MongoClient("mongodb://".$json["id"].":".$json["password"]."@ds049486.mlab.com:49486/heroku_869jvsp2");
        $this->db = $connection->heroku_869jvsp2;
    }
    
    public function get_db() {
        return $this->db;
    }
    
}
?>