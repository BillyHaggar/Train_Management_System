<?php
$user_api = "http://web.socem.plymouth.ac.uk/intProj/PRCS252A/api/user_account";
$ch = curl_init($user_api);

  $pk = 0;
  $username = $_POST['username'];
  $password = $_POST['password'];
  $user_rank = "ADMIN";
  $first_name = $_POST['firstname'];
  $last_name = $_POST['lastname']
  $dob = $_POST['DOB'];
  $address1 = $_POST['address1'];
  $address2 = $_POST['address2'];
  $postcode = $_POST['postcode'];
  $town = null;
  $eamil = $_POST['email'];
  $contact_num = $_POST['cont_number'];
  $alt_contact_num = null;
  $marketing_opt = "F";

$new_admin = array(
  'USER_ID' => $pk,
  'USERNAME' => $username,
  'USER_PASSWORD' => $password,
  'USER_RANK' => $user_rank,
  'FIRST_NAME' => $first_name,
  'LAST_NAME' => $last_name,
  'DATE_OF_BIRTH' => $dob,
  'U_ADDRESS_LINE_1' => $address1,
  'U_ADDRESS_LINE_2' => $address2,
  'U_POSTCODE' => $postcode,
  'U_TOWN' => $town,
  'EMAIL' => $email,
  'CONTACT_NUMBER' => $contact_num,
  'ALTERNATIVE_NUMBER' => $alt_contact_num,
  'MARKETING_OPT_IN' => $marketing_opt
);

$post_admin = json_encode($new_admin);

curl_setopt($ch, CURLOPT_POST, 1);

curl_setopt($ch, CURLOPT_POSTFIELDS, $post_admin);

curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

$result = curl_exec($ch);

header("Location: http://web.socem.plymouth.ac.uk/intProj/PRCS252A/Website/sadmin_landing.php");
exit;
?>
