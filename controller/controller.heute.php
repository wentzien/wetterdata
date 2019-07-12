<?php
Core::$view->path["view1"]="views/view.heute.php";
//Core::$view->path["view2"]="views/view.auswahl.php";

date_default_timezone_set("Europe/Berlin");
$timestamp = time();
$datum = date("Y-m-d",$timestamp);

$dieStation=$_POST['ausgewStation'];
Core::$view->dieStation=$dieStation;
$station=$dieStation;

$pdo=Core::$pdo;

//Abfrage zu den heutigen Temp Werten
$sqlheute="select * from Temperatur where station=$station AND ts like '$datum%' order by ts asc";
$heute=$pdo->query($sqlheute);
Core::$view->heute=$heute;

//Listet alle Stationen auf
$SQLausgewStat="select * from Stationen";
$ausgewStat=$pdo->query($SQLausgewStat);
Core::$view->ausgewStat=$ausgewStat;

//Gibt den Namen der gewählten Station aus
$SQLNameAusgStation="select stationsname from Stationen where id=$station";
$NameAusgStation=$pdo->query($SQLNameAusgStation);
Core::$view->NameAusgStation=$NameAusgStation;

?>
    