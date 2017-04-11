<?php
include(dirname(__FILE__)."/../requires/connection.php");
include(dirname(__FILE__)."/../requires/formatter.php");

class ascendancies {
    
    private $formatter;
    private $title;
    
    public function __construct($league) {
        $con = new connection();
        $collection = $con->get_db()->$league;
        $cursor = $collection->find();
        $data = iterator_to_array($cursor);
        $this->formatter = new formatter($data);
    }
    
    public function set_title($title) {
        $this->title = $title;
    }
    
    public function get_title() {
        return $this->title;
    }
    
    public function get_formatter() {
        return $this->formatter;
    }
    
    public function get_json() {
        return json_encode(
            $this->get_formatter()->get_ascendancies_array());
    }
}

if(isset($_GET["league"])){
    switch($_GET["league"]) {
        case "legacy":
            $class = new ascendancies("SC_Statistic_Ascendancies");
            $class->set_title("Ascendancies in Legacy");
            break;
        case "hclegacy":
            $class = new ascendancies("HC_Statistic_Ascendancies");
            $class->set_title("Ascendancies in Hardcore Legacy");
            break;
    }
}

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
    var data = new google.visualization.DataTable('<? echo $class->get_json(); ?>');
    
    // Set chart options
    var options = {'title':'<? echo $class->get_title(); ?>',
                   'width':500,
                   'height':500};
    
    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
    chart.draw(data, options);
    }
</script>

<div id="chart_div" align='center'></div>