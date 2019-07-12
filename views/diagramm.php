<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$database="wetterdata";
$host="141.47.2.40";
$user="wetterdata";
$password="wvgnigt";
$to=0;
$days=4;
$stationsname=["3362"=>"Ispringen","3925"=>"Mühlacker"];
if(filter_input(INPUT_GET,"to")){
    $to=filter_input(INPUT_GET,"to");
}
if(filter_input(INPUT_GET,"days")){
    $days=filter_input(INPUT_GET,"days");
}
$end=time()-($to*24*60*60);
$start=$end-($days*24*60*60);

$stationstring="3362 3925";
$sensor="temp20";

if(filter_input(INPUT_GET,"stations")){
    $stationstring=filter_input(INPUT_GET,"stations");
}
if(filter_input(INPUT_GET,"sensor")){
    $sensor=filter_input(INPUT_GET,"sensor");
}





$stations= explode(" ",$stationstring);

        
$pdo = new PDO("mysql:host=".$host.";dbname=".$database.";charset=utf8",$user,$password);
$pdo->setAttribute( PDO::ATTR_EMULATE_PREPARES,true);
$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING ); // For Debugging
$i=0;
foreach($stations as $station){
    $SQL="Select * From Temperatur WHERE timestamp>= $start AND timestamp<=$end AND station=$station AND $sensor<>-999" ;
    $stmt=$pdo->prepare($SQL);
    $stmt->execute();
    $daten=$stmt->fetchAll(PDO::FETCH_CLASS);
    $series[$i] = json_encode($daten,JSON_NUMERIC_CHECK );
    $i++;
    
 }
$a=1;

/*
$SQL="Select * From Temperatur WHERE ts> '2019-02-22 23:50:00' AND station=3362";
$stmt=$pdo->prepare($SQL);
$stmt->execute();
$daten=$stmt->fetchAll(PDO::FETCH_CLASS);
$json = json_encode($daten,JSON_NUMERIC_CHECK );

$SQL="Select * From Temperatur WHERE ts> '2019-02-22 23:50:00' AND station=3925";
$stmt=$pdo->prepare($SQL);
$stmt->execute();
$daten=$stmt->fetchAll(PDO::FETCH_CLASS);
$json2 = json_encode($daten,JSON_NUMERIC_CHECK );

*/

?>
<!DOCTYPE HTML>
<html>
<head>
<script src="canvasjs.min.js"></script>
<script>
    
window.onload = function() {
<?php
$counter=0;
foreach($series as $json){
    echo "var dataPoints$counter = [];";
    $counter++;
}
?>




    CanvasJS.addCultureInfo("de",
                    {
                        decimalSeparator: ",",
                        digitGroupSeparator: ".",
                        days: ["Sonntag", "Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag", "Samstag"],
                   });





var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
        culture:  "de",
       zoomEnabled: true,
        legend: {
       horizontalAlign: "left", // "center" , "right"
       verticalAlign: "center",  // "top" , "bottom"
       fontSize: 15
         },
	theme: "light2",
	title: {
		text: "<?=$sensor?>"
	},
        axisX: {
        valueFormatString: "DDDD HH:mm"
        },
	axisY: {
		title: "°C",
		titleFontSize: 24
	},
	data: [
           <?php $counter=0;
                foreach($series as $json){
   

            ?>
            
            {
		type: "line",
                  showInLegend: true,
		xValueFormatString: "HH:mm",
                yValueFormatString: "##.#°C",
		dataPoints: dataPoints<?=$counter?>,
                legendText: "<?=$stationsname[$stations[$counter]];?>"
	}<?php 
        if($counter!=count($series)){ echo",";}
        $counter++;
                } 
                ?>
        
    ]
    
});
<?php
$counter=0;
foreach($series as $json){
   

?>
function addData<?=$counter?>(data) {
	for (var i = 0; i < data.length; i++) {
		dataPoints<?=$counter?>.push({
			x: new Date(data[i].timestamp*1000),
			y: data[i].<?=$sensor?>
                       
		});
	}
	

}

addData<?=$counter?>(<?php echo($json);?>);
<?php
    $counter++;
}
?>


chart.render();






}
</script>
</head>
<body>
 <?php
 echo "<h2>".date("d.m.Y",$start)." - ".date("d.m.Y",$end)."</h2>";
 ?>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>

</body>
</html>