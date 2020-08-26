<?php
session_start();

if ( isset( $_SESSION['user_id'] ) ) {
  include("PHP-Actions/view.php");

} else {

    header("Location: http://web.socem.plymouth.ac.uk/intProj/PRCS252A/Website/login.php");
}
if(isset($_SESSION['change_password_error'])) {
  echo $_SESSION['change_password_error'] = null;;
  $_SESSION['change_password_error'] = null;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <Title>Thomas&Co Admin</title>
  <link rel="icon" type="image/ico" href="images/Thomas_Co_logo_black.PNG" />
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="sidebar-style.css">
  <link rel="stylesheet" hred="main-frame-style.css">


</head>
<body>

<div class="d-flex" id="wrapper">
  <div class="bg-light border-right" id="sidebar-wrapper">
    <div class="sidebar-heading"><a href="http://web.socem.plymouth.ac.uk/intProj/PRCS252A/Website/admin_landing.php"><img src="images/Thomas_Co_logo_white.PNG" alt="logo" style="width:225px; height:125px; position: relative; left: 5px;"></a></div>
    <div class="list-group list-group-flush">
      <a href="http://web.socem.plymouth.ac.uk/intProj/PRCS252A/Website/staff_page.php" class="list-group-item list-group-item-action bg-light">Staff</a>
      <a href="http://web.socem.plymouth.ac.uk/intProj/PRCS252A/Website/customers_page.php" class="list-group-item list-group-item-action bg-light">Customers</a>
      <a href="http://web.socem.plymouth.ac.uk/intProj/PRCS252A/Website/bookings_page.php" class="list-group-item list-group-item-action bg-light">Bookings</a>
      <a href="http://web.socem.plymouth.ac.uk/intProj/PRCS252A/Website/journey_page.php" class="list-group-item list-group-item-action bg-light">Journeys</a>
      <a href="http://web.socem.plymouth.ac.uk/intProj/PRCS252A/Website/route_page.php" class="list-group-item list-group-item-action bg-light">Route</a>
      <a href="http://web.socem.plymouth.ac.uk/intProj/PRCS252A/Website/station_page.php" class="list-group-item list-group-item-action bg-light">Stations</a>
      <a href="http://web.socem.plymouth.ac.uk/intProj/PRCS252A/Website/jobs_page.php" class="list-group-item list-group-item-action bg-light">Jobs</a>
      <a href="http://web.socem.plymouth.ac.uk/intProj/PRCS252A/Website/vehicles_page.php" class="list-group-item list-group-item-action bg-light">Vehicles</a>
    </div>
  </div>

  <div id="page-content-wrapper">

    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
          <li class="nav-item active">
            <form action="PHP-Actions/logout.php">
            <input class="btn btn-outline-success my-2 my-sm-0" id="logout-Btn" type="submit" Value="Logout">
          </form>
          </li>
        </ul>
      </div>
    </nav>

    <div class="container-fluid">
      <h1>Welcome: <?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname'];  ?></h1>
      <br>

      <table style="">
        <th width="50%">
          <h2>Add Admin</h2>
        <form method="post" action="PHP-Actions/insert_into/add_admin.php">
          <div class="form-group">
            <label for="exampleFormControlInput1">Username</label>
            <input type="text" class="form-control" id="exampleFormControlInput1 booking-id-form" name="username">
          </div>
          <div class="form-group">
            <label for="exampleFormControlInput1">First Name</label>
            <input type="text" class="form-control" id="exampleFormControlInput1 booking-id-form" name="firstname">
          </div>
          <div class="form-group">
            <label for="exampleFormControlInput1">Last Name</label>
            <input type="text" class="form-control" id="exampleFormControlInput1 booking-id-form" name="lastname">
          </div>
          <div class="form-group">
            <label for="exampleFormControlInput1">Password</label>
            <input type="text" class="form-control" id="exampleFormControlInput1 booking-id-form" name="password">
          </div>
          <div class="form-group">
            <label for="exampleFormControlInput1">Email</label>
            <input type="text" class="form-control" id="exampleFormControlInput1 booking-id-form" name="email">
          </div>
          <div class="form-group">
            <label for="exampleFormControlInput1">Address Line 1</label>
            <input type="text" class="form-control" id="exampleFormControlInput1 booking-id-form" name="address1">
          </div>
          <div class="form-group">
            <label for="exampleFormControlInput1">Address Line 2</label>
            <input type="text" class="form-control" id="exampleFormControlInput1 booking-id-form" name="address2">
          </div>
          <div class="form-group">
            <label for="exampleFormControlInput1">Post Code</label>
            <input type="text" class="form-control" id="exampleFormControlInput1 booking-id-form" name="postcode">
          </div>
          <div class="form-group">
            <label for="exampleFormControlSelect1">Date of Birth</label>
            <input id="datefield" type="date" max="21/05/2001" name="DOB" class="form-control">
          </div>
          <div class="form-group">
            <label for="exampleFormControlInput1">Contact Number</label>
            <input type="text" class="form-control" id="exampleFormControlInput1 booking-id-form" name="cont_number">
          </div>
          <button type="submit" class="btn btn-primary add-row">Add Admin</button>

        </form>
      </th>
      <th width="70%">
        <h2>Change Password</h2>
        <form action="PHP-Actions/edit/edit_function/admin_password.php" method="post">
          <div class="form-group">
            <input type="text" class="form-control" id="exampleFormControlInput1 booking-id-form" name="old_password" placeholder="Old Password">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="exampleFormControlInput1 booking-id-form" name="new_password" placeholder="New Password">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" id="exampleFormControlInput1 booking-id-form" name="conf_password" placeholder="Confrim Password">
          </div>
          <button type="submit" class="btn btn-primary add-row">Change Password</button>
        </form>
      </th>
      <th>
      </th>
      </table>


</div>
</div>
</body>
</html>
