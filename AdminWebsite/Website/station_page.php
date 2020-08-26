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
      <h1>Stations Table</h1>
      <div class="search-bar">
        <input type="text" id="searchInput" class="form-control" onkeyup="searchTable()" placeholder="Search">
      </div>
      <table id="header-search" style="margin-left: 60%; width: 500px;">
        <thead>
          <th><button id="openModal" class="btn button-on-white">Add Station</button></th>
          <form method="post" action="PHP-Actions/Edit/edit_station_page.php">
            <th>
              <input type="number" min=1 name="edit_station" class="form-control" placeholder="ID">
              <br>
              <button type="submit" class="btn my-2 my-sm-0 button-on-white">Edit Station</button>
            </th>
          </form>
          <form method="post" action="PHP-Actions/delete/delete_station.php">
            <th>
              <input type="number" min=1 name="delete_id" class="form-control" placeholder="ID">
              <br>
              <button type="submit" class="btn my-2 my-sm-0 button-on-white">Delete Station</button>
            </form>
          </th>
      </thead>
      </table>
      <br>
      <br>
      <table id="targetTable" class="table table-bordered">
        <thead class="header">
          <th>Station ID</th>
          <th>Station Name</th>
          <th>Station Type</th>
          <th>Address</th>
        </thead>
        <tbody id="stationsTable">
          <?php
            foreach ($stations_array as $key => $value) {
              echo "<tr>";
              echo "<td>" . $value['STATION_ID'] . "</td>";
              echo "<td>" . $value['STATION_NAME'] . "</td>";
              echo "<td>" . $value['STATION_TYPE'] . "</td>";
              echo "<td>" . $value['S_ADDRESS_LINE_1'] . "<br>" . $value['S_ADDRESS_LINE_2'] . "<br>" . $value['S_POSTCODE'] . "</td>";
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
      <h2>Add Station</h2>
    </div>
    <div class="modal-body">
      <form method="post" action="PHP-Actions/inster_into/add_station.php">
        <div class="form-group">
          <label for="exampleFormControlInput1">Station Type</label>
          <input type="test" class="form-control" id="exampleFormControlInput1 station-form" name="station">
        </div>
        <div class="form-group">
          <label for="exampleFormControlInput1">Station Name</label>
          <input type="test" class="form-control" id="exampleFormControlInput1 station-form" name="station_name">
        </div>
        <div class="form-group">
          <label for="exampleFormControlInput1">Address Line 1</label>
          <input type="test" class="form-control" id="exampleFormControlInput1 station-form" name="address1">
        </div>
        <div class="form-group">
          <label for="exampleFormControlInput1">Address Line 2/Town/City</label>
          <input type="test" class="form-control" id="exampleFormControlInput1 station-form" name="address2">
        </div>
        <div class="form-group">
          <label for="exampleFormControlInput1">Post Code</label>
          <input type="test" class="form-control" id="exampleFormControlInput1 station-form" name="postcode">
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
