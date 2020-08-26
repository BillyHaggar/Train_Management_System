<?php
session_start();
$_SESSION['login_verification'] = False;

if(isset($_SESSION['login_error'])) {
  echo $_SESSION['login_error'];
  $_SESSION['login_error'] = null;
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <Title>Thomas&Co Admin</title>
  <link rel="icon" type="image/ico" href="images/Thomas_Logo.jpg" />
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/login.css">

  <link href="css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <link href="login-page.css" rel="stylesheet">


  <head>
  <body>
    <div class="wrapper fadeInDown">
      <h1 id="Title">Thomas&Co Admin Portal</h1>
      <div id="formContent">
        <div class="fadeIn first">
          <img src="images/Thomas_Co_logo_white.png" id="icon" alt="User Icon" />
        </div>

        <form action="PHP-Actions/login_check.php" method="post">
          <input class="fadeIn third" type="text" name="username" placeholder="Enter your username" required>
          <input class="fadeIn third"  type="password" name="password" placeholder="Enter your password" required>
          <input class="fadeIn fourth" type="submit" value="Submit">
        </form>

        <div id="formFooter">
        </div>

      </div>
    </div>
  </body>
  <html>
