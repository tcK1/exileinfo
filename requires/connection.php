<?php
/**
 * Class that makes the connection with the mongo database.
 * Connects to the database and get the desired collection as a constructor parametter. 
 * 
 **/

class connection {
    
    /**
     * @var MongoCollection
     **/
    private $collection;
    
    /**
     * @param string $league
     **/
    public function __construct($league) {
        // Connects using the MongoDB URI via envioriment variable.
        $connection = new MongoClient(getenv("MONGODBURI"));
        $database = $connection->heroku_869jvsp2;
        $collection;
        
        // Select collection based on league.
        switch($league) {
            case "legacy":
                $collection = $database->SC_Statistic_Ascendancies;
                break;
            case "hclegacy":
                $collection = $database->HC_Statistic_Ascendancies;
                break;
        }
        $this->collection = $collection;
    }
    
    /**
     * @return MongoCollection
     **/
    public function get_collection() {
        return $this->collection;
    }
    
    /**
     * @return array
     **/
    public function get_data() {
        $collection = $this->get_collection();
        $cursor = $collection->find(); // Get all data inside the collection.
        $data = iterator_to_array($cursor);
        return $data;
    }
}
?>