<?php
class formatter {
    
    public $data;
    
    public function __construct($data) {
        $this->data = $data;
    }
    
    public function get_ascendancies_array() {
        $array = array();
        $array['cols'] = array(
            // {id: 'task', label: 'Task', type: 'string'}
            array(id => 'ascendancy', label => 'Ascendancy', type => 'string'),
            array(id => 'amount', label => 'Amount', type => 'number')
            );
        $array['rows'] = array();
        foreach ( $this->data as $id => $value ) {
            // {c:[{v: 'Work'}, {v: 11}]}
            $aux = array(c => array(array(v => $value['Class']), array(v => $value['Count'])));
            array_push($array['rows'], $aux);
        }
        return $array;
    }
}



?>