<?php
 /* @var $user User */
$listtemp=Core::$view->listtemp;
$listpress=Core::$view->listpress;
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
  </div>
    <div id="three" class="ui-body-d ui-content">
        
          </div>
</div>
           