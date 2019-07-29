<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$uID=Core::$user->m_oid;
$pdo = Core::$pdo;
if ((filter_input(INPUT_POST,"addfav",FILTER_SANITIZE_STRING)) <> ""){
    $Statide=filter_input(INPUT_POST,"addfav",FILTER_SANITIZE_STRING);
    if((filter_input(INPUT_POST,"statname",FILTER_SANITIZE_STRING)) <> ""){
    $Statname=filter_input(INPUT_POST,"statname",FILTER_SANITIZE_STRING);
    $SQLnewstat = "INSERT INTO Stationen (id,stationsname) VALUES ($Statide, '$Statname')";
    $pdo->query($SQLnewstat);
    }
    

$SQLaddfav = "INSERT INTO favoriten (UserID, StationID) VALUES ($uID, $Statide)";
$pdo->query($SQLaddfav);
}
elseif ((filter_input(INPUT_POST,"delfav",FILTER_SANITIZE_STRING)) <> "") {
$Statide=filter_input(INPUT_POST,"delfav",FILTER_SANITIZE_STRING);    
$SQLdellfav="DELETE FROM favoriten WHERE userid=$uID AND StationID=$Statide";
$pdo->query($SQLdellfav); 
    
};

$SQLallStat="SELECT * FROM Stationen LEFT JOIN favoriten ON Stationen.id = favoriten.StationID WHERE (UserID IS Null OR UserID <> $uID)order by stationsname";
$allStat=$pdo->query($SQLallStat);
$SQLallfavs="SELECT * FROM favoriten LEFT JOIN Stationen ON favoriten.Stationid = Stationen.ID Where UserID=$uID";
$allfavs=$pdo->query($SQLallfavs);
Core::$view->allStat=$allStat;
Core::$view->allfavs=$allfavs;
Core::$view->path["view1"]="views/view.editfav.php";



if(count($_POST)>0){
    $pdo = Core::$pdo;
    $search= "'%".filter_input(INPUT_POST,"stationname")."%'";
    if($search<>"'%%'"){
    $SQLstat= "(SELECT T1.id, T1.stationsname FROM (SELECT id, stationsname, kennung FROM alleStationen where kennung='RR') T1 INNER JOIN (SELECT id, kennung FROM alleStationen where kennung='MN' AND stationsname LIKE $search ) T2 ON T1.id=T2.id INNER JOIN (SELECT id, stationsname, kennung FROM alleStationen where kennung='KL') T3 ON T1.id=T3.id INNER JOIN (SELECT id, stationsname, kennung FROM alleStationen where kennung='TU') T4 ON T1.id=T4.id) Order by Stationsname";
    $stationsliste=$pdo->query($SQLstat);
    }
}


Core::$view->station=$stationsliste;


if($stationsliste<>""){
    Core::$view->path["view2"]="views/view.stationlist.php";
}