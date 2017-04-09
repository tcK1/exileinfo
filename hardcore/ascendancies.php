<?php
include(dirname(__FILE__)."/../requires/connection.php");
include(dirname(__FILE__)."/../requires/formatter.php");

class ascendancies {
    
    private $formatter;
    
    public function __construct() {
        $con = new connection();
        $collection = $con->get_db()->HC_Statistic_Ascendancies;
        $cursor = $collection->find();
        $data = iterator_to_array($cursor);
        $this->formatter = new formatter($data);
    }
    
    public function get_formatter() {
        return $this->formatter;
    }
    
    public function get_json() {
        return json_encode(
            $this->get_ascendancies_array(
                $this->data));
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
    var data = new google.visualization.DataTable(<? echo $class->get_formatter()->get_json(); ?>);
    
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