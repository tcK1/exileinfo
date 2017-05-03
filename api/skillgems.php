<?php
/**
* Class for the skill gems graphs.
* 
**/

include(dirname(__FILE__)."/../requires/base.php");

class skillgems extends base {
    
    /**
     * Formats the array to a pie chart, based on google chart format.
     * 
     * @return array
     **/
    public function get_array() {
        $array = array();
        $labels = [
            "Gem",
            "Amount"
        ];
        array_push($array, $labels);
        foreach ( $this->get_data() as $id => $value ) {
            $aux = [$value['Gem']['poename'], $value['Count']];
            array_push($array, $aux);
        }
        return $array;
    }
    

}

if(isset($_GET["league"])){
    $class = new skillgems($_GET["league"], basename(__FILE__, '.php'));

?>
<style type="text/css">
    svg > g > g:last-child { pointer-events: none }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/iframe-resizer/3.5.14/iframeResizer.contentWindow.min.js"></script>
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
        var data = google.visualization.arrayToDataTable(<? echo($class->get_json()); ?>);
        
        // Set chart options
        var options = { title:'<? echo $class->get_title(); ?>',
                        sliceVisibilityThreshold: 0.03,
                        pieResidueSliceColor: 'brown',
                        pieSliceText: 'value-and-percentage',
                        width: '100%',
                        height: '100%',
                        chartArea:{
                            left:0,
                            top: 20,
                            bottom: 15,
                            right: 0,
                            width: '100%',
                            height: '100%',
                        },
                        tooltip: { 
                            trigger: 'selection'
                        },
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

        google.visualization.events.addListener(chart, 'onmouseover', function(entry) {
           chart.setSelection([{row: entry.row}]);
        });    
        
        google.visualization.events.addListener(chart, 'onmouseout', function(entry) {
           chart.setSelection([]);
        });

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

<div id="chart_div"></div>

<?php
} else {
    header('Content-Type: application/json');
    $response = array();
    $response['error'] = 'league not defined';
    echo json_encode($response);
}
?>