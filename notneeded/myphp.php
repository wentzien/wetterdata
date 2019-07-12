<?php
$station="03925";
$url = "https://opendata.dwd.de/climate_environment/CDC/observations_germany/climate/10_minutes/air_temperature/now/10minutenwerte_TU_".$station."_now.zip";
$local_zip_file1 = (parse_url($url, PHP_URL_PATH));
$local_zip_file2=basename($local_zip_file1);

?>

<!DOCTYPE html>
<html>

<p> <?php echo($local_zip_file1) ?> </p><br>
<p> <?php echo($local_zip_file2) ?> </p>

<br>
<br>

</html>