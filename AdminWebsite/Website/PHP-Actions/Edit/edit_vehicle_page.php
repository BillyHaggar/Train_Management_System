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
  <link rel="icon" type="image/ico" href="../../images/Thomas_Co_logo_black.PNG" />
  <link rel="stylesheet" href="../../css/bootstrap.css">
  <link rel="stylesheet" href="../../sidebar-style.css">
  <script type="text/javascript" src="../../JavaScript/Standard.js"></script>

  <?php
  include('../../PHP-Actions/view.php');

  $target = $_POST['edit_vehicle'];
  $_SESSION['edit_vehicles_id'] = $target;




  foreach($vehicle_array as $key => $value) {
    if($target == $value['VEHICLE_REG']) {
      $_SESSION['edit_vehicle_id'] = $value['VEHICLE_REG'];
      $journey = $value['JOURNEY_ID'];
      $capacitiy = $value['P_CAPACITY'];
      $stored_location = $value['STORED_LOCATION'];
      $type = $value['VEHICLE_TYPE'];
    }
  }
  ?>

</head>
<body>


<div class="d-flex" id="wrapper">
  <div class="bg-light border-right" id="sidebar-wrapper">
    <div class="sidebar-heading"><a href="http://web.socem.plymouth.ac.uk/intProj/PRCS252A/Website/admin_landing.php"><img src="../../images/Thomas_Co_logo_white.PNG" alt="logo" style="width:225px; height:125px; position: relative; left: 5px;"></a></div>
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
      <h1>Edit Vehicle: <?php echo $target; ?></h1><br>
      <div class="form-group">
        <form action="edit_function/edit_vehicle.php" method="post">
          <div class="form-group">
            <label for="exampleFormControlTextarea1">Vehicle Registration</label>
            <input type="text" class="form-control" name="vehicle_reg" id="exampleFormControlInput1 price-form" value="<?php echo $_SESSION['edit_vehicle_id']; ?>">
          </div>
          <div class="form-group">
            <label for="exampleFormControlInput1">Journey ID</label>
            <select name="journey" class="form-control" id="exampleFormControlSelect1 route-id-form">
              <option><?php echo $journey; ?></option>
              <?php
                foreach($joureny_array as $key => $value) {
                  if($value['ROUTE_ID'] != $journey) {
                    echo "<option>" . $value['JOURNEY_ID'] . "</option>";
                  }
                }
               ?>
            </select>
          </div>
        <div class="form-group">
          <label for="exampleFormControlTextarea1">Vehicle Type</label>
          <input type="text" class="form-control" name="vehicle_type" id="exampleFormControlInput1 price-form" value="<?php echo $type; ?>">
        </div>
      <div class="form-group">
        <label for="exampleFormControlTextarea1">Capacity</label>
        <input type="number" min=10 class="form-control" name="capacity" id="exampleFormControlInput1 price-form" value="<?php echo $capacitiy; ?>">
      </div>
      <div class="form-group">
        <label for="exampleFormControlTextarea1">Stored Location</label>
        <input type="text" class="form-control" name="stored_location" id="exampleFormControlInput1 price-form" value="<?php echo $stored_location; ?>">
      </div>

      <input type="hidden" id="infoPass" name="og_stored_location" value="<?php echo $stored_location; ?>">
      <input type="hidden" id="infoPass" name="og_capacitiy" value="<?php echo $capacitiy; ?>">
      <input type="hidden" id="infoPass" name="og_type" value="<?php echo $type; ?>">
      <input type="hidden" id="infoPass" name="og_reg" value="<?php echo $_SESSION['edit_vehicles_id']; ?>">
      <input type="hidden" id="infoPass" name="og_journey" value="<?php echo $journey; ?>">


      <input name="submit" type="submit" class="btn btn-primary add-row" value="Submit">
    </form>
  </div>
      <br>


</div>
</div>
</body>
</html>
