<?php
session_start();
if(isset($_POST['submit'])) {


$edit_vehicles = array();
$edit_vehicles['VEHICLE_REG'] = $_SESSION['edit_vehicles_id'];

$journey = $_POST['journey'];
$type = $_POST['vehicle_type'];
$capacitiy = $_POST['capacity'];
$location = $_POST['stored_location'];


$og_location = $_POST['og_stored_location'];
$og_cap = $_POST['og_capacitiy'];
$og_type = $_POST['og_type'];
$og_journey = $_POST['og_journey'];

if($journey != $og_journey) {
  $edit_vehicles['JOURNEY_ID'] = $journey;
}
if($capacitiy != $og_cap) {
  $edit_vehicles['P_CAPACITY'] = $capacitiy;
}
if($type != $og_type) {
  $edit_vehicles['VEHICLE_TYPE'] = $type;
}
if($location != $og_location) {
  $edit_vehicles['STORED_LOCATION'] = $location;
}


$url = "http://web.socem.plymouth.ac.uk/intProj/PRCS252A/api/vehicle/" . $_SESSION['edit_vehicles_id'];
$encoded_edit = json_encode($edit_vehicles);
$string_edit = http_build_query($edit_vehicles);

echo $encoded_edit . "<br>";

$curl_options = array(
  CURLOPT_URL => "http://web.socem.plymouth.ac.uk/intProj/PRCS252A/api/vehicle/" . $_SESSION['edit_vehicles_id'],
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
  header("Location: http://web.socem.plymouth.ac.uk/intProj/PRCS252A/Website/vehicles_page.php");
  exit;
} else {
  header("Location: http://web.socem.plymouth.ac.uk/intProj/PRCS252A/Website/vehicles_page.php");
  exit;
}

//Close cURL session


} else {
  echo "issue on submit";
}

 ?>
