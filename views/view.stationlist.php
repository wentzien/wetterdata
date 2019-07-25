<?php
$liste=Core::$view->station;
?>
<center>
    <div class="ui-body ui-body-a">
<table data-role="table" id="allstations" data-mode="column-toggle: none" class="ui-body ui-body-a ui-responsive">
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
        
      <td><?=$item['statname']?></td>     
      <td>
          <form action="?task=editfav" method="post">
              <input type=hidden name="addfav" value="<?=$item['statid']?>">
              <input type=hidden name="statname" value="<?=$item['statname']?>">
        <input type="submit" name="editfav" value="Hinzufügen" class="ui-body ui-body-a ui-icon-check ui-responsive">
        </form>
      </td>
     
</tr>
<?php }
?>
  </tbody>
</table>
        </div>
</center>


