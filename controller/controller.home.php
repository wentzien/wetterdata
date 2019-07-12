<?php

Core::checkAccessLevel(0);
        
Core::$view->path["view1"]="views/view.home.php";

$schluessel=Core::$user->m_oid;
$aktuelleStat=Core::$user->homewetter;

        
$pdo = Core::$pdo;


$SQLausgewStat="select * from Stationen";

$ausgewStat=$pdo->query($SQLausgewStat);

$fav=filter_input(INPUT_POST,"saveasfav",FILTER_SANITIZE_STRING);
if ($fav=="ON")
{
$Statide=filter_input(INPUT_POST,"ausgewStation",FILTER_SANITIZE_STRING);
$SQLcreatehom = "Update User SET homewetter =$Statide WHERE m_oid=$schluessel";
$pdo->query($SQLcreatehom);
}

Core::$view->ausgewStat=$ausgewStat;

  
