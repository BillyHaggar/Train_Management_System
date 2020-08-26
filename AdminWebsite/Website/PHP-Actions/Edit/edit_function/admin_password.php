<?php
include("../../view.php");

$old_password = $_POST['old_password'];
$new_password = $_POST['new_password'];
$conf_password = $_POST['conf_password'];

if($new_password != $conf_password) {
  $_SESSION['change_password_error'] = "<script>alert('Passwords don't match')</script>";
  header("Location : http://web.socem.plymouth.ac.uk/intProj/PRCS252A/Website/admin_landing.php");
  exit;
} else {

  if($old_password != $_SESSION['password']) {
    $_SESSION['change_password_error'] = "<script>alert('Incorrect password')</script>";
    header("Location : http://web.socem.plymouth.ac.uk/intProj/PRCS252A/Website/admin_landing.php");
    exit;
  } else {
    $edit_admin = array();

    $edit_admin['USER_ID'] = $_SESSION['user'];
    $edit_admin['USER_PASSWORD'] = $new_password;

    $curl_options = array(
      CURLOPT_URL => "http://web.socem.plymouth.ac.uk/intProj/PRCS252A/api/user_account/" . $_SESSION['user'],
      CURLOPT_RETURNTRANSFER => 1,
      CURLOPT_CUSTOMREQUEST => 'PUT',
      CURLOPT_HTTPHEADER => array('Content-Type: application/json', 'Accept: application/json'),
      CURLOPT_POSTFIELDS => $encoded_edit
    );

    $ch = curl_init();
    curl_setopt_array($ch, $curl_options);


    $response = curl_exec($ch);
    if(curl_getinfo($ch, CURLINFO_HTTP_CODE) == 204) {
      $_SESSION['change_password_error'] = "<script>alert('password successfully cahnaged')";
      curl_close($ch);
      header("Location : http://web.socem.plymouth.ac.uk/intProj/PRCS252A/Website/admin_landing.php");
      exit;
    } else {
      $_SESSION['change_password_error'] = "<script>alert('Status-code: " . curl_getinfo($ch, CURLINFO_HTTP_CODE) . "')</script>";
      curl_close($ch);
      header("Location : http://web.socem.plymouth.ac.uk/intProj/PRCS252A/Website/admin_landing.php");
      exit;
    }



  }
}

 ?>
