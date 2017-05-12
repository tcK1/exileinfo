<?php
/**
* Class for the unique items graphs.
* 
**/

include(dirname(__FILE__)."/../requires/base.php");

class uniqueitems extends base {
    
    /**
     * Formats the array to a pie chart, based on google chart format.
     * 
     * @return array
     **/
    public function get_array() {
        $array = array();
        $labels = [
            "Item",
            "Amount"
        ];
        array_push($array, $labels);
        $data = $this->get_data(array(), array('Item.name', 'Count'));
        foreach ($data  as $id => $value) {
            $aux = [$value['Item']['name'], $value['Count']];
            array_push($array, $aux);
        }
        return $array;
    }
    

}

if(isset($_GET["league"])){
    $class = new uniqueitems($_GET["league"]);

?>
<link rel="stylesheet" href="/style/graphs.css"/>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">

    function getTotal(dataArray) {
        var total = 0;
       	for (var i = 1; i < dataArray.length; i++) {
          total += dataArray[i][1];
        }
        return total;
    }

    // Load the Visualization API and the corechart package.
    google.charts.load('current', {'packages':['corechart']});
    
    // Set a callback to run when the Google Visualization API is loaded.
    google.charts.setOnLoadCallback(drawChart);
    
    // Callback that creates and populates a data table,
    // instantiates the pie chart, passes in the data and
    // draws it.
    function drawChart() {
    
        var dataArray = <? echo($class->get_json()); ?>;
        var title = '<? echo $class->get_title(); ?>';
    
        // Create the data table.
        var data = google.visualization.arrayToDataTable(dataArray);
        
        var total = getTotal(dataArray);
        document.getElementById('total').innerText = 'Total: '+total;
        document.getElementById('title').innerText = title;
        
        // Set chart options
        var options = { sliceVisibilityThreshold: 0.03,
                        pieResidueSliceColor: 'brown',
                        pieSliceText: 'value-and-percentage',
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

<div class="chartWithOverlay">

    <div id="chart_div"></div>
    
    <div class="overlay">
        <div id="title"></div>
        <div id="total"></div>
    </div>

</div>

<?php
} else {
    header('Content-Type: application/json');
    $response = array();
    $response['error'] = 'league not defined';
    echo json_encode($response);
}
?>