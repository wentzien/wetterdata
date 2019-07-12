<?php
function DatenEinspielen (){

$database="wetterdata";
$host="141.47.2.40";
$user="wetterdata";
$password="wvgnigt";
        
$pdo = new PDO("mysql:host=".$host.";dbname=".$database.";charset=utf8",$user,$password);
$pdo->setAttribute( PDO::ATTR_EMULATE_PREPARES,true);
$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING ); // For Debugging
    
$destination_dir = 'txtdaten/';    

$csvname = "C:\\xampp\\htdocs\\Wetterapp\\txtdaten\\Stationen.csv";
$csv=fopen($csvname,"r");
$header=fgetcsv($csv,0,";");
$pforzheim=array();
     while($zeile=fgetcsv($csv,0,";")){
            array_push($pforzheim,$zeile);
     }
     echo count($pforzheim);
     
     
     
     foreach($pforzheim as $entry){
         $SQL="INSERT INTO Stationen (stationsname,id,KE, STAT, BR_HIGH, LA_HIGH, HS, HFG_NFG, BL,Beginn,Ende) VALUES (?,?,?,?,?,?,?,?,?,?,?)"
                 . "ON DUPLICATE KEY UPDATE ts=VALUES(ts), Luftdruck=VALUES(Luftdruck), temp5=VALUES(temp5), temp20=VALUES(temp20), feuchte=VALUES(feuchte), taupunkt=VALUES(taupunkt), quality=VALUES(quality);";
                
            $SQL="INSERT IGNORE INTO Stationen (stationsname,id,KE, STAT, BR_HIGH, LA_HIGH, HS, HFG_NFG, BL,Beginn,Ende) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
                
          
             $stationsname=$entry[0];
             $id=$entry[1];
             $KE=$entry[2];
             $STAT=$entry[3];
             $BR_HIGH=$entry[4];
             $LA_HIGH=$entry[5];
             $HS=$entry[6];
             $HFG_NFG=$entry[7];
             $BL=$entry[8];
             $Beginn=$entry[9];
             $Ende=$entry[10];
                      
  
         
         
         $stmt=$pdo->prepare($SQL);
         
        $stmt->execute([$stationsname,$id,$KE,$STAT,$BR_HIGH,$LA_HIGH,$HS,$HFG_NFG,$BL,$Beginn,$Ende]);
         
     }
}


DatenEinspielen();
?>
