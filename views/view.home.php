<?php
 /* @var $user User */
$listtemp=Core::$view->listtemp;
$listpress=Core::$view->listpress;
$listhumi=Core::$view->listhumi;


$listuserfavsname=Core::$view->listuserfavsname;

$listalldataqualthree=Core::$view->listalldataqualthree;

$listalldata=Core::$view->listalldata;


$listmindate=Core::$view->listmindate;


$listmaxdate=Core::$view->listmaxdate;


$listmissval=Core::$view->listmissval;

// Durschnittliche taupunkttemperatur
$listdatameltavg=Core::$view->listdatameltavg;

// Durschnittlicher Luftdruck
$listdataairavg=Core::$view->listdataairavg;
// Durschnittlicher Luftfeuchtigkeit
$listdatahumiavg=Core::$view->listdatahumiavg;
// Durschnittliche Temperatur
$listdatatempavg=Core::$view->listdatatempavg;






$user=Core::$user;
if($user->vorname!=""){$eingeloggt= "Eingeloggt als: ".$user->kennung;}

if($user->vorname!=""){
    $willkommen= "Willkommen ".$user->vorname;
    } else {
        $willkommen="Willkommen in der Wetterapp";
        $loggedichein='<form action="?task=login" method="post" data-ajax="false"><input  type="submit" value="Logge dich hier ein, um deine App anzupassen."></form><br>';          
    }
?>



<label><i><?php echo($eingeloggt) ?></i></label>
<center><label><h1><?php echo($willkommen) ?></h1></label></center>
<center><h3><?php echo($loggedichein) ?></h3></center>
<center><h1>Rekordwerte für Deutschland</h1>
	
<div data-role="tabs" id="tabs">
  <div data-role="navbar">
    <ul>
      <li><a href="#one" data-ajax="false">Temperatur</a></li>
      <li><a href="#two" data-ajax="false">Luftdruck</a></li>
      <li><a href="#three" data-ajax="false">Niederschlag</a></li>
    </ul>
  </div>
<div id="one" class="ui-body-d ui-content">
    <h3> Die 10 höchsten Temperaturwerte die in Deutschland gemessen wurden</h3>
    
    <table data-role="table" id="movie-table" data-mode="reflow" class="ui-responsive">
    <thead>
        <tr>
        <th data-priority="1">Rang</th>  
        <th data-priority="1">Stationsname</th>
        <th data-priority="1">Temperatur</th>
        <th data-priority="1">Messzeitpunkt</th>
        </tr>
    </thead>
    <tbody>
  <?php

    foreach($listtemp as $item){
      $i++;
      ?>
      <tr>
        <td><?=$i?></td>
        <td><?=$item['stationsname']?></td>
        <td><?=$item['temp5']?></td>
        <td><?=date(DATE_RFC850,$item['ts'])?></td>        
      </tr>
    
  <?php } ?>
      </tbody>
      </table>
</div>
  <div id="two" class="ui-body-d ui-content">
<h3> Die 10 höchsten Luftdruckwerte die in Deutschland gemessen wurden</h3>
    
    <table data-role="table" id="movie-table" data-mode="reflow" class="ui-responsive">
  <thead>
    <tr>
      <th data-priority="1">Rang</th>  
      <th data-priority="1">Stationsname</th>
      <th data-priority="1">Luftdruck</th>
      <th data-priority="1">Messzeitpunkt</th>
    </tr>
  </thead>
  <tbody>
  <?php

  $i=0;
  foreach($listpress as $item){
      $i++;
   ?>
    <tr>
          <td><?=$i?></td>
          <td><?=$item['stationsname']?></td>
          <td><?=$item['Luftdruck']?></td>
          <td><?=date(DATE_RFC850,$item['ts'])?></td>
          </tr>
    
    <?php } ?>
    </tbody>
    </table>

   <div id="set" title="Set Appointment" class="panel">
            <iframe src="https://www.w3schools.com"></iframe> 
    </div>  
  </div>
    
    <div id="three" class="ui-body-d ui-content">

        
        <h3> Die 10 höchsten relativen Luftfeuchtigskeitswerte die in Deutschland gemessen wurden</h3>
    
    <table data-role="table" id="movie-table" data-mode="reflow" class="ui-responsive">
  <thead>
    <tr>
      <th data-priority="1">Rang</th>  
      <th data-priority="1">Stationsname</th>
      <th data-priority="1">relative Luftfeuchte</th>
      <th data-priority="1">Messzeitpunkt</th>
    </tr>
  </thead>
  <tbody>
  <?php

  $i=0;
  foreach($listhumi as $item){
      $i++;
   ?>
    <tr>
          <td><?=$i?></td>
          <td><?=$item['stationsname']?></td>
          <td><?=$item['feuchte']?></td>
          <td><?=date(DATE_RFC850,$item['ts'])?></td>
          </tr>
    
    <?php } ?>
    </tbody>
    </table>
        
        
          </div>
