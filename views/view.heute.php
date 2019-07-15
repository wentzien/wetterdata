<!DOCTYPE HTML>
<html>
<head>  
<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	title:{
		text: "Das heutige Wetter"
	},
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
            {
		name: "<?php
                $NameAusgStation=core::$view->stationName0;
                foreach($NameAusgStation as $row1){
                echo($row1['stationsname']);
                $d=2;
                }
                ?>",
		type: "spline",
		yValueFormatString: "#0.## °C",
		showInLegend: true,
		dataPoints: [
<?php
$heute=core::$view->heuteTemp0;
$i="1";
foreach ($heute as $row2){
    echo("{ x: new Date (".$row2['canvasts']."), y: ".$row2['temp20']." },\n");
}

?>
		]
	},
//	{
//		name: "Martha Vineyard",
//		type: "spline",
//		yValueFormatString: "#0.## °C",
//		showInLegend: true,
//		dataPoints: [
//			{ x: new Date(2017,6,24), y: 20 },
//			{ x: new Date(2017,6,25), y: 20 },
//			{ x: new Date(2017,6,26), y: 25 },
//			{ x: new Date(2017,6,27), y: 25 },
//			{ x: new Date(2017,6,28), y: 25 },
//			{ x: new Date(2017,6,29), y: 25 },
//			{ x: new Date(2017,6,30), y: 25 }
//		]
//	},
//	{
//		name: "Nantucket",
//		type: "spline",
//		yValueFormatString: "#0.## °C",
//		showInLegend: true,
//		dataPoints: [
//			{ x: new Date(2017,6,24), y: 22 },
//			{ x: new Date(2017,6,25), y: 19 },
//			{ x: new Date(2017,6,26), y: 23 },
//			{ x: new Date(2017,6,27), y: 24 },
//			{ x: new Date(2017,6,28), y: 24 },
//			{ x: new Date(2017,6,29), y: 23 },
//			{ x: new Date(2017,6,30), y: 23 }
//		]
//	}
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
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="canvasjs/canvasjs.min.js"></script>
</body>
</html>
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

<?php echo($dieStation0=core::$view->stationID0)?>