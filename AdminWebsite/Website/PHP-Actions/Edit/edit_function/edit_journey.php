<?php
session_start();
if(isset($_POST['submit'])) {


$edit_journey = array();
$edit_journey['JOURNEY_ID'] = $_SESSION['edit_journey_id'];

$route_id = $_POST['route_id'];
$dep_time = $_POST['departure_time'];
$arrival_time = $_POST['arrival_time'];
$delay = $_POST['delay_time'];
$delay_reason = $_POST['delay_reason'];
$cancel = $_POST['cancel_reason'];
$price = $_POST['price'];
$num_carriages = $_POST['num_of_carriages'];

$og_route_id = $_POST['og_route_id'];
$og_dep_time = $_POST['og_begin_time'];
$og_arrival_time = $_POST['og_arrival_time'];
$og_delay = $_POST['og_delay_time'];
$og_delay_reason = $_POST['og_delay_reason'];
$og_cancel = $_POST['og_cancel_reason'];
$og_price = $_POST['og_price'];
$og_num_carriages = $_POST['og_num_carriages'];

if($route_id != $og_route_id) {
  $edit_journey['ROUTE_ID'] = $route_id;
}
if($dep_time != $og_dep_time) {
  $edit_journey['BEGIN_TIME'] = $dep_time;
}
if($arrival_time != $og_arrival_time) {
  $edit_journey['ARRIVAL_TIME'] = $arrival_time;
}
if($delay != $og_delay) {
  $edit_journey['TIME_DELAY'] = $delay;
}
if($delay_reason != $og_delay_reason) {
  $edit_journey['DELAY_REASON'] = $delay_reason;
}
if($cancel != $og_cancel) {
  $edit_journey['CANCELLED_REASON'] = $cancel;
}
if($price != $og_price) {
  $edit_journey['BASE_PRICE'] = $price;
}
if($num_carriages != $og_num_carriages) {
  $edit_journey['NUM_OF_CARRIAGES'] = $num_carriages;
}

$url = "http://web.socem.plymouth.ac.uk/intProj/PRCS252A/api/journey/" . $_SESSION['edit_journey_id'];
$encoded_edit = json_encode($edit_journey);
$string_edit = http_build_query($edit_journey);

echo $encoded_edit . "<br>";

$curl_options = array(
  CURLOPT_URL => "http://web.socem.plymouth.ac.uk/intProj/PRCS252A/api/journey/" . $_SESSION['edit_journey_id'],
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
  header("Location: http://web.socem.plymouth.ac.uk/intProj/PRCS252A/Website/journey_page.php");
  exit;
} else {
  header("Location: http://web.socem.plymouth.ac.uk/intProj/PRCS252A/Website/journey_page.php");
  exit;
}

//Close cURL session


} else {
  echo "issue on submit";
}

 ?>
