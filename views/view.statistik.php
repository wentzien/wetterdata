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
               <td>Heißester <strong style="color:green">Frühling</strong> (Durchschnitt)</td>
           </tr>
           <tr>
            <td>Kältester <strong style="color:green">Frühling</strong> (Durchschnitt)</td>
           </tr>
           <tr>
            <td>Höchste Messung im <strong style="color:green">Frühling</strong></td>
           </tr>
           <tr>
            <td>Niedrigste Messung im <strong style="color:green">Frühling</strong></td>
           </tr>
           <tr>
            <td>Heißester <strong style="color:red">Sommer</strong> (Durchschnitt)</td>
           </tr>
           <tr>
            <td>Kältester <strong style="color:red">Sommer</strong> (Durchschnitt)</td>
           </tr>
           <tr>
            <td>Höchste Messung im <strong style="color:red">Sommer</strong></td>
           </tr>
           <tr>
            <td>Niedrigste Messung im <strong style="color:red">Sommer</strong></td>
           </tr>
           <tr>
            <td>Heißester <strong style="color:orange">Herbst</strong> (Durchschnitt)</td>
           </tr>
           <tr>
            <td>Kältester <strong style="color:orange">Herbst</strong> (Durchschnitt)</td>
           </tr>
           <tr>
            <td>Höchste Messung im <strong style="color:orange">Herbst</strong></td>
           </tr>
           <tr>
            <td>Niedrigste Messung im <strong style="color:orange">Herbst</strong></td>
           </tr>
           <tr>
            <td>Heißester <strong style="color:blue">Winter</strong> (Durchschnitt)</td>
           </tr>
           <tr>
            <td>Kältester <strong style="color:blue">Winter</strong> (Durchschnitt)</td>
           </tr>
           <tr>
            <td>Höchste Messung im <strong style="color:blue">Winter</strong></td>
           </tr>
           <tr>
            <td>Niedrigste Messung im <strong style="color:blue">Winter</strong></td>
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
