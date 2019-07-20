<!--CanvasJs folder-->
<script src="canvasjs/canvasjs.min.js"></script>

<!--Header-->
<div data-role="header">
        <h1>Historische Wetterdaten</h1>
</div>
<br>

<!--Ortsauswahl-->
<!--Datumsfilterung-->

<form action="?task=historie" method="post" data-ajax='false'>
    <select name="ausgewStation[]" id="select-custom-24" data-native-menu="false" multiple="multiple" data-iconpos="left">
        <option>Ortsauswahl</option>
        <?php
        $ausgewStat=core::$view->ausgewStat;
        foreach ($ausgewStat as $as){
        echo("<option value=".$as['id']." >".$as['stationsname']."</option>\n");
        }
        ?>
    </select>
    <input type="hidden" name="taskerkenner"  id="taskerkenner" value="historie"/>
    <label for="datumVon">Zeitraum von:</label>
    <input type="date" name="datumVon" id="datumVon" value="<?=core::$view->datumVon ?>"/>
    <label for="datumVon">Zeitraum bis:</label>
    <input type="date" name="datumBis" id="datumBis" value="<?=core::$view->datumBis ?>"/>
    <input type="submit" name="anzeigen" value="Anzeigen">
</form>
<br>

<!--Temperaturanzeige-->

<div data-role="header" data-theme="b">
    <h1>Temperatur</h1>
</div>
<div id="chartContainerTemp" style="height: 370px; width: 100%;"></div><br>

<!--Luftdruckanzeige-->

<div data-role="header" data-theme="b">
    <h1>Luftdruck</h1>
</div>
<div id="chartContainerDruck" style="height: 370px; width: 100%;"></div><br>

<!--Luftfeuchtigkeit-->

<div data-role="header" data-theme="b">
    <h1>Relative Luftfeuchtigkeit</h1>
</div>
<div id="chartContainerFeuchte" style="height: 370px; width: 100%;"></div><br>

<!--Taupunkttemperatur-->

<div data-role="header" data-theme="b">
    <h1>Taupunkttemperatur</h1>
</div>
<div id="chartContainerTau" style="height: 370px; width: 100%;"></div><br>

<!--Footer-->

<div data-role="footer">
    <h4>Powered by Hochschule Pforzheim</h4>
</div>

