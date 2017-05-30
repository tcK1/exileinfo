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
    public function __construct($league) {
        // Connects using the MongoDB URI via envioriment variable.
        $connection = new MongoClient(getenv("MONGODBURI"));
        $db = getenv("MONGODB");
        $database = $connection->$db;

        $collection;

        // Select collection based on league and base.
        switch($league) {
            case "legacy":
                switch (get_class($this)) {
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
                switch (get_class($this)) {
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
            case "ssflegacy":
                switch (get_class($this)) {
                    case 'ascendancies':
                        $collection = $database->SCSSF_Statistic_Ascendancies;
                        $this->title = "Ascendancies in SSF Legacy";
                        break;
                    case 'skillgems':
                        $collection = $database->SCSSF_Statistic_SkillGems;
                        $this->title = "Skill Gems in SSF Legacy";
                        break;
                    case 'supportgems':
                        $collection = $database->SCSSF_Statistic_SupportGems;
                        $this->title = "Support Gems in SSF Legacy";
                        break;
                    case 'uniqueitems':
                        $collection = $database->SCSSF_Statistic_UniqueItems;
                        $this->title = "Unique Items in SSF Legacy";
                        break;
                    case 'lifexes':
                        $collection = $database->selectCollection('ssf legacy');
                        $this->title = "Life vs ES in SSF Legacy";
                        break;
                    case 'coregems':
                        $collection = $database->selectCollection('ssf legacy');
                        $this->title = "Core Gems in SSF Legacy";
                        break;
                }
                break;
            case "ssfhclegacy":
                switch (get_class($this)) {
                    case 'ascendancies':
                        $collection = $database->HCSSF_Statistic_Ascendancies;
                        $this->title = "Ascendancies in SSF Hardcore Legacy";
                        break;
                    case 'skillgems':
                        $collection = $database->HCSSF_Statistic_SkillGems;
                        $this->title = "Skill Gems in SSF Hardcore Legacy";
                        break;
                    case 'supportgems':
                        $collection = $database->HCSSF_Statistic_SupportGems;
                        $this->title = "Support Gems in SSF Hardcore Legacy";
                        break;
                    case 'uniqueitems':
                        $collection = $database->HCSSF_Statistic_UniqueItems;
                        $this->title = "Unique Items in SSF Hardcore Legacy";
                        break;
                    case 'lifexes':
                        $collection = $database->selectCollection('hardcore_ssf hc legacy');
                        $this->title = "Life vs ES in SSF Hardcore Legacy";
                        break;
                    case 'coregems':
                        $collection = $database->selectCollection('hardcore_ssf hc legacy');
                        $this->title = "Core Gems in SSF Hardcore Legacy";
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
    public function get_data($query = array(), $select = array()) {
        $collection = $this->collection;
        $cursor = $collection->find($query, $select); // Get all data inside the collection.
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