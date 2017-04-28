<?php
/**
 * Class that formats the crude array.
 * 
 **/
class formatter {
    
    /**
     * @var array
     **/
    public $data;
    
    /**
     * @param array $data
     **/
    public function __construct($data) {
        $this->data = $data;
    }
    
    /**
     * Formats the array to a pie chart, based on google chart format.
     * 
     * @return array
     **/
    public function get_ascendancies_array() {
        $array = array();
        $labels = [
            "Ascendancy",
            "Amount"
        ];
        array_push($array, $labels);
        foreach ( $this->data as $id => $value ) {
            $aux = [$value['Class'], $value['Count']];
            array_push($array, $aux);
        }
        return $array;
    }
}



?>