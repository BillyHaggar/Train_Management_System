<?php
session_start();
if(isset($_POST['submit'])) {


$edit_customer = array();
$edit_customer['USER_ID'] = $_SESSION['edit_customer_id'];

$username = $_POST['username'];
$password = $_POST['password'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$role = $_POST['role'];
$address1 = $_POST['address1'];
$address2 = $_POST['address2'];
$postcode = $_POST['postcode'];
$email = $_POST['email'];
$contact_num = $_POST['contactNum'];
$alt_contact_num = $_POST['altContactNum'];
$mark_opt = $_POST['marketing_opt'];

$og_username = $_POST['og_username'];
$og_password = $_POST['og_password'];
$og_firstname = $_POST['og_firstname'];
$og_lastname = $_POST['og_lastname'];
$og_role = $_POST['og_role'];
$og_address1 = $_POST['og_address1'];
$og_address2 = $_POST['og_address2'];
$og_postcode = $_POST['postcode'];
$og_email = $_POST['og_email'];
$og_contact_num = $_POST['og_contact_nums'];
$og_alt_contact_num = $_POST['og_alt_num'];
$og_mark_opt = $_POST['og_mark_opt'];

if($username != $og_username) {
  $edit_customer['USERNAME'] = $username;
}
if($password != $og_password) {
  $edit_customer['USER_PASSWORD'] = $password;
}
if($firstname != $og_firstname) {
  $edit_customer['FIRST_NAME'] = $firstname;
}
if($lastname != $og_lastname) {
  $edit_customer['LAST_NAME'] = $lastname;
}
if($role != $og_role) {
  $edit_customer['USER_RANK'] = $role;
}
if($address1 != $og_address1) {
  $edit_customer['U_ADDRESS_LINE_1'] = $address1;
}
if($address2 != $og_address2) {
  $edit_customer['U_ADDRESS_LINE_2'] = $address2;
}
if($postcode != $og_postcode) {
  $edit_customer['U_POSTCODE'] = $postcode;
}
if($email != $og_email) {
  $edit_customer['EMAIL'] = $email;
}
if($alt_contact_num != $og_alt_contact_num) {
  $edit_customer['ALTERNATIVE_NUMBER'] = $alt_contact_num;
}
if($contact_num != $og_contact_num) {
  $edit_customer['CONTACT_NUMBER'] = $contact_num;
}
if($mark_opt != $og_mark_opt) {
  $edit_customer['MARKETING_OPT_IN'] = $mark_opt;
}

$url = "http://web.socem.plymouth.ac.uk/intProj/PRCS252A/api/user_account/" . $_SESSION['edit_customer_id'];
$encoded_edit = json_encode($edit_customer);
$string_edit = http_build_query($edit_customer);

echo $encoded_edit . "<br>";

$curl_options = array(
  CURLOPT_URL => "http://web.socem.plymouth.ac.uk/intProj/PRCS252A/api/user_account/" . $_SESSION['edit_customer_id'],
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
  header("Location: http://web.socem.plymouth.ac.uk/intProj/PRCS252A/Website/customer_page.php");
  exit;
} else {
  header("Location: http://web.socem.plymouth.ac.uk/intProj/PRCS252A/Website/customer_page.php");
  exit;
}

//Close cURL session


} else {
  echo "issue on submit";
}

 ?>
