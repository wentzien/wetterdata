<?php
Core::$view->path["view1"]="views/view.historie.php";

date_default_timezone_set("Europe/Berlin");
$timestamp = time();
$datum = date("Y-m-d",$timestamp);
$pdo=Core::$pdo;
$dieStation=$_POST['ausgewStation'];
$taskerkenner=$_POST['taskerkenner'];

$datumVon=$_POST['datumVon'];
$datumBis=$_POST['datumBis'];
if($datumVon==""){
    $datumVon="1800-01-01";
}
if($datumBis==""){
    $datumBis="2200-01-01";
}
if($taskerkenner!="historie"){
    $datumVon="";
    $datumBis="";
}

Core::$view->datumVon=$datumVon;
Core::$view->datumBis=$datumBis;
//Wurden Stationswerte übergenen?, wenn nicht soll der Nuter darauf hingwiesen werden dass er eine Station auswähelen soll
If ($dieStation<>""){
//Länge des Arrays
$length=count($dieStation);
Core::$view->length=$length;

//Übergibt die StationsID's, Name und Temp Werte
$i=0;
foreach($dieStation as $stat){
    
    //Übergabe der StationsID
    $stationsNummer="stationID$i";
    Core::$view->$stationsNummer=$stat;
    
    //Übergabe der Temp Werte
    $sqltemp="select temp20, canvasts from Temperatur where station=$stat AND temp20>-273 AND ts>'$datumVon%' AND ts<'$datumBis%' AND ts order by ts asc";
    $tempheute=$pdo->query($sqltemp);
    $HeuteTempNummer="heuteTemp$i";
    Core::$view->$HeuteTempNummer=$tempheute;

    //Übergabe des Luftdrucks
    $sqldruck="select Luftdruck, canvasts from Temperatur where station=$stat AND Luftdruck>-999 AND ts>'$datumVon%' AND ts<'$datumBis%' AND ts order by ts asc";
    $druckheute=$pdo->query($sqldruck);
    $HeuteDruckNummer="heuteDruck$i";
    Core::$view->$HeuteDruckNummer=$druckheute;
    //Ende Übergabe des Luftdrucks

    //Übergabe Luftfeuchtigkeit
    $sqlfeuchte="select feuchte, canvasts from Temperatur where station=$stat AND feuchte>-999 AND ts>'$datumVon%' AND ts<'$datumBis%' AND ts order by ts asc";
    $feuchteheute=$pdo->query($sqlfeuchte);
    $HeuteFeuchteNummer="heuteFeuchte$i";
    Core::$view->$HeuteFeuchteNummer=$feuchteheute;
    //Ende Übergabe der Luftfeuchtigkeit

    //Übergabe des Taupunktes
    $sqltaupunkt="select taupunkt, canvasts from Temperatur where station=$stat AND taupunkt>-999 AND ts>'$datumVon%' AND ts<'$datumBis%' AND ts order by ts asc";
    $taupunktheute=$pdo->query($sqltaupunkt);
    $HeuteTaupunktNummer="heuteTaupunkt$i";
    Core::$view->$HeuteTaupunktNummer=$taupunktheute;
    //Ende Übergabe des Taupunkt

    //Übergabe  des Stationsnamen an TempDiagramm
    $sqlStationTemp="select stationsname from Stationen where id=$stat";
    $stationTemp=$pdo->query($sqlStationTemp);
    $stationNameTemp="stationTemp$i";
    Core::$view->$stationNameTemp=$stationTemp;
    //Ende Übergabe Stationsnamen

    //Übergabe des Stationsnamen an DruckDiagramm
    $sqlStationDruck="select stationsname from Stationen where id=$stat";
    $stationDruck=$pdo->query($sqlStationDruck);
    $stationNameDruck="stationDruck$i";
    Core::$view->$stationNameDruck=$stationDruck;
    //Ende Übergabe des Stationsnamen

    //Übergabe des Stationsnamen an FeuchteDiagramm
    $sqlStationFeuchte="select stationsname from Stationen where id=$stat";
    $stationFeuchte=$pdo->query($sqlStationFeuchte);
    $stationNameFeuchte="stationFeuchte$i";
    Core::$view->$stationNameFeuchte=$stationFeuchte;
    //Ende Übergabe des Stationsnamen

    //Übergabe des Stationsnamen an TauDiagramm
    $sqlStationTau="select stationsname from Stationen where id=$stat";
    $stationTau=$pdo->query($sqlStationTau);
    $stationNameTau="stationTau$i";
    Core::$view->$stationNameTau=$stationTau;
    //Ende Übergabe des Stationsnamen
    
    $i++;
}
}
else{
Core::addError("Bitte wähle eine Station aus");
}

//Listet alle Stationen auf
$SQLausgewStat="select * from Stationen";
$ausgewStat=$pdo->query($SQLausgewStat);
Core::$view->ausgewStat=$ausgewStat;
?>
    