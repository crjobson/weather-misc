<?
header('Content-type: text/plain');

$type=$_GET["queryId"];

$username="root";
$password="";
$database="mysql";

mysql_connect(localhost,$username,$password);
@mysql_select_db($database) or die("Unable to select database");

if ($type === "current") {
  $query = "SELECT * FROM weather WHERE ID = (select max(ID) from weather)";
} else if ($type === "dayMax") {
  $start = date('Y-m-d').'T00:00:00';
  $query = "SELECT max(Indoor_Humidity) Indoor_Humidity, max(Indoor_Temp) Indoor_Temp, max(Outdoor_Humidity) Outdoor_Humidity, max(Outdoor_Temp) Outdoor_Temp, max(Abs_Pressure) Abs_Pressure, max(Rel_Pressure) Rel_Pressure, max(Wind_Avg) Wind_Avg, max(Wind_Gust) Wind_Gust FROM weather WHERE Recorded >= '".$start."'";
} else if ($type === "dayMin") {
  $start = date('Y-m-d').'T00:00:00';
  $query = "SELECT min(Indoor_Humidity) Indoor_Humidity, min(Indoor_Temp) Indoor_Temp, min(Outdoor_Humidity) Outdoor_Humidity, min(Outdoor_Temp) Outdoor_Temp, min(Abs_Pressure) Abs_Pressure, min(Rel_Pressure) Rel_Pressure, min(Wind_Avg) Wind_Avg, min(Wind_Gust) Wind_Gust FROM weather WHERE Recorded >= '".$start."'";
} else if ($type === "weekMax") {
  $start = date('Y-m-d', strtotime('last sunday', time())).'T00:00:00';
  $query = "SELECT max(Indoor_Humidity) Indoor_Humidity, max(Indoor_Temp) Indoor_Temp, max(Outdoor_Humidity) Outdoor_Humidity, max(Outdoor_Temp) Outdoor_Temp, max(Abs_Pressure) Abs_Pressure, max(Rel_Pressure) Rel_Pressure, max(Wind_Avg) Wind_Avg, max(Wind_Gust) Wind_Gust FROM weather WHERE Recorded >= '".$start."'";
} else if ($type === "weekMin") {
  $start = date('Y-m-d', strtotime('last sunday', time())).'T00:00:00';
  $query = "SELECT min(Indoor_Humidity) Indoor_Humidity, min(Indoor_Temp) Indoor_Temp, min(Outdoor_Humidity) Outdoor_Humidity, min(Outdoor_Temp) Outdoor_Temp, min(Abs_Pressure) Abs_Pressure, min(Rel_Pressure) Rel_Pressure, min(Wind_Avg) Wind_Avg, min(Wind_Gust) Wind_Gust FROM weather WHERE Recorded >= '".$start."'";
} else if ($type === "yearMax") {
  $start = date('Y').'-01-01T00:00:00';
  $query = "SELECT max(Indoor_Humidity) Indoor_Humidity, max(Indoor_Temp) Indoor_Temp, max(Outdoor_Humidity) Outdoor_Humidity, max(Outdoor_Temp) Outdoor_Temp, max(Abs_Pressure) Abs_Pressure, max(Rel_Pressure) Rel_Pressure, max(Wind_Avg) Wind_Avg, max(Wind_Gust) Wind_Gust FROM weather WHERE Recorded >= '".$start."'";
} else if ($type === "yearMin") {
  $start = date('Y').'-01-01T00:00:00';
  $query = "SELECT min(Indoor_Humidity) Indoor_Humidity, min(Indoor_Temp) Indoor_Temp, min(Outdoor_Humidity) Outdoor_Humidity, min(Outdoor_Temp) Outdoor_Temp, min(Abs_Pressure) Abs_Pressure, min(Rel_Pressure) Rel_Pressure, min(Wind_Avg) Wind_Avg, min(Wind_Gust) Wind_Gust FROM weather WHERE Recorded >= '".$start."'";
} else if ($type === "tempHistory") {
  $start=$_GET["startDate"];
  $end=$_GET["endDate"];
  
  $query = "SELECT * FROM weather WHERE";
  
  if ($start !== null || $end !== null) {
    if ($start === null)
      $query = $query." 1=1";
    else
      $query = $query." Recorded >= '".$start."'";
    $query = $query." AND";
    if ($end === null)
      $query = $query." 1=1";
    else
      $query = $query." Recorded <= '".$end."'";
  } else {
    // return all data
  }
}

