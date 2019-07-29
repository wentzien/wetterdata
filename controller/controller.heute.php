<?php
Core::$view->path["view1"]="views/view.heute.php";

date_default_timezone_set("Europe/Berlin");
$timestamp = time();
$datum = date("Y-m-d",$timestamp);
$datumDeutsch=date("d.m.Y", $timestamp);
Core::$view->datumDeutsch=$datumDeutsch;
$pdo=Core::$pdo;
$dieStation=$_POST['ausgewStation'];
//Wurden Stationswerte übergeben?, wenn nicht soll der Nutzer darauf hingwiesen werden dass er eine Station auswähelen soll
If ($dieStation<>""){
    $taskerkenner=$_POST['taskerkenner'];
    if($taskerkenner=="favorit"){
        $alsarray=array();
        $alsarray[]=$dieStation;
        $dieStation=$alsarray;
    }


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
        $sqltemp="select temp20, canvasts from Temperatur where temp20>-999 AND station=$stat AND ts like '$datum%' order by ts asc";
        $tempheute=$pdo->query($sqltemp);
        $HeuteTempNummer="heuteTemp$i";
        Core::$view->$HeuteTempNummer=$tempheute;
        
        //Übergabe des Luftdrucks
        $sqldruck="select Luftdruck, canvasts from Temperatur where Luftdruck>-999 station=$stat AND Luftdruck>-999 AND ts like '$datum%' order by ts asc";
        $druckheute=$pdo->query($sqldruck);
        $HeuteDruckNummer="heuteDruck$i";
        Core::$view->$HeuteDruckNummer=$druckheute;
        //Ende Übergabe des Luftdrucks

        //Übergabe Luftfeuchtigkeit
        $sqlfeuchte="select feuchte, canvasts from Temperatur where feuchte>-999 station=$stat AND ts like '$datum%' order by ts asc";
        $feuchteheute=$pdo->query($sqlfeuchte);
        $HeuteFeuchteNummer="heuteFeuchte$i";
        Core::$view->$HeuteFeuchteNummer=$feuchteheute;
        //Ende Übergabe der Luftfeuchtigkeit
        
        //Übergabe des Taupunktes
        $sqltaupunkt="select taupunkt, canvasts from Temperatur where taupunkt>-999 station=$stat AND ts like '$datum%' order by ts asc";
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
        
        //----------------------------------------------------------------------
        //Tabellen-Daten

        //Stationsnamen
        $sqlStationTabelle="select stationsname from Stationen where id=$stat";
        $stationTabelle=$pdo->query($sqlStationTabelle);
        $stationNameTabelle="stationTabelle$i";
        Core::$view->$stationNameTabelle=$stationTabelle;
        //Ende Stationsname
        
        //aktuellste Temp Wert
        $sqlAktTemp="select temp20, ts from Temperatur where temp20>-999 station=$stat AND ts like '$datum%' order by ts desc limit 1";
        $AktTempheute=$pdo->query($sqlAktTemp);
        $HeuteAktTempNummer="aktTemp$i";
        Core::$view->$HeuteAktTempNummer=$AktTempheute;
        //Ende aktuellste Temp Wert
        
        //Durchschnittstemperatur
        $sqlAvgTemp="select AVG(temp20) from Temperatur where temp20>-999 station=$stat AND ts like '$datum%'";
        $AvgTempheute=$pdo->query($sqlAvgTemp);
        $HeuteAvgTempNummer="avgTemp$i";
        Core::$view->$HeuteAvgTempNummer=$AvgTempheute;
        //Ende Durchschnittstemperatur
        
        //Max-Temperatur
        $sqlMaxTemp="SELECT temp20, ts from Temperatur WHERE temp20=(SELECT MAX(temp20) FROM Temperatur WHERE station=$stat AND ts LIKE '$datum%') AND station=$stat AND ts LIKE '$datum%' limit 1";
        $MaxTempheute=$pdo->query($sqlMaxTemp);
        $HeuteMaxTempNummer="maxTemp$i";
        Core::$view->$HeuteMaxTempNummer=$MaxTempheute;
        //Ende Max-Temperatur
        
        //Min-Temperatur
        $sqlMinTemp="SELECT temp20, ts from Temperatur WHERE temp20=(SELECT MIN(temp20) FROM Temperatur WHERE temp20>-999 station=$stat AND ts LIKE '$datum%') AND station=$stat AND ts LIKE '$datum%' limit 1";
        $MinTempheute=$pdo->query($sqlMinTemp);
        $HeuteMinTempNummer="minTemp$i";
        Core::$view->$HeuteMinTempNummer=$MinTempheute;
        //Ende Max-Temperatur
        
        //Durchschnitts Luftdruck
        $sqlAvgDruck="select AVG(Luftdruck) from Temperatur where Luftdruck>-999 station=$stat AND ts like '$datum%'";
        $AvgDruckheute=$pdo->query($sqlAvgDruck);
        $HeuteAvgDruckNummer="avgDruck$i";
        Core::$view->$HeuteAvgDruckNummer=$AvgDruckheute;
        //Ende Durchschnitts Luftdruck
        
        //Durchschnitts Luftfeuchtigkeit
        $sqlAvgFeuchte="select AVG(feuchte) from Temperatur where feuchte>-999 station=$stat AND ts like '$datum%'";
        $AvgFeuchteheute=$pdo->query($sqlAvgFeuchte);
        $HeuteAvgFeuchteNummer="avgFeuchte$i";
        Core::$view->$HeuteAvgFeuchteNummer=$AvgFeuchteheute;
        //Ende Durchschnitts Luftfeuchtigkeit
        
        //Durchschnitts Taupunkt
        $sqlAvgTau="select AVG(taupunkt) from Temperatur where taupunkt>-999 station=$stat AND ts like '$datum%'";
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
    