<?php
session_start();
if(isset($_POST['submit'])) {


$edit_station = array();
$edit_station['STATION_ID'] = $_SESSION['edit_station_id'];

$station_type = $_POST['station_type'];
$station_name = $_POST['station_name'];
$address1 = $_POST['address1'];
$address2 = $_POST['address2'];
$postcode = $_POST['postcode'];

$og_station_type = $_POST['og_station_type'];
$og_station_name = $_POST['og_station_name'];
$og_address1 = $_POST['og_address1'];
$og_address2 = $_POST['og_address2'];
$og_postcode = $_POST['og_postcode'];

if($station_type != $og_station_type) {
  $edit_station['ROUTE_ID'] = $station_type;
}
if($station_name != $og_station_name) {
  $edit_station['BEGIN_TIME'] = $station_name;
}
if($address1 != $og_address1) {
  $edit_station['ARRIVAL_TIME'] = $address1;
}
if($address2 != $og_address2) {
  $edit_station['TIME_DELAY'] = $address2;
}
if($postcode != $og_postcode) {
  $edit_station['DELAY_REASON'] = $postcode;
}


$url = "http://web.socem.plymouth.ac.uk/intProj/PRCS252A/api/station/" . $_SESSION['edit_station_id'];
$encoded_edit = json_encode($edit_station);
$string_edit = http_build_query($edit_station);

echo $encoded_edit . "<br>";

$curl_options = array(
  CURLOPT_URL => "http://web.socem.plymouth.ac.uk/intProj/PRCS252A/api/station/" . $_SESSION['edit_station_id'],
  CURLOPT_RETURNTRANSFER => 1,
  CURLOPT_CUSTOMREQUEST => 'PUT',
  CURLOPT_HTTPHEADER => array('Content-Type: application/json', 'Accept: application/json'),
  CURLOPT_POSTFIELDS => $encoded_edit
);

//Initalises cURL
$ch = curl_init();
curl_setopt_array($ch, $curl_options);


$response = curl_exec($ch);
echo 'Status-Code: ' . curl_getinfo($ch, CURLINFO_HTTP_CODE);
echo '<pre>';print_r(json_decode($response, true));echo'</pre>';
curl_close($ch);

if(curl_getinfo($ch, CURLINFO_HTTP_CODE) != 204) {
  $_SESSION['edit_error'] = "Error with REQUEST, status code: " . curl_getinfo($ch, CURLINFO_HTTP_CODE);
  header("Location: http://web.socem.plymouth.ac.uk/intProj/PRCS252A/Website/station_page.php");
  exit;
} else {
  header("Location: http://web.socem.plymouth.ac.uk/intProj/PRCS252A/Website/station_page.php");
  exit;
}

//Close cURL session


} else {
  echo "issue on submit";
}

 ?>
