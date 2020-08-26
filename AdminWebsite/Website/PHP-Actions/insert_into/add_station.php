<?php
$joureny_api = "http://web.socem.plymouth.ac.uk/intProj/PRCS252A/api/station";
$ch = curl_init($joureny_api);

$station_id = 0;
$station_type = $_POST['station'];
$station_name = $_POST['station_name'];
$address1 = $_POST['address1'];
$address2 = $_POST['address2'];
$postcode = $_POST['postcode'];

$new_station = array(
  'STATION_ID' => $station_id;
  'STATION_TYPE' => $station_type;
  'STATION_NAME' => $station_name;
  'S_ADDRESS_LINE_1' => $address1;
  'S_ADDRESS_LINE_2' => $address2;
  'S_POSTCODE' => $postcode;
);

$post_station = json_encode($new_station);

curl_setopt($ch, CURLOPT_POST, 1);

curl_setopt($ch, CURLOPT_POSTFIELDS, $post_station);

curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

$result = curl_exec($ch);

header("Location: http://web.socem.plymouth.ac.uk/intProj/PRCS252A/Website/station_page.php");
exit;
 ?>
