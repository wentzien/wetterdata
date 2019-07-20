<div data-role="tabs" id="tabs">
  <div data-role="navbar">
    <ul>
      <li><a href="#temp" data-ajax="false">Temperatur</a></li>
      <li><a href="#druck" data-ajax="false">Luftdruck</a></li>
      <li><a href="#feuchte" data-ajax="false">Luftfeuchtigkeit</a></li>
      <li><a href="#tau" data-ajax="false">Taupunkt</a></li>
    </ul>
  </div>
  <div id="temp" class="ui-body-d ui-content">

<div data-role="header">
    <h1>Der heutige Tag</h1>
</div>
<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
//	title:{
//		text: "Das heutige Wetter"
//	},
	axisX: {
		valueFormatString: "HH:mm"
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
	data: [
            <?php 
            $length=core::$view->length;
            $length=$length-1;
            for($x=0; $x<=$length; $x++){
            echo('{
		name: "');
                        //Ausgabe des Stationsnamen
                        $row1="";
                        $stationNameNummer="stationName$x";
                        $stationName=core::$view->$stationNameNummer;
                        foreach($stationName as $row1){
                        echo($row1['stationsname']);
                        }   
                        //Ende Ausgabe des Stationsnamen
            echo('",
		type: "spline",
		yValueFormatString: "#0.## °C",
		showInLegend: true,
		dataPoints: ['); 
                        //Ausgabe der Temp Werte
                        $row2="";
                        $heuteTempNummer="heuteTemp$x";
                        $heuteTemp=core::$view->$heuteTempNummer;
                        $i="1";
                        foreach ($heuteTemp as $row2){
                        echo("{ x: new Date (".$row2['canvasts']."), y: ".$row2['temp20']." },\n");
                        }
                        //Ende der Ausgabe der Temp Werte
            echo(']
            },'); 
            }
            ?>
    ]
});
chart.render();

function toggleDataSeries(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else{
		e.dataSeries.visible = true;
	}
	chart.render();
}

}
</script>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="canvasjs/canvasjs.min.js"></script>
<form action="?task=heute" method="post" data-ajax='false'>
    <select name="ausgewStation[]" id="select-custom-24" data-native-menu="false" multiple="multiple" data-iconpos="left">
        <option>Ortsauswahl</option>
        <?php
        $ausgewStat=core::$view->ausgewStat;
        foreach ($ausgewStat as $as){
        echo("<option value=".$as['id']." >".$as['stationsname']."</option>\n");
        }
        ?>
        <input type="submit" name="anzeigen" value="Anzeigen">
    </select>
</form>
  </div>
  <div id="druck" class="ui-body-d ui-content">
    <h1>luftdruck</h1>
  </div>
    <div id="feuchte" class="ui-body-d ui-content">
    <h1>luftfeuchtigkeit</h1>
  </div>
    <div id="tau" class="ui-body-d ui-content">
    <h1>taupunkt</h1>
  </div>
</div>
    <div data-role="footer">
    <h4>Powered by Hochschule Pforzheim</h4>
</div>