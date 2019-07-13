<?php
$pdo = Core::$pdo;
$SQLallStat="select * from Stationen WHERE BL='BW' Order by stationsname";
$allStat=$pdo->query($SQLallStat);
Core::$view->allStat=$allStat;
Core::$view->path["view1"]="views/view.editfav.php";
