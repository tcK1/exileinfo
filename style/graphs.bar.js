/* global d3 */
/* global c3 */
/* global dataArray */
/* global info */
/* global title */

/* DEFAULTS */
if (typeof options === 'undefined') var options = {};
if (typeof options.interaction === 'undefined') options.interaction = true;
if (typeof options.legend === 'undefined') options.legend = false;
if (typeof options.tooltip === 'undefined') options.tooltip = false;
if (typeof options.zoom === 'undefined') options.zoom = true;
if (typeof options.subchart === 'undefined') options.subchart = false;

var chart = c3.generate({
    interaction: {
        enabled: options.interaction
    },
    tooltip: {
        show: options.tooltip
    },
    zoom: {
        enabled: options.zoom
    },
    subchart: {
        show: options.subchart
    },
    legend: {
        show: options.legend
    },
    bindto: '#chart',
    padding: {
        top: 50,
        right: (parseInt(d3.select('#chart').style('width'))*(0.3))
    },
    data: {
        columns: dataArray,
        type: 'bar'
    },
    bar: {
        width: {
            ratio: 1
        }
    },
    axis: {
        x: {
            type: 'category',
            categories: ' '
        }
    },
    onresized: function() {
        redrawLegend();
    }
});

var total = getTotal(dataArray);

d3.select('#title').html(title);
d3.select('#total').html('Total: ' + total);

var canvasWidth = parseInt(d3.select('#chart').style('width')),
    canvasHeight = parseInt(d3.select('#chart').style('height'));

var margin = { top: 60, right: (parseInt(d3.select('#chart').style('width'))*(0.3)), bottom: 60, left: 50 },
    width = canvasWidth - margin.left - margin.right,
    height = canvasHeight - margin.top - margin.bottom;


var legendCount = dataArray.length;

var legendWidth=10; var legendSpacing=4;

var legendPerPage = Math.floor(height/(legendWidth+legendSpacing)),
    totalPages = Math.ceil(legendCount/legendPerPage),
    pageNo = 1;

var startIndex=(pageNo-1)*legendPerPage;
var endIndex=startIndex+legendPerPage;
var seriesSubset=[];

for(var i=0;i<dataArray.length;i++){
    if(i>=startIndex && i<endIndex){
        seriesSubset.push(dataArray[i]);
    }
}

var svg = d3.select("#chart").select("svg")
    .attr("width", width + margin.left + margin.right)
    .attr("height", height + margin.top + margin.bottom)
    .append("g")
    .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

var bars = d3.selectAll('path.c3-bar')
    .on("mouseover", function(d) {
        d3.selectAll('path.c3-bar').style('opacity', 0.5);
        d3.select(this).style('opacity', 1);

        d3.selectAll('g.legendg').style('opacity', 0.5);
        d3.selectAll('g.legendg').each(function(p, j) {
          if(p[0] == d.id){
              d3.select(this).style('opacity', 1);
          }
        });

        d3.select('#info').html(info[0]+': '+d['id']+'&emsp;'+info[1]+': '+d['value']);
    })
    .on("mouseout", function(d) {
        d3.selectAll('path.c3-bar').style('opacity', 1);
        d3.selectAll('g.legendg').style('opacity', 1);
        d3.select('#info').html('');
    });

DrawLegendSubset(seriesSubset,legendPerPage,pageNo,totalPages);

