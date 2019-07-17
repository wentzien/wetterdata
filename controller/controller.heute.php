<?php
Core::$view->path["view1"]="views/view.heute.php";

date_default_timezone_set("Europe/Berlin");
$timestamp = time();
$datum = date("Y-m-d",$timestamp);
$pdo=Core::$pdo;
$dieStation=$_POST['ausgewStation'];
//Wurden Stationswerte übergenen?, wenn nicht soll der Nuter darauf hingwiesen werden dass er eine Station auswähelen soll
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
        $sqlheute="select * from Temperatur where station=$stat AND ts like '$datum%' order by ts asc";
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
}
else{
Core::addError("Bitte wähle eine Station aus");
}
//Listet alle Stationen auf
$SQLausgewStat="select * from Stationen";
$ausgewStat=$pdo->query($SQLausgewStat);
Core::$view->ausgewStat=$ausgewStat;
?>
    