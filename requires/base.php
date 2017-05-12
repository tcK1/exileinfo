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
                    case 'skillgems':
                        $collection = $database->SC_Statistic_SkillGems;
                        $this->title = "Skill Gems in Legacy";
                        break;
                    case 'supportgems':
                        $collection = $database->SC_Statistic_SupportGems;
                        $this->title = "Support Gems in Legacy";
                        break;
                    case 'uniqueitems':
                        $collection = $database->SC_Statistic_UniqueItems;
                        $this->title = "Unique Items in Legacy";
                        break;
                    case 'lifexes':
                        $collection = $database->legacy;
                        $this->title = "Life vs ES in Legacy";
                        break;
                    case 'coregems':
                        $collection = $database->legacy;
                        $this->title = "Core Gems in Legacy";
                        break;
                }
                break;
            case "hclegacy":
                switch ($base) {
                    case 'ascendancies':
                        $collection = $database->HC_Statistic_Ascendancies;
                        $this->title = "Ascendancies in Hardcore Legacy";
                        break;
                    case 'skillgems':
                        $collection = $database->HC_Statistic_SkillGems;
                        $this->title = "Skill Gems in Hardcore Legacy";
                        break;
                    case 'supportgems':
                        $collection = $database->HC_Statistic_SupportGems;
                        $this->title = "Support Gems in Hardcore Legacy";
                        break;
                    case 'uniqueitems':
                        $collection = $database->HC_Statistic_UniqueItems;
                        $this->title = "Unique Items in Hardcore Legacy";
                        break;
                    case 'lifexes':
                        $collection = $database->hardcore_legacy;
                        $this->title = "Life vs ES in Hardcore Legacy";
                        break;
                    case 'coregems':
                        $collection = $database->hardcore_legacy;
                        $this->title = "Core Gems in Hardcore Legacy";
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
    public function get_data($where = array(), $select = array()) {
        $collection = $this->collection;
        $cursor = $collection->find($where, $select); // Get all data inside the collection.
        return $cursor;
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