function DrawLegendSubset(seriesSubset,legendPerPage,pageNo,totalPages) {

    var legend = svg.selectAll("g.legendg")
    .data(seriesSubset)
    .enter().append("g")
    .attr('class','legendg')
    .attr("transform", function (d, i) { return "translate(" + (width-40) + ","+ i*(legendWidth+legendSpacing) +")"; })
    .on('mouseover', function (d,i) {

        d3.selectAll('g.legendg').style('opacity', 0.5);
        d3.select(this).style('opacity', 1);

        d3.selectAll('path.c3-bar').style('opacity', 0.5);
        d3.selectAll('path.c3-bar').each(function(p, j) {
          if(p.id == d[0]){
              d3.select(this).style('opacity', 1);
          }
        });

        d3.select('#info').html(info[0]+': '+d[0]+'&emsp;'+info[1]+': '+d[1]);
    })
    .on('mouseout', function (id) {
        d3.selectAll('path.c3-bar').style('opacity', 1);
        d3.selectAll('g.legendg').style('opacity', 1);
        d3.select('#info').html('');
    })
    // .on('click', function (d,i) {
    // })
    ;

    legend.append("rect")
    .attr("x", 45)
    .attr("width", legendWidth)
    .attr("height", legendWidth)
    .attr("class", "legend")
    .style('fill',function(d,i){return chart.color(d[0]);});

    legend.append("text")
    .attr("x", 60)
    .attr("y", 5)
    .attr("dy", ".35em")
    .style("text-anchor", "start")
    .text(function (d) {

        var text = d[0];

        var canvas = document.createElement("canvas");
        var context = canvas.getContext("2d");
        context.font = d3.select('g.legendg').style("font");
        var metrics = context.measureText(text);

        var limit = margin.right-20;
        if(metrics.width > limit) {
            var spoints = '...';
            var spointsmeasure = context.measureText(spoints);
            var aux = '';
            var auxmeasure = context.measureText(aux);
            var i = 0;
            var nextmeasure = context.measureText(text[i]);

            while (auxmeasure.width+nextmeasure.width+spointsmeasure.width < limit-spointsmeasure.width) {

                aux += text[i];
                auxmeasure = context.measureText(aux);
                i++;
                nextmeasure = context.measureText(text[i]);

            }
            aux += spoints;

            text = aux;
        }
        return text;

    })
    .style('fill','#c3c3c3');

    if(totalPages > 1) {
        var pageText = svg.append("g")
        .attr('class','pageNo')
        .attr("transform", "translate(" + (width+7.5) + ","+ (legendPerPage+1)*(legendWidth+legendSpacing) +")");

        pageText.append('text').text(pageNo+'/'+totalPages)
        .style('fill','#c3c3c3')
        .attr('dx','.25em');

        var prevtriangle = svg.append("g")
        .attr('class','prev')
        .attr("transform", "translate(" + (width+5) + ","+ (legendPerPage+1.5)*(legendWidth+legendSpacing) +")")
        .on('click',prevLegend)
        .style('cursor','pointer');

        var nexttriangle = svg.append("g")
        .attr('class','next')
        .attr("transform", "translate(" + (width+20) + ","+ (legendPerPage+1.5)*(legendWidth+legendSpacing) +")")
        .on('click',nextLegend)
        .style('cursor','pointer');

        nexttriangle.append('polygon')
            .style('stroke','#c3c3c3')
            .style('fill','#c3c3c3')
            .attr('points','0,0, 10,0, 5,5');

        prevtriangle.append('polygon')
            .style('stroke','#c3c3c3')
            .style('fill','#c3c3c3')
            .attr('points','0,5, 10,5, 5,0');

        if(pageNo==totalPages){
            nexttriangle.style('opacity','0.5')
            nexttriangle.on('click','')
            .style('cursor','');
        }
        else if(pageNo==1){
            prevtriangle.style('opacity','0.5')
            prevtriangle.on('click','')
            .style('cursor','');
        }
    }
}

function redrawLegend() {
    svg.selectAll("g.legendg").remove();
    svg.select('.pageNo').remove();
    svg.select('.prev').remove();
    svg.select('.next').remove();

    canvasWidth = parseInt(d3.select('#chart').style('width')),
    canvasHeight = parseInt(d3.select('#chart').style('height'));

    width = canvasWidth - margin.left - margin.right,
    height = canvasHeight - margin.top - margin.bottom;

    DrawLegendSubset(seriesSubset,legendPerPage,pageNo,totalPages);
}

function prevLegend() {
    pageNo--;

    svg.selectAll("g.legendg").remove();
    svg.select('.pageNo').remove();
    svg.select('.prev').remove();
    svg.select('.next').remove();

    var startIndex=(pageNo-1)*legendPerPage;
    var endIndex=startIndex+legendPerPage;

    var seriesSubset=[];

    for(var i=0;i<dataArray.length;i++){
        if(i>=startIndex && i<endIndex){
            seriesSubset.push(dataArray[i]);
        }
    }

    DrawLegendSubset(seriesSubset,legendPerPage,pageNo,totalPages);
}

function nextLegend() {
    pageNo++;

    svg.selectAll("g.legendg").remove();
    svg.select('.pageNo').remove();
    svg.select('.prev').remove();
    svg.select('.next').remove();

    var startIndex=(pageNo-1)*legendPerPage;
    var endIndex=startIndex+legendPerPage;

    var seriesSubset=[];

    for(var i=0;i<dataArray.length;i++){
        if(i>=startIndex && i<endIndex){
            seriesSubset.push(dataArray[i]);
        }
    }

   DrawLegendSubset(seriesSubset,legendPerPage,pageNo,totalPages);
}

function getTotal(dataArray) {
    var total = 0;
   	for (var i = 0; i < dataArray.length; i++) {
      total += dataArray[i][1];
    }
    return total;
}