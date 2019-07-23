<?php

$user=Core::$user;
if($user->vorname!=""){
    $willkommen= "Willkommen ".$user->vorname;
    } 
?>

<center><label><h1><?php echo("$willkommen, füge hier weitere Stationen zu deinen Favoriten hinzu") ?></h1></label></center>


<form action="?task=editfav" method="post">
<select name="addfav">
<?php
$allStat=core::$view->allStat;
foreach ($allStat as $station){
echo("<option value=".$station['id']." >".$station['stationsname']."</option>\n");
}
?>
</select>
    
<input type="submit" name="editfav" value="Station hinzufügen">
</form>



<center><label><h1><?php echo("Oder entferne Stationen aus deiner Favoritenliste") ?></h1></label></center>


<form action="?task=editfav" method="post">
<select name="delfav">
<?php
$allfavs=core::$view->allfavs;
foreach ($allfavs as $station){
echo("<option value=".$station['id']." >".$station['stationsname']."</option>\n");
}
?>
</select>
<input type="submit" name="editfav" value="Station entfernen">

</form>






<form id="stationsearch" method="post" action="?task=editfav" data-ajax="true">
	<div class="ui-field-contain">
            <label for="stationname">Stationsname:</label><input id="Stationsname" placeholder="Suchen" name="stationname" onkeyup="ajaxpost(this, 'editfav', 'view2')"/>    
        </div>
</form>