// echo $query . PHP_EOL;
  
$result=mysql_query($query);

$num=mysql_numrows($result);

mysql_close();

if ($type === "dayMin" || $type === "weekMin" || $type === "yearMin" || $type === "dayMax" || $type === "weekMax" || $type === "yearMax") {
  $indoor_humidity=mysql_result($result,0,"Indoor_Humidity");
  $indoor_temp=mysql_result($result,0,"Indoor_Temp");
  $outdoor_humidity=mysql_result($result,0,"Outdoor_Humidity");
  $outdoor_temp=mysql_result($result,0,"Outdoor_Temp");
  $rel_pressure=mysql_result($result,0,"Rel_Pressure");
  $abs_pressure=mysql_result($result,0,"Abs_Pressure");
  $wind_avg=mysql_result($result,0,"Wind_Avg");
  $wind_gust=mysql_result($result,0,"Wind_Gust");
  
  echo "{\"Indoor_Temp\": $indoor_temp, \"Indoor_Humidity\": $indoor_humidity, \"Outdoor_Temp\": $outdoor_temp, \"Outdoor_Humidity\": $outdoor_humidity, \"Rel_Pressure\": $rel_pressure, \"Abs_Pressure\": $abs_pressure, \"Wind_Avg\": $wind_avg, \"Wind_Gust\": $wind_gust}".PHP_EOL;
} else {

if ($type !== "current") {
   echo "[".PHP_EOL;
}

$i=0;
while ($i < $num) {

  $id=mysql_result($result,$i,"ID");
  $index=mysql_result($result,$i,"Index");
  $transfer=mysql_result($result,$i,"Transfer");
  $recorded=mysql_result($result,$i,"Recorded");
  $recorded = str_replace(" ", "T", $recorded);
  $reading_interval=mysql_result($result,$i,"Reading_Interval");
  $indoor_humidity=mysql_result($result,$i,"Indoor_Humidity");
  $indoor_temp=mysql_result($result,$i,"Indoor_Temp");
  $outdoor_humidity=mysql_result($result,$i,"Outdoor_Humidity");
  $outdoor_temp=mysql_result($result,$i,"Outdoor_Temp");
  $dew_point=mysql_result($result,$i,"Dew_Point");
  $wind_chill=mysql_result($result,$i,"Wind_Chill");
  $abs_pressure=mysql_result($result,$i,"Abs_Pressure");
  $rel_pressure=mysql_result($result,$i,"Rel_Pressure");
  $wind_avg=mysql_result($result,$i,"Wind_Avg");
  $wind_direction_text=mysql_result($result,$i,"Wind_Direction_Text");
  $wind_gust=mysql_result($result,$i,"Wind_Gust");
  $rain_ticks=mysql_result($result,$i,"Rain_Ticks");
  $rain_total=mysql_result($result,$i,"Rain_Total");
  $rain_since_last=mysql_result($result,$i,"Rain_Since_Last");

  echo "{\"Recorded\": \"$recorded\", \"Indoor_Temp\": $indoor_temp, \"Indoor_Humidity\": $indoor_humidity, \"Outdoor_Temp\": $outdoor_temp, \"Outdoor_Humidity\": $outdoor_humidity, \"Dew_Point\": $dew_point, \"Wind_Chill\": $wind_chill, \"Abs_Pressure\": $abs_pressure, \"Rel_Pressure\": $rel_pressure, \"Wind_Avg\": $wind_avg, \"Wind_Direction_Text\": \"$wind_direction_text\", \"Wind_Gust\": $wind_gust, \"Rain_Ticks\": $rain_ticks, \"Rain_Total\": $rain_total, \"Rain_Since_Last\": $rain_since_last}";
  if ($i < $num - 1) {
    echo ",";
  }
  echo PHP_EOL;

  $i++;
}

if ($type !== "current") {
   echo "]".PHP_EOL;
}
}

?>

