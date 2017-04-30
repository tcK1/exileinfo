<?php
/**
 * Class that makes the connection with the mongo database.
 * Connects to the database and get the desired collection as a constructor parametter. 
 * 
 **/

abstract class base {
    
    /**
     * @var MongoCollection
     **/
    private $collection;
    
    /**
     * @var string
     **/
    private $title;
    
    /**
     * @param string $league
     **/
    public function __construct($league, $base) {
        // Connects using the MongoDB URI via envioriment variable.
        $connection = new MongoClient(getenv("MONGODBURI"));
        $db = getenv("MONGODB");
        $database = $connection->$db;
        
        $collection;
        
        // Select collection based on league and base.
        switch($league) {
            case "legacy":
                switch ($base) {
                    case 'ascendancies':
                        $collection = $database->SC_Statistic_Ascendancies;
                        $this->title = "Ascendancies in Legacy";
                        break;
                }
                break;
            case "hclegacy":
                switch ($base) {
                    case 'ascendancies':
                        $collection = $database->HC_Statistic_Ascendancies;
                        $this->title = "Ascendancies in Hardcore Legacy";
                        break;
                }
                break;
        }
        $this->collection = $collection;
    }
    
    /**
     * @return string
     **/
    public function get_title() {
        return $this->title;
    }
    
    /**
     * @return array
     **/
    public function get_data() {
        $collection = $this->collection;
        $cursor = $collection->find(); // Get all data inside the collection.
        $data = iterator_to_array($cursor);
        return $data;
    }
    
    /**
     * @return json
     **/
    public function get_json() {
        return json_encode(
            // Gets the needed data in the right format.
            $this->get_array()
        );
    }
}
?>