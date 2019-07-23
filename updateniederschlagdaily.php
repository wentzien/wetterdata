<?php 
ini_set("max_execution_time", 36000);

$stationen=array();
//$stationen[]="03925";
$stationen[]="03362";

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
         $SQL="INSERT INTO niederschlagdaily (station, timestamp, ts, RS, RSF, NSH_TAG, SH_TAG, quality, canvasts) VALUES (?,?,?,?,?,?,?,?,?)"
                 . "ON DUPLICATE KEY UPDATE ts=VALUES(ts), RS=VALUES(RS), RSF=VALUES(RSF), NSH_TAG=VALUES(NSH_TAG), SH_TAG=VALUES(SH_TAG), quality=VALUES(quality);";
                
//            $SQL="INSERT IGNORE INTO Temperatur (station,timestamp, ts, Luftdruck, temp5, temp20,feuchte, taupunkt,quality,canvasts) VALUES (?,?,?,?,?,?,?,?,?,?)";
                
          
         $station=$entry[0];
             $year=substr($entry[1],0,4);
             $month=substr($entry[1],4,2);
             $day=substr($entry[1],6,2);
             $timestamp= mktime($month,$day,$year);
             $ts="$year-$month-$day";             
             $RS=$entry[3];
             $RSF=$entry[4];
             $NSH_TAG=$entry[5];
             $SH_TAG=$entry[6];           
             $quality=$entry[2];
             $canvasts="$year, $month, $day";       
  
         
         
         $stmt=$pdo->prepare($SQL);
         
        $stmt->execute([$station,$timestamp,$ts,$RS,$RSF,$NSH_TAG,$SH_TAG,$quality,$canvasts]);
         
     }
}
}

foreach ($stationen as $station) {
    //Url für Datei der Daten von "gestern" bis 2 Jahre zurück
    $urlrecent = "https://opendata.dwd.de/climate_environment/CDC/observations_germany/climate/daily/more_precip/recent/tageswerte_RR_".$station."_akt.zip";
    
    
    DatenEinspielen($urlrecent);
    //DatenEinspielen($urlrecent);
}
?>
