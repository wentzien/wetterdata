<div data-role="header" data-theme="b">
    <h1>Vergleiche die Stationen bis ins Detail</h1>
</div>

<!--Ortsauswahl-->
<!--Datumsfilterung-->

<form action="?task=statistik" method="post" data-ajax='false'>
    <select name="ausgewStation[]" id="select-custom-24" data-native-menu="false" multiple="multiple" data-iconpos="left">
        <option>Ortsauswahl</option>
        <?php
        $ausgewStat=core::$view->ausgewStat;
        foreach ($ausgewStat as $as){
        echo("<option value=".$as['id']." >".$as['stationsname']."</option>\n");
        }
        ?>
    </select>
    <input type="hidden" name="taskerkenner"  id="taskerkenner" value="historie"/>
    <label for="datumVon">Zeitraum von:</label>
    <input type="date" name="datumVon" id="datumVon" value="<?=core::$view->datumVon ?>"/>
    <label for="datumVon">Zeitraum bis:</label>
    <input type="date" name="datumBis" id="datumBis" value="<?=core::$view->datumBis ?>"/>
    <input type="submit" name="anzeigen" value="Anzeigen">
</form>

<div data-role="header" data-theme="b">
    <h1>Die Statistik über den ausgewählten Zeitraum</h1>
