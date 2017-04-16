<?php
/**
* Class for the ascendancies graphs.
* Creates a new connection to get the collection and then creates a formatter with the data.
**/

include(dirname(__FILE__)."/../requires/connection.php");
include(dirname(__FILE__)."/../requires/formatter.php");

class ascendancies {
    
    /**
     * @var formatter
     **/
    private $formatter;
    
    /**
     * @var string
     **/
    private $title;
    
    /**
     * @param string $league
     **/
    public function __construct($league) {
        $con = new connection($league);
        
        // Creates new formatter based on the database data.
        $this->formatter = new formatter($con->get_data());
        
        // Sets the graph title based on the league
        switch($league) {
            case "legacy":
                $this->title = "Ascendancies in Legacy";
                break;
            case "hclegacy":
                $this->title = "Ascendancies in Hardcore Legacy";
                break;
        }
    }
    
    /**
     * @return string
     **/
    public function get_title() {
        return $this->title;
    }
    
    /**
     * @return json
     **/
    public function get_json() {
        return json_encode(
            // Gets the needed data in the right format.
            $this->formatter->get_ascendancies_array()
        );
    }
}

if(isset($_GET["league"])){
    $class = new ascendancies("legacy");

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
        var options = { title:'<? echo $class->get_title(); ?>',
                        backgroundColor: 'transparent',
                        titleTextStyle: {
                            color: '#c3c3c3'
                        },
                        hAxis: {
                            textStyle: {
                                color: '#c3c3c3'
                            },
                            titleTextStyle: {
                                color: '#c3c3c3'
                            }
                        },
                        vAxis: {
                            textStyle: {
                                color: '#c3c3c3'
                            },
                            titleTextStyle: {
                                color: '#c3c3c3'
                            }
                        },
                        legend: {
                            textStyle: {
                                color: '#c3c3c3'
                            }
                        } 
        };
        
        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
        
        function resizeChart () {
            chart.draw(data, options);
        }
        if (document.addEventListener) {
            window.addEventListener('resize', resizeChart);
        }
        else if (document.attachEvent) {
            window.attachEvent('onresize', resizeChart);
        }
        else {
            window.resize = resizeChart;
        }
    }
</script>

<div id="chart_div" align='center' style="width: 100%; height: 100%;"></div>

<?php
} else {
    header('Content-Type: application/json');
    $response = array();
    $response[error] = 'league not defined';
    echo json_encode($response);
}
?>