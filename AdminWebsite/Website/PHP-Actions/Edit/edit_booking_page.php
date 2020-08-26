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

  $target = $_POST['edit_booking'];
  $_SESSION['edit_booking_id'] = $target;




  foreach($booking_content as $key => $value) {
    if($target == $value['BOOKING_ID']) {
      $_SESSION['edit_booking_id'] = $value['BOOKING_ID'];
      $code = $value['BOOKING_CODE'];
      $user = $value['USER_ID'];
      $journey = $value['JOURNEY_ID'];
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
      <h1>Edit Booking: <?php echo $target; ?></h1><br>
      <div class="form-group">
        <form action="edit_function/edit_booking.php" method="post">
          <div class="form-group">
            <label for="exampleFormControlTextarea1">Booking Code</label>
            <input type="text" class="form-control" name="booking_code" id="exampleFormControlInput1 price-form" value="<?php echo $code; ?>">
          </div>
          <div class="form-group">
            <label for="exampleFormControlInput1">User ID</label>
            <select name="customer" class="form-control" id="exampleFormControlSelect1 route-id-form">
              <option><?php echo $user; ?></option>
              <?php
                foreach($customers as $key => $value) {
                  if($value['USER_ID'] != $user) {
                    echo "<option>" . $value['USER_ID'] . "</option>";
                  }
                }
               ?>
            </select>
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

      <input type="hidden" id="infoPass" name="og_code" value="<?php echo $code; ?>">
      <input type="hidden" id="infoPass" name="og_journey" value="<?php echo $journey; ?>">
      <input type="hidden" id="infoPass" name="og_customer" value="<?php echo $user; ?>">


      <input name="submit" type="submit" class="btn btn-primary add-row" value="Submit">
    </form>
  </div>
      <br>


</div>
</div>
</body>
</html>