</div>
<center>
    <div class="ui-body ui-body-a">
      <table class="ui-responsive" cellpadding="10">
          <tr>
            <th></th>
            <!--Stationsnamen in die Tabelle schreiben-->
            <?php
                $length=core::$view->length;
                for($t=0; $t<$length; $t++){
                $row="";
                $stationNameTabelle="stationTabelle$t";
                $stationTabelle=core::$view->$stationNameTabelle;
                foreach($stationTabelle as $row){
                $stationNT=$row['stationsname'];
                echo("<th>$stationNT</th><th></th>");
                }
                }
            ?>
          </tr>
          <tr>
            <td>Aktuellster Temperaturwert</td>
            <?php
            for($t=0; $t<$length; $t++){
                $row="";
                $NameAktTemp="aktTemp$t";
                $AktTemp=core::$view->$NameAktTemp;
                foreach($AktTemp as $row){
                $akttemp=$row['temp20'];
                $akttempZeit=$row['ts'];
                $akttempZeitrest = substr($akttempZeit, 0, -9);
                echo("<td><strong>$akttemp °C</strong></td><td>$akttempZeitrest</td>");
                }
                }
            ?>
           </tr>
           <tr>
            <td>Temperaturdurchschnitt</td>
            <?php
            for($t=0; $t<$length; $t++){
                $row="";
                $NameAvgTemp="avgTemp$t";
                $AvgTemp=core::$view->$NameAvgTemp;
                foreach($AvgTemp as $row){
                $avgtemp=$row['AVG(temp20)'];
                $avgtempRound=round( $avgtemp, 2, PHP_ROUND_HALF_UP);
                echo("<td><strong>$avgtempRound °C</strong></td><td>-</td>");
                }
                }
            ?>
           </tr>
           <tr>
            <td>Max-Temperatur</td>
            <?php
            for($t=0; $t<$length; $t++){
                $row="";
                $NameMaxTemp="maxTemp$t";
                $MaxTemp=core::$view->$NameMaxTemp;
                foreach($MaxTemp as $row){
                $maxtemp=$row['temp20'];
                $maxtempZeit=$row['ts'];
                $maxtempZeitrest = substr($maxtempZeit, 0, -9);
                $maxtempRound=round( $maxtemp, 2, PHP_ROUND_HALF_UP);
                echo("<td><strong>$maxtempRound °C</strong></td><td>$maxtempZeitrest</td>");
                }
                }
            ?>
           </tr>
           <tr>
            <td>Min-Temperatur</td>
            <?php
            for($t=0; $t<$length; $t++){
                $row="";
                $NameMinTemp="minTemp$t";
                $MinTemp=core::$view->$NameMinTemp;
                foreach($MinTemp as $row){
                $mintemp=$row['temp20'];
                $mintempZeit=$row['ts'];
                $mintempZeitrest = substr($mintempZeit, 0, -9);
                $mintempRound=round( $mintemp, 2, PHP_ROUND_HALF_UP);
                echo("<td><strong>$mintempRound °C</strong></td><td>$mintempZeitrest</td>");
                }
                }
            ?>
           </tr>
           <tr>
            <td>Durchschnitts-Luftdruck</td>
            <?php
            for($t=0; $t<$length; $t++){
                $row="";
                $NameAvgDruck="avgDruck$t";
                $AvgDruck=core::$view->$NameAvgDruck;
                foreach($AvgDruck as $row){
                $avgdruck=$row['AVG(Luftdruck)'];
                $avgdruckRound=round( $avgdruck, 2, PHP_ROUND_HALF_UP);
                if($avgdruckRound<=-999){
                    $avgdruckRound="N/A";
                }
                echo("<td><strong>$avgdruckRound hPa</strong></td><td>-</td>");
                }
                }
            ?>
           </tr>
           <tr>
            <td>Max-Luftdruck</td>
            <?php
            for($t=0; $t<$length; $t++){
                $row="";
                $NameMaxDruck="maxDruck$t";
                $MaxDruck=core::$view->$NameMaxDruck;
                foreach($MaxDruck as $row){
                $maxdruck=$row['Luftdruck'];
                $maxdruckZeit=$row['ts'];
                $maxdruckZeitrest = substr($maxdruckZeit, 0, -9);
                $maxdruckRound=round( $maxdruck, 2, PHP_ROUND_HALF_UP);
                echo("<td><strong>$maxdruckRound hPa</strong></td><td>$maxdruckZeitrest</td>");
                }
                }
            ?>
           </tr>
           <tr>
            <td>Min-Luftdruck</td>
            <?php
            for($t=0; $t<$length; $t++){
                $row="";
                $NameMinDruck="minDruck$t";
                $MinDruck=core::$view->$NameMinDruck;
                foreach($MinDruck as $row){
                $mindruck=$row['Luftdruck'];
                $mindruckZeit=$row['ts'];
                $mindruckZeitrest = substr($mindruckZeit, 0, -9);
                $mindruckRound=round( $mindruck, 2, PHP_ROUND_HALF_UP);
                echo("<td><strong>$mindruckRound hPa</strong></td><td>$mindruckZeitrest</td>");
                }
                }
            ?>
           </tr>
           <tr>
            <td>Durchschnitts-Luftfeuchtigkeit</td>
            <?php
            for($t=0; $t<$length; $t++){
                $row="";
                $NameAvgFeuchte="avgFeuchte$t";
                $AvgFeuchte=core::$view->$NameAvgFeuchte;
                foreach($AvgFeuchte as $row){
                $avgfeuchte=$row['AVG(feuchte)'];
                $avgfeuchteRound=round( $avgfeuchte, 2, PHP_ROUND_HALF_UP);
                echo("<td><strong>$avgfeuchteRound %</strong></td><td>-</td>");
                }
                }
            ?>
           </tr>
           <tr>
            <td>Max-Luftfeuchtigkeit</td>
            <?php
            for($t=0; $t<$length; $t++){
                $row="";
                $NameMaxFeuchte="maxFeuchte$t";
                $MaxFeuchte=core::$view->$NameMaxFeuchte;
                foreach($MaxFeuchte as $row){
                $maxfeuchte=$row['feuchte'];
                $maxfeuchteZeit=$row['ts'];
                $maxfeuchteZeitrest = substr($maxfeuchteZeit, 0, -9);
                $maxfeuchteRound=round( $maxfeuchte, 2, PHP_ROUND_HALF_UP);
                echo("<td><strong>$maxfeuchteRound %</strong></td><td>$maxfeuchteZeitrest</td>");
                }
                }
            ?>
           </tr>
           <tr>
            <td>Min-Luftfeuchtigkeit</td>
            <?php
            for($t=0; $t<$length; $t++){
                $row="";
                $NameMinFeuchte="minFeuchte$t";
                $MinFeuchte=core::$view->$NameMinFeuchte;
                foreach($MinFeuchte as $row){
                $minfeuchte=$row['feuchte'];
                $minfeuchteZeit=$row['ts'];
                $minfeuchteZeitrest = substr($minfeuchteZeit, 0, -9);
                $minfeuchteRound=round( $minfeuchte, 2, PHP_ROUND_HALF_UP);
                echo("<td><strong>$minfeuchteRound %</strong></td><td>$minfeuchteZeitrest</td>");
                }
                }
            ?>
           </tr>
           <tr>
            <td>Durchschnitts-Taupunkttemperatur</td>
            <?php
            for($t=0; $t<$length; $t++){
                $row="";
                $NameAvgTau="avgTau$t";
                $AvgTau=core::$view->$NameAvgTau;
                foreach($AvgTau as $row){
                $avgtau=$row['AVG(taupunkt)'];
                $avgtauRound=round( $avgtau, 2, PHP_ROUND_HALF_UP);
                echo("<td><strong>$avgtauRound °C</strong></td><td>-</td>");
                }
                }
            ?>
           </tr>
           <tr>
            <td>Max-Taupunkttemperatur</td>
            <?php
            for($t=0; $t<$length; $t++){
                $row="";
                $NameMaxTau="maxTau$t";
                $MaxTau=core::$view->$NameMaxTau;
                foreach($MaxTau as $row){
                $maxtau=$row['taupunkt'];
                $maxtauZeit=$row['ts'];
                $maxtauZeitrest = substr($maxtauZeit, 0, -9);
                $maxtauRound=round( $maxtau, 2, PHP_ROUND_HALF_UP);
                echo("<td><strong>$maxtauRound °C</strong></td><td>$maxtauZeitrest</td>");
                }
                }
            ?>
           </tr>
           <tr>
            <td>Min-Taupunkttemperatur</td>
            <?php
            for($t=0; $t<$length; $t++){
                $row="";
                $NameMinTau="minTau$t";
                $MinTau=core::$view->$NameMinTau;
                foreach($MinTau as $row){
                $mintau=$row['taupunkt'];
                $mintauZeit=$row['ts'];
                $mintauZeitrest = substr($mintauZeit, 0, -9);
                $mintauRound=round( $mintau, 2, PHP_ROUND_HALF_UP);
                echo("<td><strong>$mintauRound °C</strong></td><td>$mintauZeitrest</td>");
                }
                }
            ?>
           </tr>
           <tr>
            <td>Durchschnitts-Niederschlagsmenge</td>
            <?php
            for($t=0; $t<$length; $t++){
                $row="";
                $NameAvgRegen="avgRegen$t";
                $AvgRegen=core::$view->$NameAvgRegen;
                foreach($AvgRegen as $row){
                $avgregen=$row['AVG(RS)'];
                $avgregenRound=round( $avgregen, 2, PHP_ROUND_HALF_UP);
                echo("<td><strong>$avgregenRound mm/m²</strong></td><td>-</td>");
                }
                }
            ?>
           </tr>
           <tr>
            <td>Max-Niederschlagsmenge</td>
            <?php
            for($t=0; $t<$length; $t++){
                $row="";
                $NameMaxRegen="maxRegen$t";
                $MaxRegen=core::$view->$NameMaxRegen;
                foreach($MaxRegen as $row){
                $maxregen=$row['RS'];
                $maxregenZeit=$row['ts'];
                $maxregenZeitrest = substr($maxregenZeit, 0, -9);
                $maxregenRound=round( $maxregen, 2, PHP_ROUND_HALF_UP);
                echo("<td><strong>$maxregenRound mm/m²</strong></td><td>$maxregenZeitrest</td>");
                }
                }
            ?>
           </tr>
           <tr>
            <td>Min-Niederschlagsmenge</td>
            <?php
            for($t=0; $t<$length; $t++){
                $row="";
                $NameMinRegen="minRegen$t";
                $MinRegen=core::$view->$NameMinRegen;
                foreach($MinRegen as $row){
                $minregen=$row['RS'];
                $minregenZeit=$row['ts'];
                $minregenZeitrest = substr($minregenZeit, 0, -9);
                $minregenRound=round( $minregen, 2, PHP_ROUND_HALF_UP);
                echo("<td><strong>$minregenRound mm/m²</strong></td><td>$minregenZeitrest</td>");
                }
                }
            ?>
           </tr>
        </table>
    </div>
