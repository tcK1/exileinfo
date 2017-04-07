<?php
class connection {
    
    private $db;
    
    public function __construct() {
        $connection = new MongoClient("mongodb://ticokaic:exaltedorb@ds049486.mlab.com:49486/heroku_869jvsp2");
        $this->db = $connection->heroku_869jvsp2;
    }
    
    public function get_db() {
        return $this->db;
    }
    
}
?>