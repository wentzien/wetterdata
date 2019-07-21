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
$SQLtoptentemp = "(SELECT * FROM Temperatur LEFT JOIN Stationen ON Stationen.id=Temperatur.station) ORDER BY temp5 DESC Limit 5";
$listtemp=$pdo->query($SQLtoptentemp);
Core::$view->ausgewStat=$ausgewStat;
Core::$view->listtemp=$listtemp;  

$SQLtoptenpress = "(SELECT * FROM Temperatur LEFT JOIN Stationen ON Stationen.id=Temperatur.station) ORDER BY Luftdruck DESC Limit 5";
$listpress=$pdo->query($SQLtoptenpress);
Core::$view->listpress=$listpress; 


$SQLtoptenhumi = "(SELECT * FROM Temperatur LEFT JOIN Stationen ON Stationen.id=Temperatur.station) ORDER BY feuchte DESC Limit 5";
$listhumi=$pdo->query($SQLtoptenhumi);
Core::$view->listhumi=$listhumi; 

    
$SQLalldataqualthreepf = "SELECT COUNT(station) FROM Temperatur Where station=3925 AND quality = 3";
$listalldataqualthreepf=$pdo->query($SQLalldataqualthreepf);
Core::$view->listalldataqualthreepf=$listalldataqualthreepf;


$SQLalldataqual3ml = "SELECT COUNT(station) FROM Temperatur Where station=3362 AND quality = 3";
$listalldataqual3ml=$pdo->query($SQLalldataqual3ml);
Core::$view->listalldataqual3ml=$listalldataqual3ml;


$SQLalldatapf = "SELECT COUNT(station) FROM Temperatur Where station=3925";
$listalldatapf=$pdo->query($SQLalldatapf);
Core::$view->listalldatapf=$listalldatapf;

$SQLalldataml = "SELECT COUNT(station) FROM Temperatur Where station=3362";
$listalldataml=$pdo->query($SQLalldataml);
Core::$view->listalldataml=$listalldataml;


$SQLalldatatempavg = "select AVG(temp20) from Temperatur where temp20<>-999";
$listalldatatempavg=$pdo->query($SQLalldatatempavg);
Core::$view->listalldatatempavg=$listalldatatempavg;


$SQLalldatatemp5avg = "select AVG(temp5) from Temperatur where temp5<>-999";
$listalldatatemp5avg=$pdo->query($SQLalldatatemp5avg);
Core::$view->listalldatatemp5avg=$listalldatatemp5avg;


$SQLalldatahumiavg = "select AVG(feuchte) from Temperatur where feuchte<>-999";
$listalldatahumiavg=$pdo->query($SQLalldatahumiavg);
Core::$view->listalldatahumiavg=$listalldatahumiavg;


$SQLalldataairavg = "select AVG(luftdruck) from Temperatur where luftdruck<>-999";
$listalldataairavg=$pdo->query($SQLalldataairavg);
Core::$view->listalldataairavg=$listalldataairavg;


$SQLalldatameltavg = "select AVG(taupunkt) from Temperatur where taupunkt<>-999";
$listalldatameltavg=$pdo->query($SQLalldatameltavg);
Core::$view->listalldatameltavg=$listalldatameltavg;



$SQLmindateml = "select Min(ts) from Temperatur where station=3362 and (temp20<>-999 AND ts<>0)";
$listmindateml=$pdo->query($SQLmindateml);
Core::$view->listmindateml=$listmindateml;

$SQLmindatepf = "select Min(ts) from Temperatur where station=3925 and (temp20<>-999 AND ts<>0)";
$listmindatepf=$pdo->query($SQLmindatepf);
Core::$view->listmindatepf=$listmindatepf;


$SQLmaxdateml = "select MAX(ts) from Temperatur where station=3362 and (temp20<>-999 AND ts<>0)";
$listmaxdateml=$pdo->query($SQLmaxdateml);
Core::$view->listmaxdateml=$listmaxdateml;

$SQLmaxdatepf = "select MAX(ts) from Temperatur where station=3925 and (temp20<>-999 AND ts<>0)";
$listmaxdatepf=$pdo->query($SQLmaxdatepf);
Core::$view->listmaxdatepf=$listmaxdatepf;


// Unvollständige Werte
$SQLmissvalml = "SELECT COUNT(station) FROM Temperatur Where station=3362 AND (temp20=-999 OR temp5=-999 OR feuchte=-999 OR Luftdruck=-999)";
$listmissvalml=$pdo->query($SQLmissvalml);
Core::$view->listmissvalml=$listmissvalml;

$SQLmissvalpf = "SELECT COUNT(station) FROM Temperatur Where station=3925 AND (temp20=-999 OR temp5=-999 OR feuchte=-999 OR Luftdruck=-999)";
$listmissvalpf=$pdo->query($SQLmissvalpf);
Core::$view->listmissvalpf=$listmissvalpf;


// alle werte ab begin 2019
$SQLdatabigml = "SELECT COUNT(station) FROM Temperatur Where station=3362 AND ts > '2018-12-31 23:59:59'";
$listdatabigml=$pdo->query($SQLdatabigml);
Core::$view->listdatabigml=$listdatabigml;


$SQLdatabigpf = "SELECT COUNT(station) FROM Temperatur Where station=3362 AND ts > '2018-12-31 23:59:59'";
$listdatabigpf=$pdo->query($SQLdatabigpf);
Core::$view->listdatabigpf=$listdatabigpf;


// alle favs

$SQLfavs = "SELECT * FROM favoriten Where UserID=$schluessel";
$listfavs=$pdo->query($SQLfavs);
Core::$view->listfavs=$listfavs;




