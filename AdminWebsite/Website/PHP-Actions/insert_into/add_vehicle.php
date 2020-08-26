<?PHP
$joureny_api = "http://web.socem.plymouth.ac.uk/intProj/PRCS252A/api/vehicle";
$ch = curl_init($joureny_api);

$vehicle_reg = $_POST['reg'];
$joureny = $_POST['joureny'];
$capacity = $_POST['capacity'];
$stored = $_POST['stored'];
$type = $_POST['type'];

$new_vehicle = array(
  'VEHICLE_REG' => $vehicle_reg;
  'JOURENY_ID' => $joureny;
  'P_CAPACITY' => $capacity;
  'STORED_LOCATION' => $stored;
  'VEHICLE_TYPE' => $type;
);

$post_vehicle = json_encode($new_vehicle);

curl_setopt($ch, CURLOPT_POST, 1);

curl_setopt($ch, CURLOPT_POSTFIELDS, $post_vehicle);

curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

$result = curl_exec($ch);

header("Location: http://web.socem.plymouth.ac.uk/intProj/PRCS252A/Website/vehicles_page.php");
exit;
?>
