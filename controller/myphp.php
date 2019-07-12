<?php
date_default_timezone_set("Europe/Berlin");
$timestamp = time();
$datum = date("Y-m-d",$timestamp);

$station="3925";

$database="wetterdata";
$host="141.47.2.40";
$user="wetterdata";
$password="wvgnigt";
        
$pdo = new PDO("mysql:host=".$host.";dbname=".$database.";charset=utf8",$user,$password);

$sqlheute="select * from Temperatur where ts like '$datum%' and station=$station";
$heute=$pdo->query($sqlheute);

Core::$view->heute=$heute


//foreach($heuteergebnis=$pdo->query($sqlheute) as $row){
//    echo $row['station'];
//}
//
//$i="1";
?>
    
