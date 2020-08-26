<?php
session_start();

if ( isset( $_SESSION['user_id'] ) ) {
  include("PHP-Actions/view.php");

} else {

    header("Location: http://web.socem.plymouth.ac.uk/intProj/PRCS252A/Website/login.php");
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
  <?php
  include("PHP-Actions/view.php");
   ?>

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
      <h1>Bookings Table</h1>
      <div class="search-bar">
        <input type="text" id="searchInput" class="form-control" onkeyup="searchTable()" placeholder="Search">
      </div>
      <table id="header-search" style="margin-left: 60%; width: 500px;">
        <thead>
          <th><button id="openModal" class="btn button-on-white">Add Booking</button></th>
          <form method="post" action="PHP-Actions/Edit/edit_booking_page.php">
            <th>
              <input type="number" min=1 name="edit_booking" class="form-control" placeholder="ID">
              <br>
              <button type="submit" class="btn my-2 my-sm-0 button-on-white">Edit Booking</button>
            </th>
          </form>
          <form method="post" action="PHP-Actions/delete/delete_booking.php">
            <th>
              <input type="number" min=1 name="delete_id" class="form-control" placeholder="ID">
              <br>
              <button type="submit" class="btn my-2 my-sm-0 button-on-white">Delete Booking</button>
            </form>
          </th>
      </thead>
      </table>
      <br>
      <br>

      <table id="targetTable" class="table table-bordered">
        <thead class="header">
          <th>Booking code</th>
          <th>Booking ID</th>
          <th>Jourent ID</th>
          <th>User ID</th>
        </thead>
        <tbody id="bookingTable">
          <?php
            foreach ($booking_content as $key2 => $value2) {
              echo "<tr>";
              echo "<td>" . $value2['BOOKING_CODE'] . "</td>";
              echo "<td>" . $value2['BOOKING_ID'] . "</td>";
              echo "<td>" . $value2['JOURNEY_ID'] . "</td>";
              echo "<td>" . $value2['USER_ID'] . "</td>";
              echo "</tr>";
            }
           ?>
        </tbody>
      </table>

<div id="addModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h2>Add Booking</h2>
    </div>
    <div class="modal-body">
      <form method="post" action="php-actions/insert_into/add_booking.php">
        <div class="form-group">
          <label for="exampleFormControlInput1">Booking Code</label>
          <input type="text" class="form-control" id="exampleFormControlInput1 booking-id-form" name="booking_code">
        </div>
        <div class="form-group">
          <label for="exampleFormControlInput1">User ID</label>
          <select name="user_id" class="form-control" id="exampleFormControlSelect1 user-id-form">
            <?php
            foreach($customers as $key => $value) {
              echo "<option>" . $value['USER_ID'] . "</option>";
              }
             ?>
          </select>
        </div>
        <div class="form-group">
          <label for="exampleFormControlInput1">Joureny ID</label>
          <select name="journey_id" class="form-control" id="exampleFormControlSelect1 journey-id-form">
            <?php
            foreach($joureny_array as $key => $value) {
              echo "<option>" . $value['JOURNEY_ID'] . "</option>";
              }
             ?>
          </select>
        </div>
        <button type="submit" class="btn btn-primary add-row">Submit</button>
      </form>
    </div>
  </div>

</div>


<script type="text/javascript" src="JavaScript/Standard.js"></script>
</div>
</div>
</body>
</html>
