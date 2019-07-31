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
        $sqlStationTemperatur="select stationsname from Stationen where id=$stat";
        $stationTemperatur=$pdo->query($sqlStationTemperatur);
        $stationNameTemperatur="stationTemperatur$i";
        Core::$view->$stationNameTemperatur=$stationTemperatur;
        //Ende Stationsname
        
        //Heißester Frühling
        $sqlHotF="SELECT t.ts, t.average FROM (SELECT ts, avg(temp20) AS average FROM Temperatur WHERE station=$stat AND temp20>-999 AND (ts LIKE '%-03-%' OR ts LIKE '%-04-%' OR ts LIKE '%-05-%') GROUP BY YEAR(ts)) t GROUP BY t.average desc LIMIT 1";
        $HotFheute=$pdo->query($sqlHotF);
        $HeuteHotFNummer="hotF$i";
        Core::$view->$HeuteHotFNummer=$HotFheute;
        //Ende Heißester Frühling
        
        //Kältester Frühling
        $sqlColdF="SELECT t.ts, t.average FROM (SELECT ts, avg(temp20) AS average FROM Temperatur WHERE station=$stat AND temp20>-999 AND (ts LIKE '%-03-%' OR ts LIKE '%-04-%' OR ts LIKE '%-05-%') GROUP BY YEAR(ts)) t GROUP BY t.average asc LIMIT 1";
        $ColdFheute=$pdo->query($sqlColdF);
        $HeuteColdFNummer="coldF$i";
        Core::$view->$HeuteColdFNummer=$ColdFheute;
        //Ende Kältester Frühling        
        
        //Höchste Messung Frühling
        $sqlHighF="SELECT t.ts, t.average FROM (SELECT ts, max(temp20) AS average FROM Temperatur WHERE station=$stat AND temp20>-999 AND (ts LIKE '%-03-%' OR ts LIKE '%-04-%' OR ts LIKE '%-05-%') GROUP BY YEAR(ts)) t GROUP BY t.average desc LIMIT 1";
        $HighFheute=$pdo->query($sqlHighF);
        $HeuteHighFNummer="highF$i";
        Core::$view->$HeuteHighFNummer=$HighFheute;
        //Ende Höchste Messung Frühling

        //Niedrigste Messung Frühling
        $sqlLowF="SELECT t.ts, t.average FROM (SELECT ts, min(temp20) AS average FROM Temperatur WHERE station=$stat AND temp20>-999 AND (ts LIKE '%-03-%' OR ts LIKE '%-04-%' OR ts LIKE '%-05-%') GROUP BY YEAR(ts)) t GROUP BY t.average asc LIMIT 1";
        $LowFheute=$pdo->query($sqlLowF);
        $HeuteLowFNummer="lowF$i";
        Core::$view->$HeuteLowFNummer=$LowFheute;
        //Ende Niedrigste Messung Frühling 
        
        //Heißester Sommer
        $sqlHotS="SELECT t.ts, t.average FROM (SELECT ts, avg(temp20) AS average FROM Temperatur WHERE station=$stat AND temp20>-999 AND (ts LIKE '%-06-%' OR ts LIKE '%-07-%' OR ts LIKE '%-08-%') GROUP BY YEAR(ts)) t GROUP BY t.average desc LIMIT 1";
        $HotSheute=$pdo->query($sqlHotS);
        $HeuteHotSNummer="hotS$i";
        Core::$view->$HeuteHotSNummer=$HotSheute;
        //Ende Heißester Sommer
        
        //Kältester Sommer
        $sqlColdS="SELECT t.ts, t.average FROM (SELECT ts, avg(temp20) AS average FROM Temperatur WHERE station=$stat AND temp20>-999 AND (ts LIKE '%-06-%' OR ts LIKE '%-07-%' OR ts LIKE '%-08-%') GROUP BY YEAR(ts)) t GROUP BY t.average asc LIMIT 1";
        $ColdSheute=$pdo->query($sqlColdS);
        $HeuteColdSNummer="coldS$i";
        Core::$view->$HeuteColdSNummer=$ColdSheute;
        //Ende Kältester Sommer        
        
        //Höchste Messung Sommer
        $sqlHighS="SELECT t.ts, t.average FROM (SELECT ts, max(temp20) AS average FROM Temperatur WHERE station=$stat AND temp20>-999 AND (ts LIKE '%-06-%' OR ts LIKE '%-07-%' OR ts LIKE '%-08-%') GROUP BY YEAR(ts)) t GROUP BY t.average desc LIMIT 1";
        $HighSheute=$pdo->query($sqlHighS);
        $HeuteHighSNummer="highS$i";
        Core::$view->$HeuteHighSNummer=$HighSheute;
        //Ende Höchste Messung Sommer

        //Niedrigste Messung Sommer
        $sqlLowS="SELECT t.ts, t.average FROM (SELECT ts, min(temp20) AS average FROM Temperatur WHERE station=$stat AND temp20>-999 AND (ts LIKE '%-06-%' OR ts LIKE '%-07-%' OR ts LIKE '%-08-%') GROUP BY YEAR(ts)) t GROUP BY t.average asc LIMIT 1";
        $LowSheute=$pdo->query($sqlLowS);
        $HeuteLowSNummer="lowS$i";
        Core::$view->$HeuteLowSNummer=$LowSheute;
        //Ende Niedrigste Messung Sommer
        
        //Heißester Herbst
        $sqlHotH="SELECT t.ts, t.average FROM (SELECT ts, avg(temp20) AS average FROM Temperatur WHERE station=$stat AND temp20>-999 AND (ts LIKE '%-09-%' OR ts LIKE '%-10-%' OR ts LIKE '%-11-%') GROUP BY YEAR(ts)) t GROUP BY t.average desc LIMIT 1";
        $HotHheute=$pdo->query($sqlHotH);
        $HeuteHotHNummer="hotH$i";
        Core::$view->$HeuteHotHNummer=$HotHheute;
        //Ende Heißester Herbst
        
        //Kältester Herbst
        $sqlColdH="SELECT t.ts, t.average FROM (SELECT ts, avg(temp20) AS average FROM Temperatur WHERE station=$stat AND temp20>-999 AND (ts LIKE '%-09-%' OR ts LIKE '%-10-%' OR ts LIKE '%-11-%') GROUP BY YEAR(ts)) t GROUP BY t.average asc LIMIT 1";
        $ColdHheute=$pdo->query($sqlColdH);
        $HeuteColdHNummer="coldH$i";
        Core::$view->$HeuteColdHNummer=$ColdHheute;
        //Ende Kältester Herbst     
        
        //Höchste Messung Herbst
        $sqlHighH="SELECT t.ts, t.average FROM (SELECT ts, max(temp20) AS average FROM Temperatur WHERE station=$stat AND temp20>-999 AND (ts LIKE '%-09-%' OR ts LIKE '%-10-%' OR ts LIKE '%-11-%') GROUP BY YEAR(ts)) t GROUP BY t.average desc LIMIT 1";
        $HighHheute=$pdo->query($sqlHighH);
        $HeuteHighHNummer="highH$i";
        Core::$view->$HeuteHighHNummer=$HighHheute;
        //Ende Höchste Messung Herbst

        //Niedrigste Messung Herbst
        $sqlLowH="SELECT t.ts, t.average FROM (SELECT ts, min(temp20) AS average FROM Temperatur WHERE station=$stat AND temp20>-999 AND (ts LIKE '%-09-%' OR ts LIKE '%-10-%' OR ts LIKE '%-11-%') GROUP BY YEAR(ts)) t GROUP BY t.average asc LIMIT 1";
        $LowHheute=$pdo->query($sqlLowH);
        $HeuteLowHNummer="lowH$i";
        Core::$view->$HeuteLowHNummer=$LowHheute;
        //Ende Niedrigste Messung Herbst
        
        //Heißester Winter
        $sqlHotW="SELECT t.ts, t.average FROM (SELECT ts, avg(temp20) AS average FROM Temperatur WHERE station=$stat AND temp20>-999 AND (ts LIKE '%-12-%' OR ts LIKE '%-01-%' OR ts LIKE '%-02-%') GROUP BY YEAR(ts)) t GROUP BY t.average desc LIMIT 1";
        $HotWheute=$pdo->query($sqlHotW);
        $HeuteHotWNummer="hotW$i";
        Core::$view->$HeuteHotWNummer=$HotWheute;
        //Ende Heißester Winter
        
        //Kältester Winter
        $sqlColdW="SELECT t.ts, t.average FROM (SELECT ts, avg(temp20) AS average FROM Temperatur WHERE station=$stat AND temp20>-999 AND (ts LIKE '%-12-%' OR ts LIKE '%-01-%' OR ts LIKE '%-02-%') GROUP BY YEAR(ts)) t GROUP BY t.average asc LIMIT 1";
        $ColdWheute=$pdo->query($sqlColdW);
        $HeuteColdWNummer="coldW$i";
        Core::$view->$HeuteColdWNummer=$ColdWheute;
        //Ende Kältester Winter    
        
        //Höchste Messung Winter
        $sqlHighW="SELECT t.ts, t.average FROM (SELECT ts, max(temp20) AS average FROM Temperatur WHERE station=$stat AND temp20>-999 AND (ts LIKE '%-12-%' OR ts LIKE '%-01-%' OR ts LIKE '%-02-%') GROUP BY YEAR(ts)) t GROUP BY t.average desc LIMIT 1";
        $HighWheute=$pdo->query($sqlHighW);
        $HeuteHighWNummer="highW$i";
        Core::$view->$HeuteHighWNummer=$HighWheute;
        //Ende Höchste Messung Winter

        //Niedrigste Messung Winter
        $sqlLowW="SELECT t.ts, t.average FROM (SELECT ts, min(temp20) AS average FROM Temperatur WHERE station=$stat AND temp20>-999 AND (ts LIKE '%-12-%' OR ts LIKE '%-01-%' OR ts LIKE '%-02-%') GROUP BY YEAR(ts)) t GROUP BY t.average asc LIMIT 1";
        $LowWheute=$pdo->query($sqlLowW);
        $HeuteLowWNummer="lowW$i";
        Core::$view->$HeuteLowWNummer=$LowWheute;
        //Ende Niedrigste Messung Winter

        //----------------------------------------------------------------------
        //Tabellen-Daten ungefiltert nach Niederschlag
        
        //Stationsnamen
        $sqlStationNiederschlag="select stationsname from Stationen where id=$stat";
        $stationNiederschlag=$pdo->query($sqlStationNiederschlag);
        $stationNameNiederschlag="stationNiederschlag$i";
        Core::$view->$stationNameNiederschlag=$stationNiederschlag;
        //Ende Stationsname
        
        //Menge im Frühling
        $sqlMengeF="SELECT AVG(RS) FROM niederschlagdaily WHERE station=$stat AND RS>-999 AND (ts LIKE '%-03-%' OR ts LIKE '%-04-%' OR ts LIKE '%-05-%')";
        $MengeF=$pdo->query($sqlMengeF);
        $MengeFNummer="mengeF$i";
        Core::$view->$MengeFNummer=$MengeF;
        //Ende Menge im Frühling
        
        //Regnerischste Tag im Frühling
        $sqlRegnerischF="SELECT * FROM (SELECT ts, max(RS) AS menge FROM niederschlagdaily WHERE station=$stat AND (ts LIKE '%-03-%' OR ts LIKE '%-04-%' OR ts LIKE '%-05-%') GROUP BY YEAR(ts))t GROUP BY t.menge desc limit 1";
        $RegnerischF=$pdo->query($sqlRegnerischF);
        $RegnerischFNummer="regnerischF$i";
        Core::$view->$RegnerischFNummer=$RegnerischF;
        //Ende Regnerischste Tag im Frühling
        
        //Längste Trockenzeit im Frühling
        $sqlTrockenF="SELECT t.ts, count(t.average) AS tage FROM (SELECT ts, avg(RS) AS average FROM niederschlagdaily WHERE station=$stat AND (ts LIKE '%-03-%' OR ts LIKE '%-04-%' OR ts LIKE '%-05-%') GROUP BY YEAR(ts), MONTH(ts), DAY(ts))t WHERE t.average=0 GROUP BY YEAR(t.ts) ORDER BY tage DESC LIMIT 1";
        $TrockenF=$pdo->query($sqlTrockenF);
        $TrockenFNummer="trockenF$i";
        Core::$view->$TrockenFNummer=$TrockenF;
        //Ende Längste Trockenzeit im Frühling
        
        //Menge im Sommer
        $sqlMengeS="SELECT AVG(RS) FROM niederschlagdaily WHERE station=$stat AND RS>-999 AND (ts LIKE '%-06-%' OR ts LIKE '%-07-%' OR ts LIKE '%-08-%')";
        $MengeS=$pdo->query($sqlMengeS);
        $MengeSNummer="mengeS$i";
        Core::$view->$MengeSNummer=$MengeS;
        //Ende Menge im Sommer
        
        //Regnerischste Tag im Sommer
        $sqlRegnerischS="SELECT * FROM (SELECT ts, max(RS) AS menge FROM niederschlagdaily WHERE station=$stat AND (ts LIKE '%-06-%' OR ts LIKE '%-07-%' OR ts LIKE '%-08-%') GROUP BY YEAR(ts))t GROUP BY t.menge desc limit 1";
        $RegnerischS=$pdo->query($sqlRegnerischS);
        $RegnerischSNummer="regnerischS$i";
        Core::$view->$RegnerischSNummer=$RegnerischS;
        //Ende Regnerischste Tag im Sommer
        
        //Längste Trockenzeit im Sommer
        $sqlTrockenS="SELECT t.ts, count(t.average) AS tage FROM (SELECT ts, avg(RS) AS average FROM niederschlagdaily WHERE station=$stat AND (ts LIKE '%-06-%' OR ts LIKE '%-07-%' OR ts LIKE '%-08-%') GROUP BY YEAR(ts), MONTH(ts), DAY(ts))t WHERE t.average=0 GROUP BY YEAR(t.ts) ORDER BY tage DESC LIMIT 1";
        $TrockenS=$pdo->query($sqlTrockenS);
        $TrockenSNummer="trockenS$i";
        Core::$view->$TrockenSNummer=$TrockenS;
        //Ende Längste Trockenzeit im Sommer
        
        //Menge im Herbst
        $sqlMengeH="SELECT AVG(RS) FROM niederschlagdaily WHERE station=$stat AND RS>-999 AND (ts LIKE '%-09-%' OR ts LIKE '%-10-%' OR ts LIKE '%-11-%')";
        $MengeH=$pdo->query($sqlMengeH);
        $MengeHNummer="mengeH$i";
        Core::$view->$MengeHNummer=$MengeH;
        //Ende Menge im Herbst
        
        //Regnerischste Tag im Herbst
        $sqlRegnerischH="SELECT * FROM (SELECT ts, max(RS) AS menge FROM niederschlagdaily WHERE station=$stat AND (ts LIKE '%-09-%' OR ts LIKE '%-10-%' OR ts LIKE '%-11-%') GROUP BY YEAR(ts))t GROUP BY t.menge desc limit 1";
        $RegnerischH=$pdo->query($sqlRegnerischH);
        $RegnerischHNummer="regnerischH$i";
        Core::$view->$RegnerischHNummer=$RegnerischH;
        //Ende Regnerischste Tag im Herbst
        
        //Längste Trockenzeit im Herbst
        $sqlTrockenH="SELECT t.ts, count(t.average) AS tage FROM (SELECT ts, avg(RS) AS average FROM niederschlagdaily WHERE station=$stat AND (ts LIKE '%-09-%' OR ts LIKE '%-10-%' OR ts LIKE '%-11-%') GROUP BY YEAR(ts), MONTH(ts), DAY(ts))t WHERE t.average=0 GROUP BY YEAR(t.ts) ORDER BY tage DESC LIMIT 1";
        $TrockenH=$pdo->query($sqlTrockenH);
        $TrockenHNummer="trockenH$i";
        Core::$view->$TrockenHNummer=$TrockenH;
        //Ende Längste Trockenzeit im Herbst
        
        //Menge im Winter
        $sqlMengeW="SELECT AVG(RS) FROM niederschlagdaily WHERE station=$stat AND RS>-999 AND (ts LIKE '%-12-%' OR ts LIKE '%-01-%' OR ts LIKE '%-02-%')";
        $MengeW=$pdo->query($sqlMengeW);
        $MengeWNummer="mengeW$i";
        Core::$view->$MengeWNummer=$MengeW;
        //Ende Menge im Winter
        
        //Regnerischste Tag im Winter
        $sqlRegnerischW="SELECT * FROM (SELECT ts, max(RS) AS menge FROM niederschlagdaily WHERE station=$stat AND (ts LIKE '%-12-%' OR ts LIKE '%-01-%' OR ts LIKE '%-02-%') GROUP BY YEAR(ts))t GROUP BY t.menge desc limit 1";
        $RegnerischW=$pdo->query($sqlRegnerischW);
        $RegnerischWNummer="regnerischW$i";
        Core::$view->$RegnerischWNummer=$RegnerischW;
        //Ende Regnerischste Tag im Winter
        
        //Längste Trockenzeit im Winter
        $sqlTrockenW="SELECT t.ts, count(t.average) AS tage FROM (SELECT ts, avg(RS) AS average FROM niederschlagdaily WHERE station=$stat AND (ts LIKE '%-12-%' OR ts LIKE '%-01-%' OR ts LIKE '%-02-%') GROUP BY YEAR(ts), MONTH(ts), DAY(ts))t WHERE t.average=0 GROUP BY YEAR(t.ts) ORDER BY tage DESC LIMIT 1";
        $TrockenW=$pdo->query($sqlTrockenW);
        $TrockenWNummer="trockenW$i";
        Core::$view->$TrockenWNummer=$TrockenW;
        //Längste Trockenzeit im Winter
    
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
    