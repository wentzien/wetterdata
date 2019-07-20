<script src="canvasjs/canvasjs.min.js"></script>

<!--Header-->
<div data-role="header">
        <h1>Der heutige Tag</h1>
</div>

<!--Tabs-->
<div data-role="tabs" id="tabs">
  <div data-role="navbar">
    <ul>
      <li><a href="#temp" data-ajax="false">Temperatur</a></li>
      <li><a href="#druck" data-ajax="false">Luftdruck</a></li>
      <li><a href="#feuchte" data-ajax="false">Luftfeuchtigkeit</a></li>
      <li><a href="#tau" data-ajax="false">Taupunkt</a></li>
    </ul>
  </div>
    
<!--Temperatur-->
  <div id="temp" class="ui-body-d ui-content">
      <div id="chartContainer1" style="height: 370px; width: 100%;"></div>
  </div>
    
<!--Luftdruck-->    
  <div id="druck" class="ui-body-d ui-content">
      <div id="chartContainer2" style="height: 370px; width: 100%;"></div>
  </div>

<!--Luftfeuchte-->
  <div id="feuchte" class="ui-body-d ui-content">
      <div id="chartContainer3" style="height: 370px; width: 100%;"></div>
  </div>

<!--Taupunkt-->
  <div id="tau" class="ui-body-d ui-content">
      <div id="chartContainerTau"></div>
  </div>
</div>

<!--Footer-->
<div data-role="footer">
    <h4>Powered by Hochschule Pforzheim</h4>
</div>

<script>
    var chart1 = new CanvasJS.Chart("chartContainer1",{
        title :{
            text: "Live Data"
        },
        data: [{
    	type: "line",
            dataPoints : [
    	    { label: "apple",  y: 10  },
    	    { label: "orange", y: 15  },
    	    { label: "banana", y: 25  },
    	    { label: "mango",  y: 30  },
    	    { label: "grape",  y: 28  }
    	]
        }]
    });
    var chart2 = new CanvasJS.Chart("chartContainer2",{
        title :{
    	text: "Live Data"
        },
        data: [{
    	type: "column",
    	dataPoints : [
    	    { label: "apple",  y: 10  },
    	    { label: "orange", y: 15  },
    	    { label: "banana", y: 25  },
    	    { label: "mango",  y: 30  },
    	    { label: "grape",  y: 28  }
    	]
        }]
    });
    var chart3 = new CanvasJS.Chart("chartContainer3", {
	animationEnabled: true,
	title:{
		text: "Daily High Temperature at Different Beaches"
	},
	axisX: {
		valueFormatString: "DD MMM,YY"
	},
	axisY: {
		title: "Temperature (in °C)",
		includeZero: false,
		suffix: " °C"
	},
	legend:{
		cursor: "pointer",
		fontSize: 16,
		itemclick: toggleDataSeries
	},
	toolTip:{
		shared: true
	},
	data: [{
		name: "Myrtle Beach",
		type: "spline",
		yValueFormatString: "#0.## °C",
		showInLegend: true,
		dataPoints: [
			{ x: new Date(2017,6,24), y: 31 },
			{ x: new Date(2017,6,25), y: 31 },
			{ x: new Date(2017,6,26), y: 29 },
			{ x: new Date(2017,6,27), y: 29 },
			{ x: new Date(2017,6,28), y: 31 },
			{ x: new Date(2017,6,29), y: 30 },
			{ x: new Date(2017,6,30), y: 29 }
		]
	},
	{
		name: "Martha Vineyard",
		type: "spline",
		yValueFormatString: "#0.## °C",
		showInLegend: true,
		dataPoints: [
			{ x: new Date(2017,6,24), y: 20 },
			{ x: new Date(2017,6,25), y: 20 },
			{ x: new Date(2017,6,26), y: 25 },
			{ x: new Date(2017,6,27), y: 25 },
			{ x: new Date(2017,6,28), y: 25 },
			{ x: new Date(2017,6,29), y: 25 },
			{ x: new Date(2017,6,30), y: 25 }
		]
	},
	{
		name: "Nantucket",
		type: "spline",
		yValueFormatString: "#0.## °C",
		showInLegend: true,
		dataPoints: [
			{ x: new Date(2017,6,24), y: 22 },
			{ x: new Date(2017,6,25), y: 19 },
			{ x: new Date(2017,6,26), y: 23 },
			{ x: new Date(2017,6,27), y: 24 },
			{ x: new Date(2017,6,28), y: 24 },
			{ x: new Date(2017,6,29), y: 23 },
			{ x: new Date(2017,6,30), y: 23 }
		]
	}]
    });
    
    function toggleDataSeries(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else{
		e.dataSeries.visible = true;
	}
	chart3.render();
}

}
    
    chart1.render();
    chart2.render();
    chart3.render();
</script>


