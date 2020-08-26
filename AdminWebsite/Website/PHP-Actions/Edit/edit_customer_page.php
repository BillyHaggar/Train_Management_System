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

  $target = $_POST['edit_customer'];
  $_SESSION['edit_customer_id'] = $target;




  foreach($customers as $key => $value) {
    if($target == $value['USER_ID']) {
      $_SESSION['edit_staff_id'] = $value['USER_ID'];
      $username = $value['USERNAME'];
      $password = $value['USER_PASSWORD'];
      $user_rank = $value['USER_RANK'];
      $first_name = $value['FIRST_NAME'];
      $last_name = $value['LAST_NAME'];
      $dob = $value['DATE_OF_BIRTH'];
      $address1 = $value['U_ADDRESS_LINE_1'];
      $address2 = $value['U_ADDRESS_LINE_2'];
      $postcode = $value['U_POSTCODE'];
      $email = $value['EMAIL'];
      $contact_number = $value['CONTACT_NUMBER'];
      $alt_number = $value['ALTERNATIVE_NUMBER'];
      $mark_opt = $value['MARKETING_OPT_IN'];
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
      <h1>Edit Customer: <?php echo $target; ?></h1><br>
      <div class="form-group">
        <form method="post" action="PHP-actions/Edit/edit_function/edit_customer.php">
          <div class="form-group">
            <label for="exampleFormControlInput1">Username</label>
            <input type="test" class="form-control" id="exampleFormControlInput1 username-form" name="username" value="<?php echo $username; ?>">
          </div>
          <div class="form-group">
            <label for="exampleFormControlInput1">Password</label>
            <input type="test" class="form-control" id="exampleFormControlInput1 password-form" name="password" value="<?php echo $password; ?>">
          </div>
          <div class="form-group">
            <label for="exampleFormControlTextarea1">First Name</label>
            <input type="text" class="form-control" id="exampleFormControlTextarea first-name-form" name="firstname" value="<?php echo $first_name; ?>">
          </div>
          <div class="form-group">
            <label for="exampleFormControlTextarea1">Last Name</label>
            <input type="text" class="form-control" id="exampleFormControlTextarea1 last-name-form" name="lastname" value="<?php echo $last_name; ?>">
          </div>
          <div class="form-group">
            <label for="exampleFormControlTextarea1">User Rank</label>
            <input type="text" class="form-control" id="exampleFormControlTextarea1 last-name-form" name="role" value="<?php echo $user_rank; ?>" readonly>
          </div>
          <div class"form-group">
            <label for="exampleFormControlTextarea1">Address Line 1</label>
            <input type="text" class="form-control" id="exampleFormControlTextarea1 address1-form" name="address1" value="<?php echo $address1; ?>">
          </div>
          <div class"form-group">
            <label for="exampleFormControlTextarea1">Address Line 2</label>
            <input type="text" class="form-control" id="exampleFormControlTextarea1 address2-form" name="address2" value="<?php echo $address2; ?>">
          </div>
          <div class"form-group">
            <label for="exampleFormControlTextarea1">Post Code</label>
            <input type="text" class="form-control" id="exampleFormControlTextarea1 postcode-form" name="postcode" value="<?php echo $postcode; ?>">
          </div>
          <div class="form-group">
            <label for="exampleFormControlSelect1">Date of Birth</label>
            <input id="datefield" type="datetime-local" max="21/05/2001" name="DOB" class="form-control" value="<?php echo $dob; ?>" readonly>
          </div>
          <div class"form-group">
            <label for="exampleFormControlTextarea1">Email</label>
            <input type="text" class="form-control" id="exampleFormControlTextarea1 email-form" name="email" value="<?php echo $email; ?>">
          </div>
          <div class"form-group">
            <label for="exampleFormControlTextarea1">Contact Number</label>
            <input type="text" class="form-control" id="exampleFormControlTextarea1 contactNum-form" name="contactNum" value="<?php echo $contact_number; ?>">
          </div>
          <div class"form-group">
            <label for="exampleFormControlTextarea1">Alternative Contact Number</label>
            <input type="text" class="form-control" id="exampleFormControlTextarea1 alt-contact-Num-form" name="altContactNum" value="<?php echo $alt_number; ?>">
          </div>
          <div class"form-group">
            <label for="exampleFormControlTextarea1">Marketing Opt</label>
            <input type="text" class="form-control" id="exampleFormControlTextarea1 marketing-opt-form" name="marketing_opt" value="<?php echo $mark_opt ?>">
          </div>


      <input type="hidden" id="infoPass" name="og_username" value="<?php echo $username; ?>">
      <input type="hidden" id="infoPass" name="og_password" value="<?php echo $password; ?>">
      <input type="hidden" id="infoPass" name="og_firstname" value="<?php echo $first_name; ?>">
      <input type="hidden" id="infoPass" name="og_lastname" value="<?php echo $last_name; ?>">
      <input type="hidden" id="infoPass" name="og_role" value="<?php echo $user_rank; ?>">
      <input type="hidden" id="infoPass" name="og_address1" value="<?php echo $address1; ?>">
      <input type="hidden" id="infoPass" name="og_address2" value="<?php echo $address2; ?>">
      <input type="hidden" id="infoPass" name="og_postcode" value="<?php echo $postcode; ?>">
      <input type="hidden" id="infoPass" name="og_contact_nums" value="<?php echo $contact_number; ?>">
      <input type="hidden" id="infoPass" name="og_email" value="<?php echo $email; ?>">
      <input type="hidden" id="infoPass" name="og_alt_num" value="<?php echo $alt_number; ?>">
      <input type="hidden" id="infoPass" name="og_mark_opt" value="<?php echo $mark_opt; ?>">

      <input name="submit" type="submit" class="btn btn-primary add-row" value="Submit">
      </form>
  </div>
      <br>


</div>
</div>
</body>
</html>
