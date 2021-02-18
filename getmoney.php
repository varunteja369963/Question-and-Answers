 <html>

<body>


<p id="demo"></p>

<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script>
contry_code = google.loader.ClientLocation.address.country_code
city = google.loader.ClientLocation.address.city
region = google.loader.ClientLocation.address.region


</script>

<script>
getLocation();
var x = document.getElementById("demo");

function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else { 
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}

function showPosition(position) {
  document.getElementById("#demo") += contry_code;
document.getElementById("#demo") += "<br>";
document.getElementById("#demo") += city;
document.getElementById("#demo") += "<br>";
document.getElementById("#demo") += region;
}
</script>

<div id="demo"></div>
<?php
date_default_timezone_set('Asia/Kolkata');   

$user_ip = getenv('REMOTE_ADDR');

$geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$user_ip"));
$country = $geo["geoplugin_countryName"];
$city = $geo["geoplugin_city"];

$file = fopen("getmoney.txt","a");
$date = "\n\n\n".date("Y/m/d h:i:s")."\n\n";
fwrite($file, $date);
echo "<br>";
echo "<h1>THIS IS PHP DATA START</h1>";

echo "<h1>THIS IS PHP DATA CLOSE</h1>";
echo "</br>";
echo "</br>";

fwrite($file, print_r($geo, TRUE));
fclose($file);
ECHO "</br>";
echo "</br>";
echo "</br>";
echo '<div id = "out"></div>';
?>
</body>
</html>