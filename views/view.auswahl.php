<form action="?task=heute" method="post" data-ajax='false'>
<select name="ausgewStation">
<?php
$ausgewStat=core::$view->ausgewStat;
foreach ($ausgewStat as $as){
echo("<option value=".$as['id']." >".$as['stationsname']."</option>\n");
}
?>
<br>
<input type="submit" name="anzeigen" value="Anzeigen">
</select>

<?php echo("Die ID der ausgewählten Station: ".$dieStation=core::$view->dieStation); ?>
