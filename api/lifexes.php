<?php
/**
* Class for the ascendancies graphs.
* 
**/

include(dirname(__FILE__)."/../requires/base.php");

class lifexes extends base {
    
    /**
     * Formats the array to a pie chart, based on google chart format.
     * 
     * @return array
     **/
    public function get_array() {
        $array = array();
        
        $life = 0;
        $es = 0;
        foreach ( $this->get_data() as $id => $value ) {
            if($value['character']['treeStats']['esPercent'] > $value['character']['treeStats']['lifePercent']){
                $es++;
            } else {
                $life++;
            }
        }
        
        $labels = [
            "Defense",
            "Amount"
        ];
        array_push($array, $labels);

        $auxL = ['Life', $life];
        $auxE = ['ES', $es];
        
        array_push($array, $auxL);
        array_push($array, $auxE);

        return $array;
    }
    

}

if(isset($_GET["league"])){
    $class = new lifexes($_GET["league"], basename(__FILE__, '.php'));

?>
<link rel="stylesheet" href="/style/graphs.css"/>
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
                        width: '100%',
                        height: '100%',
                        chartArea:{
                            left:15,
                            top: 15,
                            bottom: 0,
                            right: 0,
                            width: '100%',
                            height: '100%'
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