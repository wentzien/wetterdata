<?php
function DatenEinspielen (){
ini_set("max_execution_time", 36000);
$database="";
$host="";
$user="";
$password="";
        
$pdo = new PDO("mysql:host=".$host.";dbname=".$database.";charset=utf8",$user,$password);
$pdo->setAttribute( PDO::ATTR_EMULATE_PREPARES,true);
$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING ); // For Debugging
    
$destination_dir = 'wetterdata/';    

$csvname = "C:\\xampp\\htdocs\\wetterdata\\Mappe1.csv";
$csv=fopen($csvname,"r");
$header=fgetcsv($csv,0,";");
$pforzheim=array();
     while($zeile=fgetcsv($csv,0,";")){
            array_push($pforzheim,$zeile);
     }
     echo count($pforzheim);
     
     
     
     foreach($pforzheim as $entry){
         
    
         
         
         
         
         
         $SQL="INSERT INTO alleStationen (id,stationsname,kennung,stationskennung, BR_HIGH, LA_HIGH, höhe, flussgebiet, BL,Beginn,Ende) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
                
 
                
          
             $stationsname=$entry[0];
             $id=$entry[1];
             $kennung=$entry[2];
             $stationskennung=$entry[3];
             $BR_HIGH=$entry[4];
             $LA_HIGH=$entry[5];
             $höhe=$entry[6];
             $flussgebiet=$entry[7];
             $BL=$entry[8];
             $year=substr($entry[9],6,4);
             $month=substr($entry[9],3,2);
             $day=substr($entry[9],0,2);
             $Beginn="$year-$month-$day";
             $year=substr($entry[10],6,4);
             $month=substr($entry[10],3,2);
             $day=substr($entry[10],0,2);
             $Ende="$year-$month-$day";

                      
  
         
         
         $stmt=$pdo->prepare($SQL);
         
        $stmt->execute([$id,$stationsname,$kennung,$stationskennung,$BR_HIGH,$LA_HIGH,$höhe,$flussgebiet,$BL,$Beginn,$Ende]);
         
     }
}


DatenEinspielen();
?>
