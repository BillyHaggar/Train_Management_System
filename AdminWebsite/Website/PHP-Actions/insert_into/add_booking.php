<?php
$booking_api = "http://web.socem.plymouth.ac.uk/intProj/PRCS252A/api/booking";
$ch = curl_init($booking_api);

$booking_id = 0;
$joureny_id = $_POST['journey_id'];
$user_id = $_POST['user_id'];
$booking_code = $_POST['booking_code'];

$new_booking = array(
  'BOOKING_ID' => $booking_id,
  'JOURNEY_ID' => $joureny_id,
  'USER_ID' => $user_id,
  'BOOKING_CODE' => $booking_code
);

$post_booking = json_encode($new_booking);

curl_setopt($ch, CURLOPT_POST, 1);

curl_setopt($ch, CURLOPT_POSTFIELDS, $post_booking);

curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

$result = curl_exec($ch);


 ?>
