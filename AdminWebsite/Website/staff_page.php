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
      <h1>Staff Table</h1>
      <div class="search-bar">
        <input type="text" id="searchInput" class="form-control" onkeyup="searchTable()" placeholder="Search">
      </div>
      <table id="header-search" style="margin-left: 60%; width: 500px;">
        <thead>
          <th><button id="openModal" class="btn button-on-white">Add Staff</button></th>
          <form method="post" action="PHP-Actions/Edit/staff_edit_page.php">
            <th>
              <input type="number" min=1 name="edit_staff" class="form-control" placeholder="ID">
              <br>
              <button type="submit" class="btn my-2 my-sm-0 button-on-white">Edit Staff</button>
            </th>
          </form>
          <form method="post" action="PHP-Actions/delete/delete_staff.php">
            <th>
              <input type="number" min=1 name="delete_id" class="form-control" placeholder="ID">
              <br>
              <button type="submit" class="btn my-2 my-sm-0 button-on-white">Delete Staff</button>
            </form>
          </th>
      </thead>
      </table>
      <br>
      <br>

      <table id="targetTable" class="table table-bordered">
        <thead class="header">
          <th>Customer ID</th>
          <th>Username</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Password</th>
          <th>Staff Role</th>
          <th>Email</th>
          <th>Address</th>
          <th>DOB</th>
        </thead>
        <tbody id="staffTable">
          <?php
            foreach ($staff as $key2 => $value2) {
              echo "<tr>";
              echo "<td>" . $value2['USER_ID'] . "</td>";
              echo "<td>" . $value2['USERNAME'] . "</td>";
              echo "<td>" . $value2['FIRST_NAME'] . "</td>";
              echo "<td>" . $value2['LAST_NAME'] . "</td>";
              echo "<td>" . $value2['USER_PASSWORD'] . "</td>";
              echo "<td>" . $value2['USER_RANK'] . "</td>";
              echo "<td>" . $value2['EMAIL'] . "</td>";
              echo "<td>" . $value2['U_ADDRESS_LINE_1'] . "<br>" . $value2['U_ADDRESS_LINE_2'] . "<br>" . $value2['U_POSTCODE'] . "</td>";
              echo "<td>" . $value2['DATE_OF_BIRTH'] . "</td>";
              echo "</tr>";
            }
           ?>
        </tbody>
      </table>

      <div id="addModal" class="modal">
        <div class="modal-content">
          <div class="modal-header">
            <span class="close">&times;</span>
            <h2>Add Customer</h2>
          </div>
          <div class="modal-body">
            <form method="post" action="PHP-actions/insert_into/add_customer.php">
              <div class="form-group">
                <label for="exampleFormControlInput1">Username</label>
                <input type="test" class="form-control" id="exampleFormControlInput1 username-form" name="username">
              </div>
              <div class="form-group">
                <label for="exampleFormControlInput1">Password</label>
                <input type="test" class="form-control" id="exampleFormControlInput1 password-form" name="password">
              </div>
              <div class="form-group">
                <label for="exampleFormControlTextarea1">First Name</label>
                <input type="text" class="form-control" id="exampleFormControlTextarea first-name-form" name="firstname">
              </div>
              <div class="form-group">
                <label for="exampleFormControlTextarea1">Last Name</label>
                <input type="text" class="form-control" id="exampleFormControlTextarea1 last-name-form" name="lastname">
              </div>
              <div class="form-group">
                <label for="exampleFormControlTextarea1">Staff Role</label>
                <input type="text" class="form-control" id="exampleFormControlTextarea1 last-name-form" name="role">
              </div>
              <div class"form-group">
                <label for="exampleFormControlTextarea1">Address Line 1</label>
                <input type="text" class="form-control" id="exampleFormControlTextarea1 address1-form" name="address1">
              </div>
              <div class"form-group">
                <label for="exampleFormControlTextarea1">Address Line 2</label>
                <input type="text" class="form-control" id="exampleFormControlTextarea1 address2-form" name="address2">
              </div>
              <div class"form-group">
                <label for="exampleFormControlTextarea1">Post Code</label>
                <input type="text" class="form-control" id="exampleFormControlTextarea1 postcode-form" name="postcode">
              </div>
              <div class="form-group">
                <label for="exampleFormControlSelect1">Date of Birth</label>
                <input id="datefield" type="datetime-local" max="21/05/2001" name="DOB" class="form-control">
              </div>
              <div class"form-group">
                <label for="exampleFormControlTextarea1">Email</label>
                <input type="text" class="form-control" id="exampleFormControlTextarea1 email-form" name="email">
              </div>
              <div class"form-group">
                <label for="exampleFormControlTextarea1">Contact Number</label>
                <input type="text" class="form-control" id="exampleFormControlTextarea1 contactNum-form" name="contactNum">
              </div>
              <div class"form-group">
                <label for="exampleFormControlTextarea1">Alternative Contact Number</label>
                <input type="text" class="form-control" id="exampleFormControlTextarea1 alt-contact-Num-form" name="altContactNum">
              </div>
              <div class"form-group">
                <label for="exampleFormControlTextarea1">Marketing Opt</label>
                <input type="text" class="form-control" id="exampleFormControlTextarea1 marketing-opt-form" name="marketing_opt">
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
