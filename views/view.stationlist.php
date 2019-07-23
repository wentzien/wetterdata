<?php
$liste=Core::$view->station;
?>
<table data-role="table" id="allstations" data-mode="column-toggle: none" class="ui-responsive">
  <thead>
    <tr>     
      <th data-priority="persist">Stationname</th>
    </tr>
  </thead>
  <tbody>
  <?php
/* @var $item User */
  foreach($liste as $item){
     
   ?>
<tr>
      <td><?=$item['id']?></td>  
      <td><?=$item['stationsname']?></td>     
      <td>
          <form action="?task=editfav" method="post">
              <input type=hidden name="addfav" value="<?=$item['id']?>">
        <input type="submit" name="editfav" value="Station hinzufügen">
        </form>
      </td>
     
</tr>
<?php }
?>
  </tbody>
</table>

