<?php
 /* @var $user User */

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
<center><label><h3><?php echo($loggedichein) ?></h3></label></center>


<form action="?task=home" method="post">
Lege deine Lieblingswetterstation fest:
<select name="ausgewStation">
<?php
$ausgewStat=core::$view->ausgewStat;
foreach ($ausgewStat as $as){
echo("<option value=".$as['id']." >".$as['stationsname']."</option>\n");
}
?>



</select>
<input type="submit" name="anzeigen" value="Anzeigen">
<br>
<div>    
<label> Ausgewählte Station als Heimat festlegen:</label>
<input type="checkbox" name="saveasfav" value="ON"/>
<br>
</div>

<?php 
echo("Die ID der ausgewählten Station: ".$dieStation=core::$view->dieStation);
$homewetter=core::$user->homewetter;
echo("Aktuell ausgewählte Station: ".$homewetter);
$i=5;
?>
