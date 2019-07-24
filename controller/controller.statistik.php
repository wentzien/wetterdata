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
    
    //----------------------------------------------------------------------
        //Tabellen-Daten gefiltert nach ausgewählten Zeitraum

        //Stationsnamen
        $sqlStationTabelle="select stationsname from Stationen where id=$stat";
        $stationTabelle=$pdo->query($sqlStationTabelle);
        $stationNameTabelle="stationTabelle$i";
        Core::$view->$stationNameTabelle=$stationTabelle;
        //Ende Stationsname
        
        //aktuellste Temp Wert
        $sqlAktTemp="select temp20, ts from Temperatur where station=$stat AND ts>='$datumVon%' AND ts<='$datumBis%' and temp20>-999 order by ts desc limit 1";
        $AktTempheute=$pdo->query($sqlAktTemp);
        $HeuteAktTempNummer="aktTemp$i";
        Core::$view->$HeuteAktTempNummer=$AktTempheute;
        //Ende aktuellste Temp Wert
        
        //Durchschnittstemperatur
        $sqlAvgTemp="select AVG(temp20) from Temperatur where station=$stat AND ts>='$datumVon%' AND ts<='$datumBis%' and temp20>-999";
        $AvgTempheute=$pdo->query($sqlAvgTemp);
        $HeuteAvgTempNummer="avgTemp$i";
        Core::$view->$HeuteAvgTempNummer=$AvgTempheute;
        //Ende Durchschnittstemperatur
        
        //Max-Temperatur
        $sqlMaxTemp="SELECT temp20, ts from Temperatur WHERE temp20=(SELECT MAX(temp20) FROM Temperatur WHERE station=$stat AND ts>='$datumVon%' AND ts<='$datumBis%' and temp20>-999) AND station=$stat AND ts>='$datumVon%' AND ts<='$datumBis%' and temp20>-999 limit 1";
        $MaxTempheute=$pdo->query($sqlMaxTemp);
        $HeuteMaxTempNummer="maxTemp$i";
        Core::$view->$HeuteMaxTempNummer=$MaxTempheute;
        //Ende Max-Temperatur
        
        //Min-Temperatur
        $sqlMinTemp="SELECT temp20, ts from Temperatur WHERE temp20=(SELECT MIN(temp20) FROM Temperatur WHERE station=$stat AND ts>='$datumVon%' AND ts<='$datumBis%' and temp20>-999) AND station=$stat AND ts>='$datumVon%' AND ts<='$datumBis%' and temp20>-999 limit 1";
        $MinTempheute=$pdo->query($sqlMinTemp);
        $HeuteMinTempNummer="minTemp$i";
        Core::$view->$HeuteMinTempNummer=$MinTempheute;
        //Ende Max-Temperatur
        
        //Durchschnitts Luftdruck
        $sqlAvgDruck="select AVG(Luftdruck) from Temperatur where station=$stat AND ts>='$datumVon%' AND ts<='$datumBis%' and temp20>-999";
        $AvgDruckheute=$pdo->query($sqlAvgDruck);
        $HeuteAvgDruckNummer="avgDruck$i";
        Core::$view->$HeuteAvgDruckNummer=$AvgDruckheute;
        //Ende Durchschnitts Luftdruck
        
        //Durchschnitts Luftfeuchtigkeit
        $sqlAvgFeuchte="select AVG(feuchte) from Temperatur where station=$stat AND ts>='$datumVon%' AND ts<='$datumBis%' and temp20>-999";
        $AvgFeuchteheute=$pdo->query($sqlAvgFeuchte);
        $HeuteAvgFeuchteNummer="avgFeuchte$i";
        Core::$view->$HeuteAvgFeuchteNummer=$AvgFeuchteheute;
        //Ende Durchschnitts Luftfeuchtigkeit
        
        //Durchschnitts Taupunkt
        $sqlAvgTau="select AVG(taupunkt) from Temperatur where station=$stat AND ts>='$datumVon%' AND ts<='$datumBis%' and temp20>-999";
        $AvgTauheute=$pdo->query($sqlAvgTau);
        $HeuteAvgTauNummer="avgTau$i";
        Core::$view->$HeuteAvgTauNummer=$AvgTauheute;
        //Ende Durchschnitts Taupunkt
        
        //Max-Luftdruck
        $sqlMaxDruck="SELECT Luftdruck, ts from Temperatur WHERE Luftdruck=(SELECT MAX(Luftdruck) FROM Temperatur WHERE station=$stat AND ts>='$datumVon%' AND ts<='$datumBis%' and Luftdruck>-999) AND station=$stat AND ts>='$datumVon%' AND ts<='$datumBis%' and Luftdruck>-999 limit 1";
        $MaxDruckheute=$pdo->query($sqlMaxDruck);
        $HeuteMaxDruckNummer="maxDruck$i";
        Core::$view->$HeuteMaxDruckNummer=$MaxDruckheute;
        //Ende Max-Lufdruck
        
        //Min-Luftdruck
        $sqlMinDruck="SELECT Luftdruck, ts from Temperatur WHERE Luftdruck=(SELECT MIN(Luftdruck) FROM Temperatur WHERE station=$stat AND ts>='$datumVon%' AND ts<='$datumBis%' and Luftdruck>-999) AND station=$stat AND ts>='$datumVon%' AND ts<='$datumBis%' and Luftdruck>-999 limit 1";
        $MinDruckheute=$pdo->query($sqlMinDruck);
        $HeuteMinDruckNummer="minDruck$i";
        Core::$view->$HeuteMinDruckNummer=$MinDruckheute;
        //Ende Min-Lufdruck
        
        //Max-Luftfeuchtigkeit
        $sqlMaxFeuchte="SELECT feuchte, ts from Temperatur WHERE feuchte=(SELECT MAX(feuchte) FROM Temperatur WHERE station=$stat AND ts>='$datumVon%' AND ts<='$datumBis%' and feuchte>-999) AND station=$stat AND ts>='$datumVon%' AND ts<='$datumBis%' and feuchte>-999 limit 1";
        $MaxFeuchteheute=$pdo->query($sqlMaxFeuchte);
        $HeuteMaxFeuchteNummer="maxFeuchte$i";
        Core::$view->$HeuteMaxFeuchteNummer=$MaxFeuchteheute;
        //Ende Max-Luftfeuchtigkeit
        
        //Min-Luftfeuchtigkeit
        $sqlMinFeuchte="SELECT feuchte, ts from Temperatur WHERE feuchte=(SELECT MIN(feuchte) FROM Temperatur WHERE station=$stat AND ts>='$datumVon%' AND ts<='$datumBis%' and feuchte>-999) AND station=$stat AND ts>='$datumVon%' AND ts<='$datumBis%' and feuchte>-999 limit 1";
        $MinFeuchteheute=$pdo->query($sqlMinFeuchte);
        $HeuteMinFeuchteNummer="minFeuchte$i";
        Core::$view->$HeuteMinFeuchteNummer=$MinFeuchteheute;
        //Ende Min-Luftfeuchtigkeit
        
        //Max-Taupunkt
        $sqlMaxTau="SELECT taupunkt, ts from Temperatur WHERE taupunkt=(SELECT MAX(taupunkt) FROM Temperatur WHERE station=$stat AND ts>='$datumVon%' AND ts<='$datumBis%' and taupunkt>-999) AND station=$stat AND ts>='$datumVon%' AND ts<='$datumBis%' and taupunkt>-999 limit 1";
        $MaxTauheute=$pdo->query($sqlMaxTau);
        $HeuteMaxTauNummer="maxTau$i";
        Core::$view->$HeuteMaxTauNummer=$MaxTauheute;
        //Ende Max-Taupunkt
        
        //Min-Taupunkt
        $sqlMinTau="SELECT taupunkt, ts from Temperatur WHERE taupunkt=(SELECT MIN(taupunkt) FROM Temperatur WHERE station=$stat AND ts>='$datumVon%' AND ts<='$datumBis%' and taupunkt>-999) AND station=$stat AND ts>='$datumVon%' AND ts<='$datumBis%' and taupunkt>-999 limit 1";
        $MinTauheute=$pdo->query($sqlMinTau);
        $HeuteMinTauNummer="minTau$i";
        Core::$view->$HeuteMinTauNummer=$MinTauheute;
        //Ende Min-Taupunkt
        
        //Durchschnitts Niederschlag
        $sqlAvgRegen="select AVG(RS) from niederschlagdaily where station=$stat AND ts>='$datumVon%' AND ts<='$datumBis%' and RS>-999";
        $AvgRegenheute=$pdo->query($sqlAvgRegen);
        $HeuteAvgRegenNummer="avgRegen$i";
        Core::$view->$HeuteAvgRegenNummer=$AvgRegenheute;
        //Ende Durchschnitts Niederschlag
        
        //Max-Niederschlag
        $sqlMaxRegen="SELECT RS, ts from niederschlagdaily WHERE RS=(SELECT MAX(RS) FROM niederschlagdaily WHERE station=$stat AND ts>='$datumVon%' AND ts<='$datumBis%' and RS>-999) AND station=$stat AND ts>='$datumVon%' AND ts<='$datumBis%' and RS>-999 limit 1";
        $MaxRegenheute=$pdo->query($sqlMaxRegen);
        $HeuteMaxRegenNummer="maxRegen$i";
        Core::$view->$HeuteMaxRegenNummer=$MaxRegenheute;
        //Ende Max-Niederschlag
        
        //Min-Niederschlag
        $sqlMinRegen="SELECT RS, ts from niederschlagdaily WHERE RS=(SELECT MIN(RS) FROM niederschlagdaily WHERE station=$stat AND ts>='$datumVon%' AND ts<='$datumBis%' and RS>-999) AND station=$stat AND ts>='$datumVon%' AND ts<='$datumBis%' and RS>-999 limit 1";
        $MinRegenheute=$pdo->query($sqlMinRegen);
        $HeuteMinRegenNummer="minRegen$i";
        Core::$view->$HeuteMinRegenNummer=$MinRegenheute;
        //Ende Min-Niederschlag
        
        //----------------------------------------------------------------------
        //Tabellen-Daten ungefiltert nach Temperatur
        
        //Stationsnamen
        $sqlStationNiederschlag="select stationsname from Stationen where id=$stat";
        $stationNiederschlag=$pdo->query($sqlStationNiederschlag);
        $stationNameNiederschlag="stationNiederschlag$i";
        Core::$view->$stationNameNiederschlag=$stationNiederschlag;
        //Ende Stationsname
        
        //Heißester Frühling
        $sqlHotF="SELECT t.ts, t.average FROM (SELECT ts, avg(temp20) AS average FROM Temperatur WHERE station=$stat AND ts LIKE '%-03-%' OR ts LIKE '%-04-%' OR ts LIKE '%-05-%' GROUP BY YEAR(ts)) t GROUP BY t.average desc LIMIT 1";
        $HotFheute=$pdo->query($sqlHotF);
        $HeuteHotFNummer="hotF$i";
        Core::$view->$HeuteHotFNummer=$HotFheute;
        //Ende Heißester Frühling
        
        //Kältester Frühling
        $sqlColdF="SELECT t.ts, t.average FROM (SELECT ts, avg(temp20) AS average FROM Temperatur WHERE station=$stat AND ts LIKE '%-03-%' OR ts LIKE '%-04-%' OR ts LIKE '%-05-%' GROUP BY YEAR(ts)) t GROUP BY t.average asc LIMIT 1";
        $ColdFheute=$pdo->query($sqlColdF);
        $HeuteColdFNummer="coldF$i";
        Core::$view->$HeuteColdFNummer=$ColdFheute;
        //Ende Kältester Frühling        
        
        //----------------------------------------------------------------------
        //Tabellen-Daten ungefiltert nach Niederschlag
        
        
    
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
    