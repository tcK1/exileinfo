<?php
include($_SERVER['DOCUMENT_ROOT']."/requires/connection.php");

class ascendancies {
    
    private $data;
    
    public function __construct() {
        $con = new connection();
        $collection = $con->get_db()->SC_Statistic_Ascendancies;
        $cursor = $collection->find();
        $this->data = iterator_to_array($cursor);
    }
    
    public function get_data_as_array() {
        $array = array();
        $array['cols'] = array(
            // {id: 'task', label: 'Task', type: 'string'}
            array(id => 'ascendancy', label => 'Ascendancy', type => 'string'),
            array(id => 'amount', label => 'Amount', type => 'number')
            );
        $array['rows'] = array();
        foreach ( $this->data as $id => $value )
        {
            // {c:[{v: 'Work'}, {v: 11}]}
            $aux = array(c => array(array(v => $value['Class']), array(v => $value['Count'])));
            array_push($array['rows'], $aux);
        }
        return $array;
    }
    
    public function get_data_as_json() {
        return json_encode($this->get_data_as_array());
    }
}

$class = new ascendancies();
?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">

    // Load the Visualization API and the corechart package.
    google.charts.load('current', {'packages':['corechart']});
    
    // Set a callback to run when the Google Visualization API is loaded.
    google.charts.setOnLoadCallback(drawChart);
    
    // Callback that creates and populates a data table,
    // instantiates the pie chart, passes in the data and
    // draws it.
    function drawChart() {
    
    // Create the data table.
    var data = new google.visualization.DataTable(<? echo $class->get_data_as_json(); ?>);
    
    // Set chart options
    var options = {'title':'Ascendancy in Legacy',
                   'width':500,
                   'height':500};
    
    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
    chart.draw(data, options);
    }
</script>

<div id="chart_div" align='center'></div>