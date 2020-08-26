<?php
include("../view.php");

$pk = $_POST['delete_id'];

$delete_joureny_encode = json_encode($delete_joureny);


$url = 'http://web.socem.plymouth.ac.uk/intProj/PRCS252A/api/station/' . $pk;



$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response  = curl_exec($ch);
curl_close($ch);

header("Location: http://web.socem.plymouth.ac.uk/intProj/PRCS252A/Website/station_page.php");
 ?>
