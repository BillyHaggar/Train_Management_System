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
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <Title>Thomas&Co Admin</title>
  <link rel="icon" type="image/ico" href="images/Thomas_Co_logo_black.PNG" />
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="sidebar-style.css">
  <script type="text/javascript" src="JavaScript/Standard.js"></script>

  <?php
    include('PHP-Actions/view.php');
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
      <h1>Journey Table</h1>
      <!--div class="search-area">
        <div class="button-placement">
          <div class="add-button">
            <button id="openModal" class="btn button-on-white">Add Joureny</button>
          </div>
          <div class="form-placement">
            <form method="post" action="PHP-Actions/Edit/edit_journey_page.php">
              <div class="search-placement">
                <input type="number" min=1 name="edit_journey" class="form-control" placeholder="Edit Joureny ID">
              </div>
              <br>
              <div class="edit-button">
                <button type="submit" class="btn my-2 my-sm-0 button-on-white">Edit Journey</button>
              </div>
            </form>
          </div>
          <br>
          <div class="delete-placement">
            <form method="post" action="PHP-Actions/delete/delete_journey.php">
              <div class="search-placement">
                <input type="number" min=1 name="delete_id" class="form-control" placeholder="Del Joureny ID">
              </div>
              <br>
              <div class="delete-button">
                <button type="submit" class="btn my-2 my-sm-0 button-on-white">Delete Journey</button>
              </div>
            </form>
          </div>
        </div>
        <div class="search-bar">
          <input type="text" id="searchInput" class="form-control" onkeyup="searchTable()" placeholder="Search">
        </div>
      </div-->
      <div class="search-bar">
        <input type="text" id="searchInput" class="form-control" onkeyup="searchTable()" placeholder="Search">
      </div>
      <table id="header-search" style="margin-left: 60%; width: 500px;">
        <thead>
          <th><button id="openModal" class="btn button-on-white">Add Joureny</button></th>
          <form method="post" action="PHP-Actions/Edit/edit_journey_page.php">
            <th>
              <input type="number" min=1 name="edit_journey" class="form-control" placeholder="ID">
              <br>
              <button type="submit" class="btn my-2 my-sm-0 button-on-white">Edit Journey</button>
            </th>
          </form>
          <form method="post" action="PHP-Actions/delete/delete_journey.php">
            <th>
              <input type="number" min=1 name="delete_id" class="form-control" placeholder="ID">
              <br>
              <button type="submit" class="btn my-2 my-sm-0 button-on-white">Delete Journey</button>
            </form>
          </th>
      </thead>
      </table>
      <br>
      <br>

      <table id="targetTable" class="table table-bordered">
        <thead class="header">
          <th>Journey ID</th>
          <th>Route ID</th>
          <th>Departure Time</th>
          <th>Arrival Time</th>
          <th>Time Delay</th>
          <th>Delay Reason</th>
          <th>Cancelled Reason</th>
          <th>Price</th>
          <th>No. Of Carriages</th>
        </thead>
        <tbody id="journeyTable">
          <?php
            foreach ($joureny_array as $key => $value) {
              echo "<tr>";
              echo "<td>" . $value['JOURNEY_ID'] . "</td>";
              echo "<td>" . $value['ROUTE_ID'] . "</td>";
              echo "<td>" . $value['BEGIN_TIME'] . "</td>";
              echo "<td>" . $value['ARRIVAL_TIME'] . "</td>";
              echo "<td>" . $value['TIME_DELAY'] . "</td>";
              echo "<td>" . $value['DELAY_REASON'] . "</td>";
              echo "<td>" . $value['CANCELLED_REASON'] . "</td>";
              echo "<td>" . "£" . $value['BASE_PRICE'] . "</td>";
              echo "<td>" . $value['NUM_OF_CARRIAGES'] . "</td>";
              echo "</tr>";
            }
           ?>
      </tbody>
      </table>

<div id="addModal" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h2>Add Joureny</h2>
    </div>
    <div class="modal-body">
      <form method="post" action="PHP-Actions/insert_into/add_journey.php"
        <div class="form-group">
          <form action="PHP-Actions/insert_into/add_joureny" method="post">
          <label for="exampleFormControlInput1">Route ID</label>
          <select name="route_id" class="form-control" id="exampleFormControlSelect1 route-id-form">
            <?php
            foreach($route1_array as $key => $value) {
              echo "<option>" . $value['ROUTE_ID'] . "</option>";
              }
             ?>
          </select>
        </div>
        <div class="form-group">
          <label for="exampleFormControlSelect1">Departure Time</label>
          <input type="datetime-local" id="datefield" min="<?php echo $system_date; ?>" name="departure_time" class="form-control">
        </div>
        <div class="form-group">
          <label for="exampleFormControlSelect1">Arrival Time</label>
          <input type="datetime-local" id="datefield" min="" name="arrival_time" class="form-control">
        </div>
        <div class="form-group">
          <label for="exampleFormControlSelect1">Delay Time</label>
          <input id="datefield" type="datetime-local" <?php echo "min='$system_date'" ?> name="'delay_time" class="form-control">
        </div>
        <div class="form-group">
          <label for="exampleFormControlTextarea1">Delay Reason</label>
          <textarea class="form-control" id="exampleFormControlTextarea Delay-reason-form" name="delay_reason" rows="3">NA</textarea>
        </div>
        <div class="form-group">
          <label for="exampleFormControlTextarea1">Cancellation Reason</label>
          <textarea class="form-control" id="exampleFormControlTextarea1 Cancellation-reason-form" name="cancel_reason" rows="3">NA</textarea>
        </div>
        <div class="form-group">
          <label for="exampleFormControlTextarea1">Price</label>
          <input type="text" class="form-control" name="price" id="exampleFormControlInput1 price-form">
        </div>
        <div class="form-group">
          <label for="exampleFormControlTextarea1">number of carriages</label>
          <input type="number" min=1 class="form-control" name="num_of_carriages" id="exampleFormControlInput1 numCarriages-form">
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
