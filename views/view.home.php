<?php
 /* @var $user User */
$listtemp=Core::$view->listtemp;
$listpress=Core::$view->listpress;
$listhumi=Core::$view->listhumi;

$listalldataqualthreepf=Core::$view->listalldataqualthreepf;
$listalldataqual3ml=Core::$view->listalldataqual3ml;

$listalldatapf=Core::$view->listalldatapf;
$listalldataml=Core::$view->listalldataml;

$listmindatepf=Core::$view->listmindatepf;
$listmindateml=Core::$view->listmindateml;

$listmaxdateml=Core::$view->listmaxdateml;
$listmaxdatepf=Core::$view->listmaxdatepf;



$listalldatatempavg=Core::$view->listalldatatempavg;

$listalldatatemp5avg=Core::$view->listalldatatemp5avg;

$listalldatahumiavg=Core::$view->listalldatahumiavg;

$listalldataairavg=Core::$view->listalldataairavg;

$listalldatameltavg=Core::$view->listalldatameltavg;

$listmissvalml=Core::$view->listmissvalml;
$listmissvalpf=Core::$view->listmissvalpf;







$user=Core::$user;
if($user->vorname!=""){$eingeloggt= "Eingeloggt als: ".$user->kennung;}

if($user->vorname!=""){
    $willkommen= "Willkommen ".$user->vorname;
    } else {
        $willkommen="Willkommen in der Wetterapp";
        $loggedichein="Um deine App anzupassen logge dich bitte ein.";
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

<style>.embed-container {position: relative; padding-bottom: 80%; height: 0; max-width: 100%;} .embed-container iframe, .embed-container object, .embed-container iframe{position: absolute; top: 0; left: 0; width: 100%; height: 100%;} small{position: absolute; z-index: 40; bottom: 0; margin-bottom: -15px;}</style><div class="embed-container"><iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Wetterkarte" src=http://www.arcgis.com/apps/View/index.html?appid=323c65e055614461ad1d8c2bff1cd9a7"></iframe></div>
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
        <div class="ui-body ui-body-a">
          <table>
              <tr>
                <th>Eine Kurzübersicht:</th>
                <!--Stationsnamen in die Tabelle schreiben-->
                <th>Mühlacker</th>
                <th></th>
                <th>Pforzheim</th>
                <th></th>
                <th>Alle Stationen</th>
              </tr>
              <tr>
                <td>Datensätze mit Qualitätsniveau 3</td>
                <?php                
                    foreach($listalldataqual3ml as $row){ 
                        $value=$row[0];
                        echo("<th>$value</th><th></th>");                    
                    };
                
                
                    foreach($listalldataqualthreepf as $row){ 
                        $value=$row[0];
                        echo("<th>$value</th><th></th>");                    
                    };                    
 
                ?>
               </tr>
               <tr>
                <td>Datensätze</td>
                
                <?php                
                    
                    foreach($listalldataml as $row){ 
                        $value=$row[0];
                        echo("<th>$value</th><th></th>");                    
                    };
                    
                    foreach($listalldatapf as $row){ 
                        $value=$row[0];
                        echo("<th>$value</th><th></th>");                    
                    };
                ?>
                
                
               </tr>
               <tr>
                <td>Fehlerhaft Datensätze</td>
                
                <?php                
                    foreach($listmissvalml as $row){ 
                        $value=$row[0];
                        echo("<th>$value</th><th></th>");                    
                    };                    
                    foreach($listmissvalpf as $row){ 
                        $value=$row[0];
                        echo("<th>$value</th><th></th>");                    
                    }; 
                ?>
              
               </tr>
               <tr>
                <td>Datensätze seit Ende 2018</td>
                         
               </tr>
               <tr>
                <td>Durchschnitts-Luftdruck</td>
                
                <?php                
                foreach($listalldataairavg as $row){ 
                    $value=$row[0];
                    echo("<th></th><th></th><th></th><th></th><th>$value</th><th></th>");                    
                    };               
                ?>
                
               </tr>
               <tr>
                <td>Durchschnitts-Luftfeuchtigkeit</td>
                
                <?php                
                    foreach($listalldatahumiavg as $row){ 
                        $value=$row[0];
                        echo("<th></th><th></th><th></th><th></th><th>$value</th><th></th>");                    
                    };               
                ?>
                
               </tr>
               <tr>
                <td>Durchschnitts-Taupunkttemperatur</td>
                
                <?php                
                    foreach($listalldatatempavg as $row){ 
                        $value=$row[0];
                        echo("<th></th><th></th><th></th><th></th><th>$value</th><th></th>");                    
                    };               
                ?>
                
                
               </tr>
               
                <tr>
                <td>Durchschnitts-Taupunkttemperatur</td>
                
                <?php                
                    foreach($listalldatameltavg as $row){ 
                        $value=$row[0];
                        echo("<th></th><th></th><th></th><th></th><th>$value</th><th></th>");                    
                    };               
                ?>
                
                
               </tr>
               
              
               
               
               <tr>
                <td>Ältester Datensatz</td>
                
                
                <?php             
                    foreach($listmindateml as $row){ 
                        $value=$row[0];
                        echo("<th>$value</th><th></th>");                    
                    };
                    foreach($listmindatepf as $row){ 
                        $value=$row[0];
                        echo("<th>$value</th><th></th>");                    
                    };
                ?>
                
               </tr>
               <tr>
                <td>Jüngster Datensatz</td>
                <?php
                    foreach($listmaxdateml as $row){ 
                        $value=$row[0];
                        echo("<th>$value</th><th></th>");                    
                    }; 
                    foreach($listmaxdatepf as $row){ 
                        $value=$row[0];
                        echo("<th>$value</th><th></th>");                    
                    };  
                ?>
               </tr>
            </table>
        </div>
    </center>
