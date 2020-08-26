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
      <h1>Jobs Table</h1>
      <div class="search-bar">
        <input type="text" id="searchInput" class="form-control" onkeyup="searchTable()" placeholder="Search">
      </div>
      <table id="header-search" style="margin-left: 60%; width: 500px;">
        <thead>
          <th><button id="openModal" class="btn button-on-white">Assign Job</button></th>
          <form method="post" action="PHP-Actions/Edit/edit_job_page.php">
            <th>
              <input type="number" min=1 name="edit_job" class="form-control" placeholder="ID">
              <br>
              <button type="submit" class="btn my-2 my-sm-0 button-on-white">Edit Job</button>
            </th>
          </form>
          <form method="post" action="PHP-Actions/delete/delete_job.php">
            <th>
              <input type="number" min=1 name="delete_id" class="form-control" placeholder="ID">
              <br>
              <button type="submit" class="btn my-2 my-sm-0 button-on-white">Delete Job</button>
            </form>
          </th>
      </thead>
      </table>
      <br>
      <br>

      <table id="targetTable" class="table table-bordered">
        <thead class="header">
          <th>Job ID</th>
          <th>User ID</th>
          <th>Joureny ID</th>
          <th>Job Description</th>
          <th>Job Date</th>
        </thead>
        <tbody id="jobsTable">
          <?php
          foreach ($job_array as $key => $value) {
            echo "<tr>";
            echo "<td>" . $value['JOB_ID'] . "</td>";
            echo "<td>" . $value['USER_ID'] . "</td>";
            echo "<td>" . $value['JOURNEY_ID'] . "</td>";
            echo "<td>" . $value['JOB_DESCRIPTION'] . "</td>";
            echo "<td>" . $value['JOB_DATE'] . "</td>";
            echo "</tr>";
          }
         ?>
      </tbody>
      </table>

<div id="addModal" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h2>Assign Job</h2>
    </div>
    <div class="modal-body">
      <form method="post" action="PHP-Actions/insert_into/assign_job.php">
        <div class="form-group">
          <label for="exampleFormControlInput1">Staff Member</label>
          <select name="staff" class="form-control" id="exampleFormControlSelect1 staff-id-form">
            <?php
            foreach($staff as $key => $value) {
              echo "<option>" . $value['USER_ID'] . ": " . $value['FIRST_NAME'] . " " . $value['LAST_NAME'] . ", " . $value['USER_RANK'] . "</option>";
              }
             ?>
          </select>
        </div>
        <div class="form-group">
          <label for="exampleFormControlInput1">Journey</label>
          <select name="journey" class="form-control" id="exampleFormControlSelect1 journey-id-form">
            <?php
            echo "<option> </option>";
            foreach($joureny_array as $key => $value) {
              echo "<option>" . $value['JOURNEY_ID'] . "</option>";
              }
             ?>
          </select>
        </div>
        <div class="form-group">
          <label for="exampleFormControlInput1">Job Description</label>
          <textarea class="form-control" id="exampleFormControlTextarea job-desc-form" name="job_desc" rows="3">NA</textarea>
        </div>
        <div class="form-group">
          <label for="exampleFormControlSelect1">Job Date</label>
          <input type="date" id="datefield" min="<?php $system_date ?>" name="job_date" class="form-control">
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
