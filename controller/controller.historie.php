<?php
Core::$view->path["view1"]="views/view.historie.php";

date_default_timezone_set("Europe/Berlin");
$timestamp = time();
$datum = date("Y-m-d",$timestamp);

$dieStation=$_POST['ausgewStation'];
$taskerkenner=$_POST['taskerkenner'];
$datumVon=$_POST['datumVon'];
$datumBis=$_POST['datumBis'];
if($taskerkenner!="historie"){
$datumVon="";
$datumBis="";
}


//Länge des Arrays
$length=count($dieStation);
Core::$view->length=$length;

//Übergibt die StationsID's, Name und Temp Werte
$i=0;
$pdo=Core::$pdo;
foreach($dieStation as $stat){
    
    //Übergabe der StationsID
    $stationsNummer="stationID$i";
    Core::$view->$stationsNummer=$stat;
    
    //Übergabe der Temp Werte
    $sqlheute="select * from Temperatur where station=$stat AND temp20>-273 AND ts order by ts asc";
    $heute=$pdo->query($sqlheute);
    $HeuteTempNummer="heuteTemp$i";
    Core::$view->$HeuteTempNummer=$heute;
    
    //Übergabe  des Stationsnamen
    $sqlStationName="select stationsname from Stationen where id=$stat";
    $stationName=$pdo->query($sqlStationName);
    $stationNameNummer="stationName$i";
    Core::$view->$stationNameNummer=$stationName;
    
    $i++;
}

//Listet alle Stationen auf
$SQLausgewStat="select * from Stationen";
$ausgewStat=$pdo->query($SQLausgewStat);
Core::$view->ausgewStat=$ausgewStat;
?>
    