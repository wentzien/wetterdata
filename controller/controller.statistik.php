<?php
Core::$view->path["view1"]="views/view.statistik.php";

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
    
    //----------------------------------------------------------------------
        //Tabellen-Daten

        //Stationsnamen
        $sqlStationTabelle="select stationsname from Stationen where id=$stat";
        $stationTabelle=$pdo->query($sqlStationTabelle);
        $stationNameTabelle="stationTabelle$i";
        Core::$view->$stationNameTabelle=$stationTabelle;
        //Ende Stationsname
        
        //aktuellste Temp Wert
        $sqlAktTemp="select temp20, ts from Temperatur where station=$stat AND ts>'$datumVon%' AND ts<'$datumBis%' order by ts desc limit 1";
        $AktTempheute=$pdo->query($sqlAktTemp);
        $HeuteAktTempNummer="aktTemp$i";
        Core::$view->$HeuteAktTempNummer=$AktTempheute;
        //Ende aktuellste Temp Wert
        
        //Durchschnittstemperatur
        $sqlAvgTemp="select AVG(temp20) from Temperatur where station=$stat AND ts>'$datumVon%' AND ts<'$datumBis%'";
        $AvgTempheute=$pdo->query($sqlAvgTemp);
        $HeuteAvgTempNummer="avgTemp$i";
        Core::$view->$HeuteAvgTempNummer=$AvgTempheute;
        //Ende Durchschnittstemperatur
        
        //Max-Temperatur
        $sqlMaxTemp="SELECT temp20, ts from Temperatur WHERE temp20=(SELECT MAX(temp20) FROM Temperatur WHERE station=$stat ts>'$datumVon%' AND ts<'$datumBis%') AND station=$stat AND ts>'$datumVon%' AND ts<'$datumBis%' limit 1";
        $MaxTempheute=$pdo->query($sqlMaxTemp);
        $HeuteMaxTempNummer="maxTemp$i";
        Core::$view->$HeuteMaxTempNummer=$MaxTempheute;
        //Ende Max-Temperatur
        
        //Min-Temperatur
        $sqlMinTemp="SELECT temp20, ts from Temperatur WHERE temp20=(SELECT MIN(temp20) FROM Temperatur WHERE station=$stat AND ts>'$datumVon%' AND ts<'$datumBis%') AND station=$stat AND ts>'$datumVon%' AND ts<'$datumBis%' limit 1";
        $MinTempheute=$pdo->query($sqlMinTemp);
        $HeuteMinTempNummer="minTemp$i";
        Core::$view->$HeuteMinTempNummer=$MinTempheute;
        //Ende Max-Temperatur
        
        //Durchschnitts Luftdruck
        $sqlAvgDruck="select AVG(Luftdruck) from Temperatur where station=$stat AND ts>'$datumVon%' AND ts<'$datumBis%'";
        $AvgDruckheute=$pdo->query($sqlAvgDruck);
        $HeuteAvgDruckNummer="avgDruck$i";
        Core::$view->$HeuteAvgDruckNummer=$AvgDruckheute;
        //Ende Durchschnitts Luftdruck
        
        //Durchschnitts Luftfeuchtigkeit
        $sqlAvgFeuchte="select AVG(feuchte) from Temperatur where station=$stat AND ts>'$datumVon%' AND ts<'$datumBis%'";
        $AvgFeuchteheute=$pdo->query($sqlAvgFeuchte);
        $HeuteAvgFeuchteNummer="avgFeuchte$i";
        Core::$view->$HeuteAvgFeuchteNummer=$AvgFeuchteheute;
        //Ende Durchschnitts Luftfeuchtigkeit
        
        //Durchschnitts Taupunkt
        $sqlAvgTau="select AVG(taupunkt) from Temperatur where station=$stat AND ts>'$datumVon%' AND ts<'$datumBis%'";
        $AvgTauheute=$pdo->query($sqlAvgTau);
        $HeuteAvgTauNummer="avgTau$i";
        Core::$view->$HeuteAvgTauNummer=$AvgTauheute;
        //Ende Durchschnitts Taupunkt
    
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
    