<?php
session_start();


include("view.php");

$username = $_POST["username"];
$password = $_POST["password"];


if ( ! empty( $_POST ) ) {
    if ( isset( $_POST['username'] ) && isset( $_POST['password'] ) ) {
      foreach($admin as $key => $value) {
        if($username == $value['USERNAME'] && $password == $value['USER_PASSWORD']) {
          $_SESSION['login_verification'] = True;
          $_SESSION['user_id'] = $value['USERNAME'];
          $_SESSION['user'] = $value['USER_ID'];
          $_SESSION['firstname'] = $value['FIRST_NAME'];
          $_SESSION['lastname'] = $value['LAST_NAME'];
          $_SESSION['password'] = $value['USER_PASSWORD']
          header("Location: http://web.socem.plymouth.ac.uk/intProj/PRCS252A/Website/admin_landing.php");
          exit;
        } else {
          $_SESSION['login_error'] = "<script>alert('Invalid Login Credentials')</script>";
          header("Location: http://web.socem.plymouth.ac.uk/intProj/PRCS252A/Website/login.php");
          exit;
        }
      }
    }
}

 ?>