<script>
window.onload = function () {

//Temperaturchart
var chart1 = new CanvasJS.Chart("chartContainerTemp", {
	animationEnabled: true,
        zoomEnabled: true,
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
		itemclick: toggleDataSeriesTemp
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
                        $stationNameTemp="stationTemp$x";
                        $stationTemp=core::$view->$stationNameTemp;
                        foreach($stationTemp as $row1){
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
chart1.render();

function toggleDataSeriesTemp(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else{
		e.dataSeries.visible = true;
	}
	chart1.render();
}

//Luftdruck
var chart2 = new CanvasJS.Chart("chartContainerDruck", {
	animationEnabled: true,
        zoomEnabled: true,
//	title:{
//		text: "Das heutige Wetter"
//	},
	axisX: {
		valueFormatString: "HH:mm"
	},
	axisY: {
		title: "Luftdruck (in hPa)",
		includeZero: false,
		suffix: " hPa"
	},
	legend:{
		cursor: "pointer",
		fontSize: 16,
		itemclick: toggleDataSeriesDruck
	},
	toolTip:{
		shared: true
	},
	data: [
            <?php 
            for($x=0; $x<=$length; $x++){
            echo('{
		name: "');
                        //Ausgabe des Stationsnamen
                        $row1="";
                        $stationNameDruck="stationDruck$x";
                        $stationDruck=core::$view->$stationNameDruck;
                        foreach($stationDruck as $row1){
                        echo($row1['stationsname']);
                        }   
                        //Ende Ausgabe des Stationsnamen
            echo('",
		type: "spline",
		yValueFormatString: "#0.## hPa",
		showInLegend: true,
		dataPoints: ['); 
                        //Ausgabe der Temp Werte
                        $row2="";
                        $heuteDruckNummer="heuteDruck$x";
                        $heuteDruck=core::$view->$heuteDruckNummer;
                        foreach ($heuteDruck as $row2){
                        echo("{ x: new Date (".$row2['canvasts']."), y: ".$row2['Luftdruck']." },\n");
                        }
                        //Ende der Ausgabe der Temp Werte
            echo(']
            },'); 
            }
            ?>
    ]
});
chart2.render();

function toggleDataSeriesDruck(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else{
		e.dataSeries.visible = true;
	}
	chart2.render();
}

//Luftfeuchtigkeit
var chart3 = new CanvasJS.Chart("chartContainerFeuchte", {
	animationEnabled: true,
        zoomEnabled: true,
//	title:{
//		text: "Das heutige Wetter"
//	},
	axisX: {
		valueFormatString: "HH:mm"
	},
	axisY: {
		title: "relative Feuchte (in %)",
		includeZero: false,
		suffix: " %"
	},
	legend:{
		cursor: "pointer",
		fontSize: 16,
		itemclick: toggleDataSeriesFeuchte
	},
	toolTip:{
		shared: true
	},
	data: [
            <?php 
            for($x=0; $x<=$length; $x++){
            echo('{
		name: "');
                        //Ausgabe des Stationsnamen
                        $row1="";
                        $stationNameFeuchte="stationFeuchte$x";
                        $stationFeuchte=core::$view->$stationNameFeuchte;
                        foreach($stationFeuchte as $row1){
                        echo($row1['stationsname']);
                        }   
                        //Ende Ausgabe des Stationsnamen
            echo('",
		type: "column",
		yValueFormatString: "#0.## %",
		showInLegend: true,
		dataPoints: ['); 
                        //Ausgabe der Temp Werte
                        $row2="";
                        $heuteFeuchteNummer="heuteFeuchte$x";
                        $heuteFeuchte=core::$view->$heuteFeuchteNummer;
                        foreach ($heuteFeuchte as $row2){
                        echo("{ x: new Date (".$row2['canvasts']."), y: ".$row2['feuchte']." },\n");
                        }
                        //Ende der Ausgabe der Temp Werte
            echo(']
            },'); 
            }
            ?>
    ]
});
chart3.render();

function toggleDataSeriesFeuchte(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else{
		e.dataSeries.visible = true;
	}
	chart3.render();
}

//Taupunkttemperatur
var chart4 = new CanvasJS.Chart("chartContainerTau", {
	animationEnabled: true,
        zoomEnabled: true,
//	title:{
//		text: "Das heutige Wetter"
//	},
	axisX: {
		valueFormatString: "HH:mm"
	},
	axisY: {
		title: "Taupunkttemperatur (in °C)",
		includeZero: false,
		suffix: " °C"
	},
	legend:{
		cursor: "pointer",
		fontSize: 16,
		itemclick: toggleDataSeriesTau
	},
	toolTip:{
		shared: true
	},
	data: [
            <?php 
            for($x=0; $x<=$length; $x++){
            echo('{
		name: "');
                        //Ausgabe des Stationsnamen
                        $row1="";
                        $stationNameTau="stationTau$x";
                        $stationTau=core::$view->$stationNameTau;
                        foreach($stationTau as $row1){
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
                        $heuteTauNummer="heuteTaupunkt$x";
                        $heuteTau=core::$view->$heuteTauNummer;
                        foreach ($heuteTau as $row2){
                        echo("{ x: new Date (".$row2['canvasts']."), y: ".$row2['taupunkt']." },\n");
                        }
                        //Ende der Ausgabe der Temp Werte
            echo(']
            },'); 
            }
            ?>
    ]
});
chart4.render();

function toggleDataSeriesTau(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else{
		e.dataSeries.visible = true;
	}
	chart4.render();
}
}
</script>
