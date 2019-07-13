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
$SQLaddfav = "INSERT INTO favoriten (UserID, StationID) VALUES ($uID, $Statide)";
$pdo->query($SQLaddfav);
}
elseif ((filter_input(INPUT_POST,"delfav",FILTER_SANITIZE_STRING)) <> "") {
$Statide=filter_input(INPUT_POST,"delfav",FILTER_SANITIZE_STRING);    
$SQLdellfav="DELETE FROM favoriten WHERE userid=$uID AND StationID=$Statide";
$pdo->query($SQLdellfav); 
    
};

$SQLallStat="SELECT * FROM Stationen LEFT JOIN favoriten ON Stationen.id = favoriten.StationID WHERE (UserID IS Null OR UserID <> 2) AND (BL='BW') order by stationsname";
$allStat=$pdo->query($SQLallStat);
$SQLallfavs="SELECT * FROM favoriten LEFT JOIN Stationen ON favoriten.Stationid = Stationen.ID Where UserID=$uID";
$allfavs=$pdo->query($SQLallfavs);
Core::$view->allStat=$allStat;
Core::$view->allfavs=$allfavs;
Core::$view->path["view1"]="views/view.editfav.php";