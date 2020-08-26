<?php
include("../view.php");

$pk = $_POST['delete_id'];

foreach($user_accounts_content as $key => $value) {
  if($user_accounts_content['USER_ID'] == $pk && $user_accounts_content['USER_RANK'] == 'CUSTOMER') {
    $url = "http://web.socem.plymouth.ac.uk/intProj/PRCS252A/Website/customers_page.php";
  }
  else {
    $url = "http://web.socem.plymouth.ac.uk/intProj/PRCS252A/Website/staff_page.php";
  }
}

$delete_joureny_encode = json_encode($delete_joureny);


$url = 'http://web.socem.plymouth.ac.uk/intProj/PRCS252A/api/user_id/' . $pk;



$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response  = curl_exec($ch);
curl_close($ch);

header("Location: " $url);
 ?>
