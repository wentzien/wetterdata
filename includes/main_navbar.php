<div id="menupanel" data-role="panel" data-display="overlay">
    <a href="?task=home" data-role="button" data-icon="home" data-theme="b" data-ajax="false" >Home</a>
    <a href="?task=heute" data-role="button" data-icon="cloud" data-theme="b" data-ajax="false" >Heute</a>
    <a href="?task=historie" data-role="button" data-icon="calendar" data-theme="b" data-ajax="false" >Historie</a>
    <a href="?task=statistik" data-role="button" data-icon="info" data-theme="b" data-ajax="false" >Statistik</a>
    
    
    
    

    <?php
    $uID=Core::$user->m_oid;
    if ($uID <>""){
        $pdo = Core::$pdo;
        
    ?>    
<a href="?task=editfav" data-role="button" data-icon="gear" data-theme="b" data-ajax="false" >Edit Favoriten</a>

    <?php
    $SQLaddfav = "SELECT * FROM favoriten LEFT JOIN Stationen ON favoriten.Stationid = Stationen.ID Where UserID=$uID";
    $ufavs=$pdo->query($SQLaddfav);
    ?>
    
    
        
    
    

         <?php
        foreach ($ufavs as $station){
            ?>
            <form action="?task=heute" method="post" data-ajax='false'>
                <?php 
//                $ausgewStat=array();
//                $ausgewStat[0]=$station['id'];
                ?>
            <input type="hidden" id="stat" name="ausgewStation" value="<?=$station['id']?>">
            <input type="hidden" id="taskkenner" name="taskerkenner" value="favorit">
            <input type="submit" name="station" data-icon="heart" value="<?=$station['stationsname']?>">
            </form>
            
            <?php            
        }
            
    }?>
    
</div>




<!--<a href="?task=heute" data-role="button" data-icon="heart" data-theme="b" data-ajax="false">
         <?php
        foreach ($Ufavs as $station){
            echo("<option value=".$station['id']." >".$station['stationsname']."</option>\n");
        }?>
</a>-->