</center>

<div data-role="header" data-theme="b">
    <h1>Statistik in Bezug auf alle erfassten Wetterdaten nach <strong>Jahrezeiten</strong></h1>
</div>
<center>
    <div class="ui-body ui-body-a">
      <table class="ui-responsive" cellpadding="10">
          <tr>
            <th>Temperaturstatistik</th>
            <!--Stationsnamen in die Tabelle schreiben-->
            <?php
                for($t=0; $t<$length; $t++){
                $row="";
                $stationNameNiederschlag="stationNiederschlag$t";
                $stationNiederschlag=core::$view->$stationNameNiederschlag;
                foreach($stationNiederschlag as $row){
                $stationNN=$row['stationsname'];
                echo("<th>$stationNN</th><th></th>");
                }
                }
            ?>
          </tr>
           <tr>
               <td>Heißester <strong style="color:green">Frühling</strong> (Durchschnitt)</td>
                <?php
                for($t=0; $t<$length; $t++){
                    $row="";
                    $NameHotF="hotF$t";
                    $HotF=core::$view->$NameHotF;
                    foreach($HotF as $row){
                    $hotf=$row['average'];
                    $hotfZeit=$row['ts'];
                    $hotfZeitrest = substr($hotfZeit, 0, -15);
                    $hotfRound=round( $hotf, 2, PHP_ROUND_HALF_UP);
                    echo("<td><strong>$hotfRound °C</strong></td><td>$hotfZeitrest</td>");
                    }
                    }
                ?>
           </tr>
           <tr>
            <td>Kältester <strong style="color:green">Frühling</strong> (Durchschnitt)</td>
            <?php
                for($t=0; $t<$length; $t++){
                    $row="";
                    $NameColdF="coldF$t";
                    $ColdF=core::$view->$NameColdF;
                    foreach($ColdF as $row){
                    $coldf=$row['average'];
                    $coldfZeit=$row['ts'];
                    $coldfZeitrest = substr($coldfZeit, 0, -15);
                    $coldfRound=round( $coldf, 2, PHP_ROUND_HALF_UP);
                    echo("<td><strong>$coldfRound °C</strong></td><td>$coldfZeitrest</td>");
                    }
                    }
                ?>
           </tr>
           <tr>
            <td>Höchste Messung im <strong style="color:green">Frühling</strong></td>
                <?php
                for($t=0; $t<$length; $t++){
                    $row="";
                    $NameHighF="highF$t";
                    $HighF=core::$view->$NameHighF;
                    foreach($HighF as $row){
                    $highf=$row['average'];
                    $highfZeit=$row['ts'];
                    $highfZeitrest = substr($highfZeit, 0, -15);
                    $highfRound=round( $highf, 2, PHP_ROUND_HALF_UP);
                    echo("<td><strong>$highfRound °C</strong></td><td>$highfZeitrest</td>");
                    }
                    }
                ?>
           </tr>
           <tr>
            <td>Niedrigste Messung im <strong style="color:green">Frühling</strong></td>
                <?php
                for($t=0; $t<$length; $t++){
                    $row="";
                    $NameLowF="lowF$t";
                    $LowF=core::$view->$NameLowF;
                    foreach($LowF as $row){
                    $lowf=$row['average'];
                    $lowfZeit=$row['ts'];
                    $lowfZeitrest = substr($lowfZeit, 0, -15);
                    $lowfRound=round( $lowf, 2, PHP_ROUND_HALF_UP);
                    echo("<td><strong>$lowfRound °C</strong></td><td>$lowfZeitrest</td>");
                    }
                    }
                ?>
           </tr>
           <tr>
            <td>Heißester <strong style="color:red">Sommer</strong> (Durchschnitt)</td>
                <?php
                for($t=0; $t<$length; $t++){
                    $row="";
                    $NameHotS="hotS$t";
                    $HotS=core::$view->$NameHotS;
                    foreach($HotS as $row){
                    $hots=$row['average'];
                    $hotsZeit=$row['ts'];
                    $hotsZeitrest = substr($hotsZeit, 0, -15);
                    $hotsRound=round( $hots, 2, PHP_ROUND_HALF_UP);
                    echo("<td><strong>$hotsRound °C</strong></td><td>$hotsZeitrest</td>");
                    }
                    }
                ?>
           </tr>
           <tr>
            <td>Kältester <strong style="color:red">Sommer</strong> (Durchschnitt)</td>
            <?php
                for($t=0; $t<$length; $t++){
                    $row="";
                    $NameColdS="coldS$t";
                    $ColdS=core::$view->$NameColdS;
                    foreach($ColdS as $row){
                    $colds=$row['average'];
                    $coldsZeit=$row['ts'];
                    $coldsZeitrest = substr($coldsZeit, 0, -15);
                    $coldsRound=round( $colds, 2, PHP_ROUND_HALF_UP);
                    echo("<td><strong>$coldsRound °C</strong></td><td>$coldsZeitrest</td>");
                    }
                    }
                ?>
           </tr>
           <tr>
            <td>Höchste Messung im <strong style="color:red">Sommer</strong></td>
            <?php
                for($t=0; $t<$length; $t++){
                    $row="";
                    $NameHighS="highS$t";
                    $HighS=core::$view->$NameHighS;
                    foreach($HighS as $row){
                    $highs=$row['average'];
                    $highsZeit=$row['ts'];
                    $highsZeitrest = substr($highsZeit, 0, -15);
                    $highsRound=round( $highs, 2, PHP_ROUND_HALF_UP);
                    echo("<td><strong>$highsRound °C</strong></td><td>$highsZeitrest</td>");
                    }
                    }
                ?>
           </tr>
           <tr>
            <td>Niedrigste Messung im <strong style="color:red">Sommer</strong></td>
            <?php
                for($t=0; $t<$length; $t++){
                    $row="";
                    $NameLowS="lowS$t";
                    $LowS=core::$view->$NameLowS;
                    foreach($LowS as $row){
                    $lows=$row['average'];
                    $lowsZeit=$row['ts'];
                    $lowsZeitrest = substr($lowsZeit, 0, -15);
                    $lowsRound=round( $lows, 2, PHP_ROUND_HALF_UP);
                    echo("<td><strong>$lowsRound °C</strong></td><td>$lowsZeitrest</td>");
                    }
                    }
                ?>
           </tr>
           <tr>
            <td>Heißester <strong style="color:orange">Herbst</strong> (Durchschnitt)</td>
            <?php
                for($t=0; $t<$length; $t++){
                    $row="";
                    $NameHotH="hotH$t";
                    $HotH=core::$view->$NameHotH;
                    foreach($HotH as $row){
                    $hoth=$row['average'];
                    $hothZeit=$row['ts'];
                    $hothZeitrest = substr($hothZeit, 0, -15);
                    $hothRound=round( $hoth, 2, PHP_ROUND_HALF_UP);
                    echo("<td><strong>$hothRound °C</strong></td><td>$hothZeitrest</td>");
                    }
                    }
                ?>
           </tr>
           <tr>
            <td>Kältester <strong style="color:orange">Herbst</strong> (Durchschnitt)</td>
            <?php
                for($t=0; $t<$length; $t++){
                    $row="";
                    $NameColdH="coldH$t";
                    $ColdH=core::$view->$NameColdH;
                    foreach($ColdH as $row){
                    $coldh=$row['average'];
                    $coldhZeit=$row['ts'];
                    $coldhZeitrest = substr($coldhZeit, 0, -15);
                    $coldhRound=round( $coldh, 2, PHP_ROUND_HALF_UP);
                    echo("<td><strong>$coldhRound °C</strong></td><td>$coldhZeitrest</td>");
                    }
                    }
                ?>
           </tr>
           <tr>
            <td>Höchste Messung im <strong style="color:orange">Herbst</strong></td>
            <?php
                for($t=0; $t<$length; $t++){
                    $row="";
                    $NameHighH="highH$t";
                    $HighH=core::$view->$NameHighH;
                    foreach($HighH as $row){
                    $highh=$row['average'];
                    $highhZeit=$row['ts'];
                    $highhZeitrest = substr($highhZeit, 0, -15);
                    $highhRound=round( $highh, 2, PHP_ROUND_HALF_UP);
                    echo("<td><strong>$highhRound °C</strong></td><td>$highhZeitrest</td>");
                    }
                    }
                ?>
           </tr>
           <tr>
            <td>Niedrigste Messung im <strong style="color:orange">Herbst</strong></td>
            <?php
                for($t=0; $t<$length; $t++){
                    $row="";
                    $NameLowH="lowH$t";
                    $LowH=core::$view->$NameLowH;
                    foreach($LowH as $row){
                    $lowh=$row['average'];
                    $lowhZeit=$row['ts'];
                    $lowhZeitrest = substr($lowhZeit, 0, -15);
                    $lowhRound=round( $lowh, 2, PHP_ROUND_HALF_UP);
                    echo("<td><strong>$lowhRound °C</strong></td><td>$lowhZeitrest</td>");
                    }
                    }
                ?>
           </tr>
           <tr>
            <td>Heißester <strong style="color:blue">Winter</strong> (Durchschnitt)</td>
            <?php
                for($t=0; $t<$length; $t++){
                    $row="";
                    $NameHotW="hotW$t";
                    $HotW=core::$view->$NameHotW;
                    foreach($HotW as $row){
                    $hotw=$row['average'];
                    $hotwZeit=$row['ts'];
                    $hotwZeitrest = substr($hotwZeit, 0, -15);
                    $hotwRound=round( $hotw, 2, PHP_ROUND_HALF_UP);
                    echo("<td><strong>$hotwRound °C</strong></td><td>$hotwZeitrest</td>");
                    }
                    }
                ?>
           </tr>
           <tr>
            <td>Kältester <strong style="color:blue">Winter</strong> (Durchschnitt)</td>
            <?php
                for($t=0; $t<$length; $t++){
                    $row="";
                    $NameColdW="coldW$t";
                    $ColdW=core::$view->$NameColdW;
                    foreach($ColdW as $row){
                    $coldw=$row['average'];
                    $coldwZeit=$row['ts'];
                    $coldwZeitrest = substr($coldwZeit, 0, -15);
                    $coldwRound=round( $coldw, 2, PHP_ROUND_HALF_UP);
                    echo("<td><strong>$coldwRound °C</strong></td><td>$coldwZeitrest</td>");
                    }
                    }
                ?>
           </tr>
           <tr>
            <td>Höchste Messung im <strong style="color:blue">Winter</strong></td>
            <?php
                for($t=0; $t<$length; $t++){
                    $row="";
                    $NameHighW="highW$t";
                    $HighW=core::$view->$NameHighW;
                    foreach($HighW as $row){
                    $highw=$row['average'];
                    $highwZeit=$row['ts'];
                    $highwZeitrest = substr($highwZeit, 0, -15);
                    $highwRound=round( $highw, 2, PHP_ROUND_HALF_UP);
                    echo("<td><strong>$highwRound °C</strong></td><td>$highwZeitrest</td>");
                    }
                    }
                ?>
           </tr>
           <tr>
            <td>Niedrigste Messung im <strong style="color:blue">Winter</strong></td>
            <?php
                for($t=0; $t<$length; $t++){
                    $row="";
                    $NameLowW="lowW$t";
                    $LowW=core::$view->$NameLowW;
                    foreach($LowW as $row){
                    $loww=$row['average'];
                    $lowwZeit=$row['ts'];
                    $lowwZeitrest = substr($lowwZeit, 0, -15);
                    $lowwRound=round( $loww, 2, PHP_ROUND_HALF_UP);
                    echo("<td><strong>$lowwRound °C</strong></td><td>$lowwZeitrest</td>");
                    }
                    }
                ?>
           </tr>
        </table>
    </div>
