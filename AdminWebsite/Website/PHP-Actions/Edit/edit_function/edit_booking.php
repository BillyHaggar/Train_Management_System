<?php
session_start();
if(isset($_POST['submit'])) {


$edit_booking = array();
$edit_booking['BOOKING_ID'] = $_SESSION['edit_booking_id'];

$journey_id = $_POST['journey'];
$user_id = $_POST['user'];
$booking_code = $_POST['booking_code'];

$og_journey_id = $_POST['og_journey'];
$og_user_id = $_POST['og_customer'];
$og_booking_code = $_POST['og_code'];

if($booking_code != $og_booking_code) {
  $edit_booking['BOOKING_CODE'] = $booking_code;
}
if($journey_id != $og_journey_id) {
  $edit_booking['JOURNEY_ID'] = $journey_id;
}
if($user_id != $og_user_id) {
  $edit_booking['USER_ID'] = $user_id;
}

$url = "http://web.socem.plymouth.ac.uk/intProj/PRCS252A/api/booking/" . $_SESSION['edit_booking_id'];
$encoded_edit = json_encode($edit_booking);
$string_edit = http_build_query($edit_booking);

echo $encoded_edit . "<br>";

$curl_options = array(
  CURLOPT_URL => "http://web.socem.plymouth.ac.uk/intProj/PRCS252A/api/booking/" . $_SESSION['edit_booking_id'],
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
  header("Location: http://web.socem.plymouth.ac.uk/intProj/PRCS252A/Website/booking_page.php");
  exit;
} else {
  header("Location: http://web.socem.plymouth.ac.uk/intProj/PRCS252A/Website/booking_page.php");
  exit;
}

//Close cURL session


} else {
  echo "issue on submit";
}

 ?>
