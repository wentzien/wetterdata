<?php 
$database="wetterdata";
$host="141.47.2.40";
$user="wetterdata";
$password="wvgnigt";

     if(filter_input(INPUT_GET, "station")){
         $station=filter_input(INPUT_GET, "station");
     }else
     {
         $station="03925";
     }
        
      $pdo = new PDO("mysql:host=".$host.";dbname=".$database.";charset=utf8",$user,$password);
    $pdo->setAttribute( PDO::ATTR_EMULATE_PREPARES,true);
$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING ); // For Debugging

$url = "https://opendata.dwd.de/climate_environment/CDC/observations_germany/climate/10_minutes/air_temperature/now/10minutenwerte_TU_".$station."_now.zip";
//$url = 'https://opendata.dwd.de/climate_environment/CDC/observations_germany/climate/10_minutes/air_temperature/recent/10minutenwerte_TU_03362_akt.zip ';
//$url = 'https://opendata.dwd.de/climate_environment/CDC/observations_germany/climate/10_minutes/air_temperature/recent/10minutenwerte_TU_03925_akt.zip ';
$destination_dir = 'zip/';


$local_zip_file = basename(parse_url($url, PHP_URL_PATH)); 
if(is_file( $destination_dir .$local_zip_file)){
    unlink($destination_dir .$local_zip_file);
}

// Will return only 'some_zip.zip'
if (!copy($url, $destination_dir . $local_zip_file)) {
    
    die('Failed to copy Zip from ' . $url . ' to ' . ($destination_dir . $local_zip_file));
}
$zip = new ZipArchive();
if ($zip->open($destination_dir . $local_zip_file)) {
    for ($i = 0; $i < $zip->numFiles; $i++) {
        if ($zip->extractTo($destination_dir, array($zip->getNameIndex($i)))) {
            $csvname= $destination_dir . $zip->getNameIndex($i);
            echo $csvname;
        }
    }
    $zip->close();
    // Clear zip from local storage:
    unlink($destination_dir . $local_zip_file);
$csv=fopen($csvname,"r");
$header=fgetcsv($csv,0,";");
$pforzheim=array();
     while($zeile=fgetcsv($csv,0,";")){
            array_push($pforzheim,$zeile);
     }
     echo count($pforzheim);
     
     
     
     foreach($pforzheim as $entry){
         $SQL="INSERT INTO Temperatur (station,timestamp, ts, Luftdruck, temp5, temp20,feuchte, taupunkt,quality) VALUES (?,?,?,?,?,?,?,?,?)"
                 . "ON DUPLICATE KEY UPDATE ts=VALUES(ts), Luftdruck=VALUES(Luftdruck), temp5=VALUES(temp5), temp20=VALUES(temp20), feuchte=VALUES(feuchte), taupunkt=VALUES(taupunkt), quality=VALUES(quality);";
                
            $SQL="INSERT IGNORE INTO Temperatur (station,timestamp, ts, Luftdruck, temp5, temp20,feuchte, taupunkt,quality) VALUES (?,?,?,?,?,?,?,?,?)";
                
          
         $station=$entry[0];
             $year=substr($entry[1],0,4);
             $month=substr($entry[1],4,2);
             $day=substr($entry[1],6,2);
             $hour=substr($entry[1],8,2);
             $minute=substr($entry[1],10,2);
             $seconds="00";
             $timestamp= mktime($hour,$minute,$seconds,$month,$day,$year);
              $ts="$year-$month-$day $hour:$minute:$seconds";
              $luftdruck=$entry[3];
              $temp5=$entry[4];
              $temp20=$entry[5];
              $feuchte=$entry[6];
              $taupunkt=$entry[7];
              $quality=$entry[2];
                      
  
         
         
         $stmt=$pdo->prepare($SQL);
         
        $stmt->execute([$station,$timestamp,$ts,$luftdruck,$temp5,$temp20,$feuchte,$taupunkt,$quality]);
         
     }
}
?>