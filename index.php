<?php
    $map_url = "https://maps.googleapis.com/maps/api/geocode/xml?address=" . rawurlencode($_GET["address"]). ",".                              rawurlencode($_GET["city"]).",". rawurlencode($_GET["state"]) . "&key=AIzaSyDKPmyabeGtr0tbjfXy12EbNXeZpjB6CHs";
    $maps_response = new SimpleXMLElement(file_get_contents($map_url));
    if($maps_response->status[0] != "ZERO_RESULTS") {
    $lat = (string) $maps_response->result[0]->geometry[0]->location[0]->lat;
    $lng = (string) $maps_response->result[0]->geometry[0]->location[0]->lng;
    
    $api_key = "334a9dd860b63e6fc5e0f67976898eb2";
    if ($_GET["temp"] == "C"){
        $units = "si";
    }
    else {
        $units = "us";
    }
    if ($units == "us") {
        $windspeed_unit = "mph";
        $visibility_unit = "mi";
    }
    else {
        $windspeed_unit = "mts/sec";
        $visibility_unit = "km";
    }
    $forecast_url = "https://api.forecast.io/forecast/". $api_key. "/". $lat. "," . $lng . "?units=" . $units . "&exclude=flags";
    $resp = file_get_contents($forecast_url);
    echo $resp;
    }
else{
    echo "Data not found";
}
        ?>