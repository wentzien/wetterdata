<?php 
ini_set("max_execution_time", 36000);

$database="";
$host="";
$user="";
$password="";
        
$pdo = new PDO("mysql:host=".$host.";dbname=".$database.";charset=utf8",$user,$password);
$pdo->setAttribute( PDO::ATTR_EMULATE_PREPARES,true);
$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING ); // For Debugging

//Ruft alle Stationen ab, die eingespielt werden müssen
$sqlstationen="select id from Stationen";
$querystationen=$pdo->query($sqlstationen);

$stationen=array();
foreach($querystationen as $row){
    $stationen[]=$row['id'];
}

function DatenEinspielen ($url){
    
$database="wetterdata";
$host="141.47.2.40";
$user="wetterdata";
$password="wvgnigt";
        
$pdo = new PDO("mysql:host=".$host.";dbname=".$database.";charset=utf8",$user,$password);
$pdo->setAttribute( PDO::ATTR_EMULATE_PREPARES,true);
$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING ); // For Debugging
 
$destination_dir = 'txtdaten/';    

//parse_url zerlegt die URL in seine Bestandteile
//basename gibt dann den letzten Teil der URL zurück (in diesem Fall dann den Namen der zip
$local_zip_file = basename(parse_url($url, PHP_URL_PATH)); 

// falls reguläre Datei, wird diese aus dem Verzeichnis gelöscht
if(is_file( $destination_dir .$local_zip_file)){
    unlink($destination_dir .$local_zip_file);
}

// kopiert die Datei ins Zielverzeichnis, falls es fehlschlägt kommt Meldung und der Vorgang wird abgebrochen
if (!copy($url, $destination_dir . $local_zip_file)) {
    
    die('Failed to copy Zip from ' . $url . ' to ' . ($destination_dir . $local_zip_file));
}

//Zip wird extrahiert
//$zip = new ZipArchive;
//if ($zip->open($destination_dir . $local_zip_file) === TRUE) {
//    $zip->extractTo($destination_dir);
//    $csvname=$zip->getNameIndex("0");
//    $zip->close();

$zip = new ZipArchive();
if ($zip->open($destination_dir . $local_zip_file)) {
    for ($i = 0; $i < $zip->numFiles; $i++) {
        if ($zip->extractTo($destination_dir, array($zip->getNameIndex($i)))) {
            $csvname= $destination_dir . $zip->getNameIndex($i);
            echo "$csvname<br/>";
        }
    }
    $zip->close();


// Zip wird gelöscht
unlink($destination_dir . $local_zip_file); 

$csv=fopen($csvname,"r");
$header=fgetcsv($csv,0,";");
$pforzheim=array();
     while($zeile=fgetcsv($csv,0,";")){
            array_push($pforzheim,$zeile);
     }
     $pf=count($pforzheim);
     echo "$pf<br/>";
     
     
     
     foreach($pforzheim as $entry){
         $SQL="INSERT INTO Temperatur (station,timestamp, ts, Luftdruck, temp5, temp20,feuchte, taupunkt,quality,canvasts) VALUES (?,?,?,?,?,?,?,?,?,?)"
                 . "ON DUPLICATE KEY UPDATE ts=VALUES(ts), Luftdruck=VALUES(Luftdruck), temp5=VALUES(temp5), temp20=VALUES(temp20), feuchte=VALUES(feuchte), taupunkt=VALUES(taupunkt), quality=VALUES(quality);";
                
//            $SQL="INSERT IGNORE INTO Temperatur (station,timestamp, ts, Luftdruck, temp5, temp20,feuchte, taupunkt,quality,canvasts) VALUES (?,?,?,?,?,?,?,?,?,?)";
                
          
         $station=$entry[0];
             $year=substr($entry[1],0,4);
             $month=substr($entry[1],4,2);
             $canvasmonth=$month-1;
             $day=substr($entry[1],6,2);
             $hour=substr($entry[1],8,2);
             $minute=substr($entry[1],10,2);
             $seconds="00";
             $timestamp= mktime($hour,$minute,$seconds,$month,$day,$year);
             $ts="$year-$month-$day $hour:$minute:$seconds";
             $canvasts="$year, $canvasmonth, $day, $hour, $minute";
             $luftdruck=$entry[3];
             $temp5=$entry[4];
             $temp20=$entry[5];
             $feuchte=$entry[6];
             $taupunkt=$entry[7];
             $quality=$entry[2];
                      
  
         
         
         $stmt=$pdo->prepare($SQL);
         
        $stmt->execute([$station,$timestamp,$ts,$luftdruck,$temp5,$temp20,$feuchte,$taupunkt,$quality,$canvasts]);
         
     }
}
}

foreach ($stationen as $station) {

//ergänzt fehlende Nullen    
$laenge= strlen($station);
$stationX=$station;
if($laenge<5){
    $ergaenzung=5-$laenge;
    for($x=0; $x<$ergaenzung; $x++){
        $stationX="0$stationX";
    }
}
    
    //Url für Datei der Daten von "heute"
    $urlnow = "https://opendata.dwd.de/climate_environment/CDC/observations_germany/climate/10_minutes/air_temperature/now/10minutenwerte_TU_".$stationX."_now.zip";
    //Url für Datei der Daten von "gestern" bis 2 Jahre zurück
    $urlrecent = "https://opendata.dwd.de/climate_environment/CDC/observations_germany/climate/10_minutes/air_temperature/recent/10minutenwerte_TU_".$stationX."_akt.zip";
    
//    DatenEinspielen($urlnow);
    DatenEinspielen($urlrecent);
}
?>
