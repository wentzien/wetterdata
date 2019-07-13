<?php

$user=Core::$user;
if($user->vorname!=""){
    $willkommen= "Willkommen ".$user->vorname;
    } 
?>

<center><label><h1><?php echo("$willkommen füge hier weitere Stationen zu deinen Favoriten hinzu") ?></h1></label></center>


<form action="?task=editfav" method="post">
<select name="ausgewStation">
<?php
$allStat=core::$view->allStat;
foreach ($allStat as $station){
echo("<option value=".$station['id']." >".$station['stationsname']."</option>\n");
}
?>



</select>
<input type="submit" name="editfav" value="Station hinzufügen">


