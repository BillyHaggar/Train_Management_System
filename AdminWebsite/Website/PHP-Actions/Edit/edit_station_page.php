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

  $target = $_POST['edit_station'];
  $_SESSION['edit_station_id'] = $target;




  foreach($stations_array as $key => $value) {
    if($target == $value['STATION_ID']) {
      $_SESSION['edit_station_id'] = $value['STATION_ID'];
      $station_type = $value['STATION_TYPE'];
      $station_name = $value['STATION_NAME'];
      $address1 = $value['S_ADDRESS_LINE_1'];
      $address2 = $value['S_ADDRESS_LINE_2'];
      $postcode = $value['S_POSTCODE'];
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
      <h1>Edit Station: <?php echo $target; ?></h1><br>
      <div class="form-group">
        <form action="edit_function/edit_station.php" method="post">
          <div class="form-group">
            <label for="exampleFormControlTextarea1">Station Name</label>
            <input type="text" class="form-control" name="station_name" id="exampleFormControlInput1 price-form" value="<?php echo $station_name; ?>">
          </div>
        <div class="form-group">
          <label for="exampleFormControlTextarea1">Station Type</label>
          <input type="text" class="form-control" name="station_type" id="exampleFormControlInput1 price-form" value="<?php echo $station_type; ?>">
        </div>
      <div class="form-group">
        <label for="exampleFormControlTextarea1">Address Line 1</label>
        <input type="text" class="form-control" name="address1" id="exampleFormControlInput1 price-form" value="<?php echo $address1; ?>">
      </div>
      <div class="form-group">
        <label for="exampleFormControlTextarea1">Address Line 2</label>
        <input type="text" class="form-control" name="address2" id="exampleFormControlInput1 price-form" value="<?php echo $address2; ?>">
      </div>
      <div class="form-group">
        <label for="exampleFormControlSelect1">Postcode</label>
        <input type="text" class="form-control" name="postcode" id="exampleFormControlInput1 price-form" value="<?php echo $postcode; ?>">
      </div>

      <input type="hidden" id="infoPass" name="og_station_name" value="<?php echo $station_name; ?>">
      <input type="hidden" id="infoPass" name="og_station_type" value="<?php echo $station_type; ?>">
      <input type="hidden" id="infoPass" name="og_address1" value="<?php echo $address1; ?>">
      <input type="hidden" id="infoPass" name="og_address2" value="<?php echo $address2; ?>">
      <input type="hidden" id="infoPass" name="og_postcode" value="<?php echo $postcode; ?>">

      <input name="submit" type="submit" class="btn btn-primary add-row" value="Submit">
    </form>
  </div>
      <br>


</div>
</div>
</body>
</html>