</div>
    
    
    
        <center>
            <br>
        <div class="ui-corner-all custom-corners">
        <div class="ui-bar ui-bar-a">
        <center><h1>Übersicht zu den Datensätzen</h1></center>
        </div>
           <?php 
           if($user->vorname!=""){
           echo("<br><strong>Ein Vergleich unter deinen Favoriten:</strong><br>");
           } else {
            echo("<br><strong>Bitte Logge dich ein, um die Datensätze deiner Favoriten vergleichen zu können.</strong><br>");
           }
           ?>
            <br>
          <table>
              <tr>
                  <th></th>                  
                  <th>Alle Stationen</th>
                  <th></th>
                  <?php                  
                  foreach($listuserfavsname as $favs){
                            $value=$favs;
                            echo("<th>$value</th><th></th>");                      
                  };
                  ?>               
              </tr>
              <tr>
                <td>Datensätze mit Qualitätsniveau 3</td>
                <?php                
                    foreach($listalldataqualthree as $row){
                        foreach($row as $layer)
                            {$value=$layer[0];
                            echo("<th>$value</th><th></th>");
                        };                        
                        
                    };          
 
                ?>
               </tr>
               <tr>
                <td>Anzahl an Datensätzen</td> 
                <?php                
                    foreach($listalldata as $row){
                        foreach($row as $layer)
                            {$value=$layer[0];
                            echo("<th>$value</th><th></th>");
                        }; 
                    };   
                ?> 
               </tr>
               <tr>
                <td>Fehlerhafte Datensätze</td>
                <?php                
                    foreach($listmissval as $row){
                        foreach($row as $layer)
                            {$value=$layer[0];
                            echo("<th>$value</th><th></th>");
                        }; 
                    };   
                ?> 
              
               </tr>
               <tr>
                <td>Datensätze seit Ende 2018</td>
                         
               </tr>
               <tr>
                <td>Durchschnitts-Luftdruck</td>
                <?php                
                    foreach($listdataairavg as $row){
                        foreach($row as $layer)
                            {$value=$layer[0];
                            echo("<th>$value</th><th></th>");
                        }; 
                    };   
                ?> 
               </tr>
               <tr>
                <td>Durchschnitts-Luftfeuchtigkeit</td>
                <?php                
                    foreach($listdatahumiavg as $row){
                        foreach($row as $layer)
                            {$value=$layer[0];
                            echo("<th>$value</th><th></th>");
                        }; 
                    };   
                ?> 
                
               </tr>
               <tr>
                <td>Durchschnitts-Taupunkttemperatur</td>
                
                <?php                
                    foreach($listdatameltavg as $row){
                        foreach($row as $layer)
                            {$value=$layer[0];
                            echo("<th>$value</th><th></th>");
                        }; 
                    };   
                ?> 
                
                
               </tr>
               
                <tr>
                <td>Durchschnitts-Temperatur</td>
                
                <?php                
                    foreach($listdatatempavg as $row){
                        foreach($row as $layer)
                            {$value=$layer[0];
                            echo("<th>$value</th><th></th>");
                        }; 
                    };   
                ?> 
                
                
               </tr>
               
              
               
               
               <tr>
                <td>Ältester Datensatz</td>
                <?php                
                    foreach($listmindate as $row){
                        foreach($row as $layer)
                            {$value=$layer[0];
                            echo("<th>$value</th><th></th>");
                        }; 
                    };   
                ?>                 
               </tr>
               <tr>
                <td>Neuester Datensatz</td>
                <?php                
                    foreach($listmaxdate as $row){
                        foreach($row as $layer)
                            {$value=$layer[0];
                            echo("<th>$value</th><th></th>");
                        }; 
                    };   
                ?>  
               </tr>
            </table>
        </div>
    </center>
