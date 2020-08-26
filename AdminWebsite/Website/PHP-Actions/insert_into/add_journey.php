<?php
  $joureny_id = 0;
  $route_id = $_POST['route_id'];
  $dep_time = $_POST['departure_time'];
  $arrival_time = $_POST['arrival_time'];
  $delay = $_POST['delay_time'];
  $delay_reason = $_POST['delay_reason'];
  $cancel = $_POST['cancel_reason'];
  $price = $_POST['price'];
  $num_carriages = $_POST['num_of_carriages'];

  if($delay_reason == "NA"){
    $delay_reason = null;
  }
  if($cancel == "NA") {
    $cancel = null;
  }

$new_journey = array(
  'JOURNEY_ID' => $joureny_id,
  'ROUTE_ID' => $route_id,
  'BEGIN_TIME' => $dep_time,
  'ARRIVAL_TIME' => $arrival_time,
  'TIME_DELAY' => $delay,
  'DELAY_REASON' => $delay_reason,
  'CANCELLED_REASON' => $cancel,
  'BASE_PRICE' => $price,
  'NUM_OF_CARRIAGES' => $num_carriages
);

$joureny_api = "http://web.socem.plymouth.ac.uk/intProj/PRCS252A/api/journey";
$ch = curl_init($joureny_api);

$post_journey = json_encode($new_journey);

curl_setopt($ch, CURLOPT_POST, 1);

curl_setopt($ch, CURLOPT_POSTFIELDS, $post_journey);

curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

$result = curl_exec($ch);


header("Location: http://web.socem.plymouth.ac.uk/intProj/PRCS252A/Website/journey_page.php");
exit;

?>
