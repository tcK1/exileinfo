<?php
/**
* Class for the support gems graphs.
* 
**/

include(dirname(__FILE__)."/../requires/base.php");

class supportgems extends base {
    
    /**
     * Formats the array to a pie chart, based on google chart format.
     * 
     * @return array
     **/
    public function get_array() {
        $array = array();

        $tag = strtolower($_GET["tag"]);
        $tags = explode(",", $tag);
        $js =       "function() {";
        $js = $js.      "return (this.Gem.gemTags.toLowerCase().indexOf('".$tags[0]."') != -1)";
        foreach($tags as $value) $js = $js. "&& (this.Gem.gemTags.toLowerCase().indexOf('".$value."') != -1)";
        $js = $js.  ";}";

        $data = $this->get_data(array('$where' => $js), array('Gem.poename', 'Count'));
        foreach ($data as $id => $value) {
            $aux = [$value['Gem']['poename'], $value['Count']];
            array_push($array, $aux);
        }

        usort($array, function ($a, $b) {
            return $b[1] - $a[1];
        });

        return $array;
    }
    

}

if(isset($_GET["league"])){
    $class = new supportgems($_GET["league"]);

?>
<html>
<head>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.17/d3.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/c3/0.4.11/c3.js"></script>
    
    <link rel="stylesheet" href="/style/graphs.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/c3/0.4.11/c3.min.css" />

</head>
<body>
    <div class="wrapper">
        <div class="overlay">
            <div id="title"></div>
            <div id="total"></div>
            <div id="info"></div>
        </div>
        <div id="chart"></div>
    </div>
    <script type="text/javascript">

        var dataArray = <? echo($class->get_json()); ?>;
        var title = '<? echo $class->get_title(); ?>'
        var info = ['Support Gem', 'Amount'];

    </script>
    <script src="/style/graphs.bar.js"></script>
</body>
</html>

<?php
} else {
    header('Content-Type: application/json');
    $response = array();
    $response['error'] = 'league not defined';
    echo json_encode($response);
}
?>