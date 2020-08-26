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

  $target = $_POST['edit_journey'];
  $_SESSION['edit_journey_id'] = $target;




  foreach($joureny_array as $key => $value) {
    if($target == $_SESSION['edit_journey_id']) {
      $_SESSION['edit_journey_id'] = $value['JOURNEY_ID'];
      $route_id = $value['ROUTE_ID'];
      $dep_time = $value['BEGIN_TIME'];
      $arrival_time = $value['ARRIVAL_TIME'];
      $delay = $value['TIME_DELAY'];
      $delay_reason = $value['DELAY_REASON'];
      $cancel = $value['CANCELLED_REASON'];
      $price = $value['BASE_PRICE'];
      $num_carriages = $value['NUM_OF_CARRIAGES'];
    }
  }
  ?>

</head>
<body>
  <?php
  if(isset($_SESSION['error_edit'])) {
    echo "<script>alert" . $_SESSION['error_edit'] . "</script>";
    $_SESSION['error_edit'] = null;
  } ?>

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
            <form action="../../PHP-Actions/logout.php">
            <input class="btn btn-outline-success my-2 my-sm-0" id="logout-Btn" type="submit" Value="Logout">
          </form>
          </li>
        </ul>
      </div>
    </nav>

    <div class="container-fluid">
      <h1>Edit Journey: <?php echo $target; ?></h1><br>
      <form action="edit_function/edit_journey.php" method="post">
      <div class="form-group">
        <label for="exampleFormControlInput1">Route ID</label>
        <select name="route_id" class="form-control" id="exampleFormControlSelect1 route-id-form">
          <option><?php echo $route_id; ?></option>
          <?php
            foreach($route1_array as $key => $value) {
              if($value['ROUTE_ID'] != $route_id) {
                echo "<option>" . $value['ROUTE_ID'] . "</option>";
              }
            }
           ?>
        </select>
      </div>
      <div class="form-group">
        <label for="exampleFormControlSelect1">Departure Time</label>
        <input type="datetime-local" id="datefield" min="" name="departure_time" class="form-control" value="<?php echo $dep_time; ?>">
      </div>
      <div class="form-group">
        <label for="exampleFormControlSelect1">Arrival Time</label>
        <input type="datetime-local" id="datefield" min="" name="arrival_time" class="form-control" value="<?php echo $arrival_time; ?>">
      </div>
      <div class="form-group">
        <label for="exampleFormControlSelect1">Delay Time</label>
        <input id="datefield" type="datetime-local" name="delay_time" class="form-control" value="<?php echo $delay; ?>">
      </div>
      <div class="form-group">
        <label for="exampleFormControlTextarea1">Delay Reason</label>
        <textarea class="form-control" id="exampleFormControlTextarea Delay-reason-form" name="delay_reason" rows="3" value="<?php echo $delay_reason; ?>"></textarea>
      </div>
      <div class="form-group">
        <label for="exampleFormControlTextarea1">Cancellation Reason</label>
        <textarea class="form-control" id="exampleFormControlTextarea1 Cancellation-reason-form" name="cancel_reason" rows="3" value="<?php echo $cancel; ?>"></textarea>
      </div>
      <div class="form-group">
        <label for="exampleFormControlTextarea1">Price</label>
        <input type="text" class="form-control" name="price" id="exampleFormControlInput1 price-form" value="<?php echo $price; ?>">
      </div>
      <div class="form-group">
        <label for="exampleFormControlTextarea1">number of carriages</label>
        <input type="number" min=1 class="form-control" name="num_of_carriages" id="exampleFormControlInput1 numCarriages-form" value="<?php echo $num_carriages; ?>">
      </div>
      <input type="hidden" id="infoPass" name="journey1" value="<?php echo $journey_id; ?>">
      <input type="hidden" id="infoPass" name="og_route_id" value="<?php echo $route_id; ?>">
      <input type="hidden" id="infoPass" name="og_begin_time" value="<?php echo $dep_time; ?>">
      <input type="hidden" id="infoPass" name="og_arrival_time" value="<?php echo $arrival_time; ?>">
      <input type="hidden" id="infoPass" name="og_delay_time" value="<?php echo $delay; ?>">
      <input type="hidden" id="infoPass" name="og_delay_reason" value="<?php echo $delay_reason; ?>">
      <input type="hidden" id="infoPass" name="og_cancel_reason" value="<?php echo $cancel; ?>">
      <input type="hidden" id="infoPass" name="og_price" value="<?php echo $price; ?>">
      <input type="hidden" id="infoPass" name="og_num_carriages" value="<?php echo $num_carriages; ?>">

      <input name="submit" type="submit" class="btn btn-primary add-row" value="Submit">
    </form>
  </div>
      <br>


</div>
</div>
</body>
</html>
