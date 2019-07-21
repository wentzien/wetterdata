<!--CanvasJs folder-->
<script src="canvasjs/canvasjs.min.js"></script>

<!--Header-->
<div class="ui-corner-all custom-corners">
  <div class="ui-bar ui-bar-a">
    <h3>Der heutige Tag</h3>
  </div>
    <center>
        <div class="ui-body ui-body-a">
          <table>
              <tr>
                <th>Eine Kurzübersicht:</th>
                <!--Stationsnamen in die Tabelle schreiben-->
                
                <?php
                    $length=core::$view->length;
                    for($t=0; $t<$length; $t++){
                    $row="";
                    $stationNameTabelle="stationTabelle$t";
                    $stationTabelle=core::$view->$stationNameTabelle;
                    foreach($stationTabelle as $row){
                    $stationNT=$row['stationsname'];
                    echo("<th>$stationNT</th><th></th>");
                    }
                    }
                ?>
              </tr>
              <tr>
                <td>Aktuellster Temperaturwert</td>
                <?php
                for($t=0; $t<$length; $t++){
                    $row="";
                    $NameAktTemp="aktTemp$t";
                    $AktTemp=core::$view->$NameAktTemp;
                    foreach($AktTemp as $row){
                    $akttemp=$row['temp20'];
                    $akttempZeit=$row['ts'];
                    $akttempZeitrest = substr($akttempZeit, -8);
                    echo("<th>$akttemp °C</th><th>$akttempZeitrest</th>");
                    }
                    }
                ?>
               </tr>
               <tr>
                <td>Temperaturdurchschnitt</td>
                <?php
                for($t=0; $t<$length; $t++){
                    $row="";
                    $NameAvgTemp="avgTemp$t";
                    $AvgTemp=core::$view->$NameAvgTemp;
                    foreach($AvgTemp as $row){
                    $avgtemp=$row['AVG(temp20)'];
                    $avgtempRound=round( $avgtemp, 2, PHP_ROUND_HALF_UP);
                    echo("<th>$avgtempRound °C</th><th>-</th>");
                    }
                    }
                ?>
               </tr>
               <tr>
                <td>Max-Temperatur</td>
                <td>Wert</td>
               </tr>
               <tr>
                <td>Min-Temperatur</td>
                <td>Wert</td>
               </tr>
               <tr>
                <td>Durchschnitts-Luftdruck</td>
                <td>Wert</td>
               </tr>
               <tr>
                <td>Durchschnitts-Luftfeuchtigkeit</td>
                <td>Wert</td>
               </tr>
               <tr>
                <td>Durchschnitts-Taupunkttemperatur</td>
                <td>Wert</td>
               </tr>
            </table>
        </div>
    </center>
</div>

<!--Ortsauswahl-->

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
