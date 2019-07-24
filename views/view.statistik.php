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
           </tr>
           <tr>
            <td>Min-Luftdruck</td>
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
           </tr>
           <tr>
            <td>Min-Luftdruck</td>
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
           </tr>
           <tr>
            <td>Min-Luftdruck</td>
           </tr>
           <tr>
            <td>Durchschnitts-Niederschlagsmenge</td>
           </tr>
           <tr>
            <td>Max-Niederschlagsmenge</td>
           </tr>
           <tr>
            <td>Min-Niederschlagsmenge</td>
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
            <td>Heißester Frühling (Durchschnitt)</td>
           </tr>
           <tr>
            <td>Kältester Frühling (Durchschnitt)</td>
           </tr>
           <tr>
            <td>Höchste Messung im Frühling</td>
           </tr>
           <tr>
            <td>Niedrigste Messung im Frühling</td>
           </tr>
           <tr>
            <td>Heißester Sommer (Durchschnitt)</td>
           </tr>
           <tr>
            <td>Kältester Sommer (Durchschnitt)</td>
           </tr>
           <tr>
            <td>Höchste Messung im Sommer</td>
           </tr>
           <tr>
            <td>Niedrigste Messung im Sommer</td>
           </tr>
           <tr>
            <td>Heißester Herbst (Durchschnitt)</td>
           </tr>
           <tr>
            <td>Kältester Herbst (Durchschnitt)</td>
           </tr>
           <tr>
            <td>Höchste Messung im Herbst</td>
           </tr>
           <tr>
            <td>Niedrigste Messung im Herbst</td>
           </tr>
           <tr>
            <td>Heißester Winter (Durchschnitt)</td>
           </tr>
           <tr>
            <td>Kältester Winter (Durchschnitt)</td>
           </tr>
           <tr>
            <td>Höchste Messung im Winter</td>
           </tr>
           <tr>
            <td>Niedrigste Messung im Winter</td>
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
            <td>Menge im Frühling (Durchschnitt)</td>
           </tr> 
           <tr>
            <td>Regnerischste Tag im Frühling</td>
           </tr>
           <tr>
            <td>Längste Trockenzeit im Frühling</td>
           </tr>
           <tr>
            <td>Menge im Sommer (Durchschnitt)</td>
           </tr> 
           <tr>
            <td>Regnerischste Tag im Sommer</td>
           </tr>
           <tr>
            <td>Längste Trockenzeit im Sommer</td>
           </tr>
           <tr>
            <td>Menge im Herbst (Durchschnitt)</td>
           </tr> 
           <tr>
            <td>Regnerischste Tag im Herbst</td>
           </tr>
           <tr>
            <td>Längste Trockenzeit im Herbst</td>
           </tr>
           <tr>
            <td>Menge im Winter (Durchschnitt)</td>
           </tr> 
           <tr>
            <td>Regnerischste Tag im Winter</td>
           </tr>
           <tr>
            <td>Längste Trockenzeit im Winter</td>
           </tr>
        </table>
    </div>
</center>
