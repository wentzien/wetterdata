<?php

Core::checkAccessLevel(0);
        
Core::$view->path["view1"]="views/view.home.php";

$schluessel=Core::$user->m_oid;
$aktuelleStat=Core::$user->homewetter;

        
$pdo = Core::$pdo;


$SQLausgewStat="select * from Stationen Where BL='BW' Order by stationsname";

$ausgewStat=$pdo->query($SQLausgewStat);

$fav=filter_input(INPUT_POST,"saveasfav",FILTER_SANITIZE_STRING);
if ($fav=="ON")
{
$Statide=filter_input(INPUT_POST,"ausgewStation",FILTER_SANITIZE_STRING);
$SQLcreatehom = "Update User SET homewetter =$Statide WHERE m_oid=$schluessel";
$pdo->query($SQLcreatehom);
}
$SQLtoptentemp = "(SELECT * FROM Temperatur LEFT JOIN Stationen ON Stationen.id=Temperatur.station) ORDER BY temp5 DESC Limit 10";
$listtemp=$pdo->query($SQLtoptentemp);
Core::$view->ausgewStat=$ausgewStat;
Core::$view->list=$listtemp;  

$SQLtoptenpress = "(SELECT * FROM Temperatur LEFT JOIN Stationen ON Stationen.id=Temperatur.station) ORDER BY Luftdruck DESC Limit 10";
$listpress=$pdo->query($SQLtoptenpress);
Core::$view->list=$listpress; 