</center>
<center>
    <div class="ui-body ui-body-a">
      <table class="ui-responsive" cellpadding="10">
          <tr>
            <th>Niederschlagsstatistik</th>
            <!--Stationsnamen in die Tabelle schreiben-->
            <?php
                for($t=0; $t<$length; $t++){
                $row="";
                $stationNameTabelle="stationTabelle$t";
                $stationTabelle=core::$view->$stationNameTabelle;
                foreach($stationTabelle as $row){
                $stationNT=$row['stationsname'];
                echo("<th>$stationNT</th><th></th>");
                }
                }
            ?>
          </tr>
           <tr>
            <td>Menge im <strong style="color:green">Frühling</strong> (Durchschnitt)</td>
           </tr> 
           <tr>
            <td>Regnerischste Tag im <strong style="color:green">Frühling</strong></td>
           </tr>
           <tr>
            <td>Längste Trockenzeit im <strong style="color:green">Frühling</strong></td>
           </tr>
           <tr>
            <td>Menge im <strong style="color:red">Sommer</strong> (Durchschnitt)</td>
           </tr> 
           <tr>
            <td>Regnerischste Tag im <strong style="color:red">Sommer</strong></td>
           </tr>
           <tr>
            <td>Längste Trockenzeit im <strong style="color:red">Sommer</strong></td>
           </tr>
           <tr>
            <td>Menge im <strong style="color:orange">Herbst</strong> (Durchschnitt)</td>
           </tr> 
           <tr>
            <td>Regnerischste Tag im <strong style="color:orange">Herbst</strong></td>
           </tr>
           <tr>
            <td>Längste Trockenzeit im <strong style="color:orange">Herbst</strong></td>
           </tr>
           <tr>
            <td>Menge im <strong style="color:blue">Winter</strong> (Durchschnitt)</td>
           </tr> 
           <tr>
            <td>Regnerischste Tag im <strong style="color:blue">Winter</strong></td>
           </tr>
           <tr>
            <td>Längste Trockenzeit im <strong style="color:blue">Winter</strong></td>
           </tr>
        </table>
    </div>
</center>
