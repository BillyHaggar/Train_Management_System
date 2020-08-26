<?php
$user_api = "http://web.socem.plymouth.ac.uk/intProj/PRCS252A/api/user_account";
$ch = curl_init($user_api);

  $pk = 0;
  $username = $_POST['username'];
  $password = $_POST['password'];
  $user_rank = $_POST['role'];
  $first_name = $_POST['firstname'];
  $last_name = $_POST['lastname']
  $dob = $_POST['DOB'];
  $address1 = $_POST['address1'];
  $address2 = $_POST['address2'];
  $postcode = $_POST['postcode'];
  $town = "";
  $eamil = $_POST['email'];
  $contact_num = $_POST['contactNum'];
  $alt_contact_num = $_POST['altContactNum'];
  $marketing_opt = $_POST['marketing_opt'];

$new_staff = array(
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

$post_staff = json_encode($new_staff);

curl_setopt($ch, CURLOPT_POST, 1);

curl_setopt($ch, CURLOPT_POSTFIELDS, $post_staff);

curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

$result = curl_exec($ch);

header("Location: http://web.socem.plymouth.ac.uk/intProj/PRCS252A/Website/staff_page.php");
exit;
?>
