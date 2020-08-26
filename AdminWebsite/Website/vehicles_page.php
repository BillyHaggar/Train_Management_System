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
      <h1>Vehicles Table</h1>
      <div class="search-bar">
        <input type="text" id="searchInput" class="form-control" onkeyup="searchTable()" placeholder="Search">
      </div>
      <table id="header-search" style="margin-left: 60%; width: 500px;">
        <thead>
          <th><button id="openModal" class="btn button-on-white">Add Vehicle</button></th>
          <form method="post" action="PHP-Actions/Edit/edit_vehicle_page.php">
            <th>
              <input type="number" min=1 name="edit_vehicle" class="form-control" placeholder="ID">
              <br>
              <button type="submit" class="btn my-2 my-sm-0 button-on-white">Edit Vehicle</button>
            </th>
          </form>
          <form method="post" action="PHP-Actions/delete/delete_vehicle.php">
            <th>
              <input type="number" min=1 name="delete_id" class="form-control" placeholder="ID">
              <br>
              <button type="submit" class="btn my-2 my-sm-0 button-on-white">Delete Vehicle</button>
            </form>
          </th>
      </thead>
      </table>
      <br>
      <br>

      <table id="targetTable" class="table table-bordered">
        <thead class="header">
          <th>Vehicle Reg</th>
          <th>Joureny ID</th>
          <th>Vehicle Type</th>
          <th>Capacity</th>
          <th>Storage Location</th>
        </thead>
        <tbody id="vehicleTable">
          <?php
            foreach ($vehicle_array as $key => $value) {
              echo "<tr>";
              echo "<td>" . $value['VEHICLE_REG'] . "</td>";
              echo "<td>" . $value['JOURNEY_ID'] . "</td>";
              echo "<td>" . $value['VEHICLE_TYPE'] . "</td>";
              echo "<td>" . $value['P_CAPACITY'] . "</td>";
              echo "<td>" . $value['STORED_LOCATION'] . "</td>";
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
      <h2>Add Vehicle</h2>
    </div>
    <div class="modal-body">
      <form method="post" action="PHP-Actions/insert_into/add_vehicle.php">
        <div class="form-group">
          <label for="exampleFormControlInput1">Vehicle Registration</label>
          <input type="text" class="form-control" id="exampleFormControlInput1 vehicle-reg-form" name="reg">
        </div>
        <div class="form-group">
          <select class="form-control" id="exampleFormControlSelect1 journey-id-form" name="joureny">
            <option> </option>
            <?php
            foreach($joureny_array as $key => $value) {
              echo "<option>" . $value['JOURNEY_ID'] . "</option>";
              }
             ?>
          </select>
        </div>
        <div class="form-group">
          <label for="exampleFormControlInput1">Capacity</label>
          <input type="number" min=10 class="form-control" id="exampleFormControlInput1 capacity-form" name="capacity">
        </div>
        <div class="form-group">
          <label for="exampleFormControlInput1">Location Stored</label>
          <input type="text"class="form-control" id="exampleFormControlInput1 stored-form" name="stored">
        </div>
        <div class="form-group">
          <label for="exampleFormControlInput1">Vehicle Type</label>
          <input type="text"class="form-control" id="exampleFormControlInput1 type-form" name="type">
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
