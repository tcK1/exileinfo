<?php
class connection {
    
    private $db;
    
    public function __construct() {
        $connection = new MongoClient(getenv("MONGODBURI"));
        $this->db = $connection->heroku_869jvsp2;
    }
    
    public function get_db() {
        return $this->db;
    }
    
}
?>