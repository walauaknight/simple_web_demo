<?php

$lat = htmlentities($_POST['postLat']);
$lng = htmlentities($_POST['postLng']);
/*
$lat = 1.5219864;
$lng = 103.6551451;
*/
$url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=$lat,$lng&key=AIzaSyDfKwAOng7oStHq1jkissZelv5XLjjxccE";
$dataRequested = file_get_contents($url);
$dataDecode = json_decode($dataRequested,true);
//var_dump($dataDecode);
//echo '<pre>',print_r($dataDecode),'</pre>';
echo $dataDecode['results']['1']['formatted_address'];
