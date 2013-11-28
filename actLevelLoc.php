
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<head>

  <title>Actitivty level with location</title>

  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
  <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
   <META HTTP-EQUIV="EXPIRES" CONTENT="0">
      <META HTTP-EQUIV="CONTENT-LANGUAGE" CONTENT="en-US">
      <META HTTP-EQUIV="CONTENT-TYPE" CONTENT="text/html; charset=UTF-8">
    <META NAME="ROBOTS" CONTENT="ALL">
    
    <!--Style-->
     <link rel="stylesheet" type="text/css" href="style.css"> 
</head>




<body>
   <div id="openModal" class="modalWindow">
	    <div>
	    	<svg id="modalPie"></svg>
	        <a href="#ok" title="Ok" class="ok">Ok</a>
	    </div>
	</div>

 <?php require("navigation.php"); ?>

	<div class="subHeader"> 
		<h2> Activity level based on location </h2>
        <div class="dataDate">October</div>
	</div>
    
    <div class="contents">
    	<div class="mainDataView">
            	<svg class="chart"></svg>
        </div>
      <div class="rightPanels">
        	<ul>
                <li>
                <button class="arrow-left" type="button"></button>
                <button class = "rect_button" type="button" onclick="foo()">Month</button>
                <button class="arrow-right" type="button"></button> 
                </li>
                <li>
                <button class = "rect_button" type="button">Week</button>
                </li>
                <li> Data title <a href="#openModal">View Detail</a>
                	<svg id = "piechart"></svg>
                	<svg id = "legend"></svg>
                </li>
            </ul>
        </div>
    </div>
<script src="http://d3js.org/d3.v3.min.js"></script>
<script type="text/javascript">

<!-- modal detail view -->

var mpwidth = 600,
	mpheight = 300,
	mpradius = Math.min(mpwidth, mpheight) /2;

var color = d3.scale.category20();

var mparc = d3.svg.arc()
	.outerRadius(mpradius - 10)
	.innerRadius((mpradius -10) / 3);

var mpie = d3.layout.pie()
	.sort(null)
	.value(function(d){ return 1; });

function showDetailPie() {
	var psvg = d3.select("#modalPie")
		.attr("width", mpwidth)
		.attr("height", mpheight)
	  	.append("g")
	  	.attr("transform","translate(" + mpwidth / 2 + "," + mpheight / 2 + ")")
	  	;

  		d3.csv("pie.csv", function(error, data) {	

			var g = psvg.selectAll(".arc")
				.data(pie(data)) // bind data
			  .enter().append("g")	
			  	.attr("class", "arc")
			  	;

			g.append("path")
				.attr("d", arc)
				.style("fill", function(d) { return color(d.data.place); })
				;
		});


}


<!-- rigt panel data view -->

var pwidth = 600,
	pheight = 300,
	radius = Math.min(pwidth, pheight) /2;

var color = d3.scale.category20();

var arc = d3.svg.arc()
	.outerRadius(radius - 10)
	.innerRadius((radius -10) / 3);

var pie = d3.layout.pie()
	.sort(null)
	.value(function(d){ return 1; });

function changePie() {
	var psvg = d3.select("#piechart")
		.attr("width", pwidth)
		.attr("height", pheight)
	  	.append("g")
	  	.attr("transform","translate(" + pwidth / 2 + "," + pheight / 2 + ")")
	  	;

	d3.csv("pie.csv", function(error, data) {	

			var g = psvg.selectAll(".arc")
				.data(pie(data)) // bind data
			  .enter().append("g")	
			  	.attr("class", "arc");
	
			g.append("path")
				.attr("d", arc)
				.on("mouseover", function(d){ 
					d3.select(this)
					.style("stroke", color(d.data.place))
					.style("stroke-linejoin", "round")
					.transition()
					.duration(200)
					.style("stroke-width", 10)
					;
				})
				.on("mouseout", function(d){ 
					d3.select(this)
					.transition()
					.duration(200)
					.style("stroke-width", 0)
					;
				})
				.style("fill", function(d) { return color(d.data.place); })
				.append("svg:title")
				.text(function(d){return d.data.place;})
				;

			var legend = d3.select("#legend")
				.attr("width", pwidth)
				.attr("height", pheight);

			var legendgroup = legend.append("g");

			legendgroup.selectAll("rect")
				.data(data).enter()
			  .append("rect")
				.attr("x", 200)
				.attr("y", function(d, i) { return i * 20;})
				.attr("width", 10)
				.attr("height", 10)
				.style("fill", function(d) { return color(d.place);});

			legendgroup.selectAll("text")
				.data(data).enter()
			  .append("text")
				.text(function(d){return d.place;})
				.attr("x", 220)
				.attr("y", function(d, i) { return i * 20;})
				.attr("dy", ".71em")
				.attr("text-anchor", "left")
				.attr("font-family", "sans-serif")
				.attr("font-size", "12px")
				.attr("fill", "BLACK");
	});

}

changePie();

function change(day) {
	console.log(day);
	pie.value(function(d) { 
		return d[day];});
	changePie();
}


<!-- main data view -->
var selected = null;

var margin = {top: 20, right: 30, bottom: 30, left:90},
	width = 1020 - margin.left - margin.right,
	height = 500 - margin.top - margin.bottom;
	
var y = d3.scale.linear()
	.range([height, 0]);
	
var x = d3.scale.ordinal()
	.rangeRoundBands([0, width], .1, 0);
	
var xAxis = d3.svg.axis()
	.scale(x)
	.orient("bottom");	
var yAxis = d3.svg.axis()
	.scale(y)
	.orient("left");

var chart = d3.select(".chart")
    .attr("height", height + margin.top + margin.bottom)
	.attr("width", width + margin.left + margin.right)
	.append("g")
		.attr("transform", "translate(" + margin.left + "," + margin.top + ")");
	
	
d3.tsv("data.tsv", type, function(error, data) {
	x.domain(data.map(function(d) {return d.day;}));
  	y.domain([0, d3.max(data, function(d) { return d.value; })]);
  
	chart.append("g")
		.attr("class", "x axis")
		.attr("transform", "translate(0," + height + ")")
		.call(xAxis);
		
	chart.append("g")
		.attr("class", "y axis")
		.call(yAxis)
		.append("text")
		.attr("transform", "rotate(-90)")
		.attr("dy", "-3.5em")
		.attr("dx", "-7em")
		.style("text-anchor", "end")
		.text("Activity level");
	
	chart.selectAll(".bar")
		.data(data)
		.enter().append("rect")
		.attr("class", "bar")	
		.attr("x", function(d) { return x(d.day);})
		.attr("y", function(d) { return y(d.value);})
		.attr("width", x.rangeBand())
		.attr("height", function(d) { return height - y(d.value); })
		.on("mouseover", function(d){
			if(selected != d.day) {
				d3.select(this).style("stroke", "skyblue")
				.style("stroke-width", 10)
				.style("stroke-linejoin", "round")
				;
			}
		})
		.on("mouseout", function(d){
			if(selected != d.day){d3.select(this).style("stroke", "none");}
			})
		.on("click", function(d){
			selected = d.day;
			d3.selectAll(".bar").style("fill", "steelblue")
				.style("stroke", "none");
			d3.select(this).style("fill", "orange");

			change(d.day);
		});
});
console.log("hello world");
function type(d) {
  d.value = +d.value; // coerce to number
  return d;
}

    </script>

</body>

</html>



