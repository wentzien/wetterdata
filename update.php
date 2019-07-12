<?php 
$station="03925";

//Url für Datei der Daten von "heute"
$urlnow = "https://opendata.dwd.de/climate_environment/CDC/observations_germany/climate/10_minutes/air_temperature/now/10minutenwerte_TU_".$station."_now.zip";
//Url für Datei der Daten von "gestern" bis 2 Jahre zurück
$urlrecent = "https://opendata.dwd.de/climate_environment/CDC/observations_germany/climate/10_minutes/air_temperature/recent/10minutenwerte_TU_".$station."_akt.zip";

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
            echo $csvname;
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
     echo count($pforzheim);
     
     
     
     foreach($pforzheim as $entry){
         $SQL="INSERT INTO Temperatur (station,timestamp, ts, Luftdruck, temp5, temp20,feuchte, taupunkt,quality,canvasts) VALUES (?,?,?,?,?,?,?,?,?,?)"
                 . "ON DUPLICATE KEY UPDATE ts=VALUES(ts), Luftdruck=VALUES(Luftdruck), temp5=VALUES(temp5), temp20=VALUES(temp20), feuchte=VALUES(feuchte), taupunkt=VALUES(taupunkt), quality=VALUES(quality);";
                
            $SQL="INSERT IGNORE INTO Temperatur (station,timestamp, ts, Luftdruck, temp5, temp20,feuchte, taupunkt,quality,canvasts) VALUES (?,?,?,?,?,?,?,?,?,?)";
                
          
         $station=$entry[0];
             $year=substr($entry[1],0,4);
             $month=substr($entry[1],4,2);
             $day=substr($entry[1],6,2);
             $hour=substr($entry[1],8,2);
             $minute=substr($entry[1],10,2);
             $seconds="00";
             $timestamp= mktime($hour,$minute,$seconds,$month,$day,$year);
             $ts="$year-$month-$day $hour:$minute:$seconds";
             $canvasts="$year, $month, $day, $hour, $minute";
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

DatenEinspielen($urlnow);
//DatenEinspielen($urlrecent);
?>
