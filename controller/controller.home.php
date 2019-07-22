<?php

Core::checkAccessLevel(0);
        
Core::$view->path["view1"]="views/view.home.php";
$listalldataqualthree=array();
$listuserfavsname=array();
$listalldata=array();
$listmindate=array();
$listmaxdate=array();
$listmissval=array();
$listdatabig=array();  
$listdatameltavg=array();
$listdatahumiavg=array();
$listdataairavg=array();
$listdatatempavg=array();

$schluessel=Core::$user->m_oid;
$aktuelleStat=Core::$user->homewetter;

        
$pdo = Core::$pdo;


$SQLuserfavs = "SELECT * FROM favoriten Left JOin Stationen On favoriten.StationID= Stationen.id Where Userid=$schluessel";
$listuserfavs=$pdo->query($SQLuserfavs);
$c=0;
Foreach ($listuserfavs as $favs){
$listuserfavsid[$c]=$favs[2];
$listuserfavsname[$c]=$favs[4];
$c++;  
};



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





$SQLalldatatemp5avg = "select AVG(temp5) from Temperatur where temp5<>-999";
$listalldatatemp5avg=$pdo->query($SQLalldatatemp5avg);
Core::$view->listalldatatemp5avg=$listalldatatemp5avg;





      
$c=0;
$SQLalldataqualthree = "SELECT COUNT(station) FROM Temperatur Where quality = 3";
$listalldataqualthree[$c]=$pdo->query($SQLalldataqualthree);
$SQLalldata = "SELECT COUNT(station) FROM Temperatur";
$listalldata[$c]=$pdo->query($SQLalldata);
$SQLmindate = "select Min(ts) from Temperatur where (temp20<>-999 AND ts<>0)";
$listmindate[$c]=$pdo->query($SQLmindate);
$SQLmaxdate = "select MAX(ts) from Temperatur where (temp20<>-999 AND ts<>0)";
$listmaxdate[$c]=$pdo->query($SQLmaxdate);
$SQLmissval = "SELECT COUNT(station) FROM Temperatur Where (temp20=-999 OR temp5=-999 OR feuchte=-999 OR Luftdruck=-999)";
$listmissval[$c]=$pdo->query($SQLmissval);
$SQLdatabig = "SELECT COUNT(station) FROM Temperatur Where ts > '2018-12-31 23:59:59'";
$listdatabig[$c]=$pdo->query($SQLdatabig);
$SQLdatameltavg = "select AVG(taupunkt) from Temperatur where taupunkt<>-999";
$listdatameltavg[$c]=$pdo->query($SQLdatameltavg);
$SQLdataairavg = "select AVG(luftdruck) from Temperatur where luftdruck<>-999";
$listdataairavg[$c]=$pdo->query($SQLdataairavg);
$SQLdatahumiavg = "select AVG(feuchte) from Temperatur where feuchte<>-999";
$listdatahumiavg[$c]=$pdo->query($SQLdatahumiavg);
$SQLdatatempavg = "select AVG(temp20) from Temperatur where temp20<>-999";
$listdatatempavg[$c]=$pdo->query($SQLdatatempavg);




Foreach ($listuserfavsid as $id){
$c++;
$SQLalldataqualthree = "SELECT COUNT(station) FROM Temperatur Where station=$id AND quality = 3";
$listalldataqualthree[$c]=$pdo->query($SQLalldataqualthree);

$SQLalldata = "SELECT COUNT(station) FROM Temperatur Where station=$id";
$listalldata[$c]=$pdo->query($SQLalldata);


$SQLmindate = "select Min(ts) from Temperatur where station=$id and (temp20<>-999 AND ts<>0)";
$listmindate[$c]=$pdo->query($SQLmindate);

$SQLmaxdate = "select MAX(ts) from Temperatur where station=$id and (temp20<>-999 AND ts<>0)";
$listmaxdate[$c]=$pdo->query($SQLmaxdate);

$SQLmissval = "SELECT COUNT(station) FROM Temperatur Where station=$id AND (temp20=-999 OR temp5=-999 OR feuchte=-999 OR Luftdruck=-999)";
$listmissval[$c]=$pdo->query($SQLmissval);

$SQLdatabig = "SELECT COUNT(station) FROM Temperatur Where station=$id AND ts > '2018-12-31 23:59:59'";
$listdatabig[$c]=$pdo->query($SQLdatabig);

$SQLdatameltavg = "select AVG(taupunkt) from Temperatur where station=$id AND taupunkt<>-999";
$listdatameltavg[$c]=$pdo->query($SQLdatameltavg);

$SQLdataairavg = "select AVG(luftdruck) from Temperatur where station=$id AND luftdruck<>-999";
$listdataairavg[$c]=$pdo->query($SQLdataairavg);

$SQLdatahumiavg = "select AVG(feuchte) from Temperatur where station=$id AND feuchte<>-999";
$listdatahumiavg[$c]=$pdo->query($SQLdatahumiavg);

$SQLdatatempavg = "select AVG(temp20) from Temperatur where station=$id AND temp20<>-999";
$listdatatempavg[$c]=$pdo->query($SQLdatatempavg);

};
// übergabe der ID und Name der Favoriten des Users
Core::$view->listuserfavsname=$listuserfavsname; 
Core::$view->listuserfavsid=$listuserfavsid;

// Alle dastensätze mit Qualitätsniveau 3
Core::$view->listalldataqualthree=$listalldataqualthree;

//zahl aller Datensätze
Core::$view->listalldata=$listalldata;
//ältester Datensatz
Core::$view->listmindate=$listmindate;
//jüngster Datensatz
Core::$view->listmaxdate=$listmaxdate;

// Unvollständige Werte

Core::$view->listmissval=$listmissval;

// alle werte ab begin 2019

Core::$view->listdatabig=$listdatabig;

// Durschnittliche taupunkttemperatur
Core::$view->listdatameltavg=$listdatameltavg;

// Durschnittlicher Luftdruck
Core::$view->listdataairavg=$listdataairavg;
// Durschnittlicher Luftfeuchtigkeit
Core::$view->listdatahumiavg=$listdatahumiavg;
// Durschnittliche Temperatur
Core::$view->listdatatempavg=$listdatatempavg;
// alle favs

$SQLfavs = "SELECT * FROM favoriten Where UserID=$schluessel";
$listfavs=$pdo->query($SQLfavs);
Core::$view->listfavs=$listfavs;




