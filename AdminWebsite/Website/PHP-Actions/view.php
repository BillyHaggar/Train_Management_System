<?php
header("refresh: 60");

$system_date = date("Y-m-d");
$system_date_time = date("Y-m-d h:i:s");

//User Accounts
$user_accounts =file_get_contents("http://web.socem.plymouth.ac.uk/intProj/PRCS252A/api/user_account");
$user_accounts_content =  json_decode($user_accounts, true);
$customers = array();
$staff =array();
$admin = array();
//Customer Accounts
foreach($user_accounts_content as $key => $value) {
  if($value["USER_RANK"] == "CUSTOMER" ) {
    array_push($customers, $value);
  }
}
//Staff Accounts
foreach($user_accounts_content as $key => $value) {
  if($value["USER_RANK"] != "CUSTOMER" && $value["USER_RANK"] != "ADMIN") {
    array_push($staff, $value);
  }
}
//Admin Accounts
foreach($user_accounts_content as $key => $value) {
  if($value["USER_RANK"] == "ADMIN" ) {
    array_push($admin, $value);
  }
}
//Bookings
$booking_file =file_get_contents("http://web.socem.plymouth.ac.uk/intProj/PRCS252A/api/booking");
$booking_content =  json_decode($booking_file, true);
//Jourenys
$joureny_file =file_get_contents("http://web.socem.plymouth.ac.uk/intProj/PRCS252A/api/journey");
$joureny_array =  json_decode($joureny_file, true);
//Route
$routes_file =file_get_contents("http://web.socem.plymouth.ac.uk/intProj/PRCS252A/api/route");
$route_array =  json_decode($routes_file, true);
//Route station - station
$route1_file = file_get_contents("http://web.socem.plymouth.ac.uk/intProj/PRCS252A/api/route_num");
$route1_array = json_decode($route1_file, true);
//Stations
$stations_file =file_get_contents("http://web.socem.plymouth.ac.uk/intProj/PRCS252A/api/station");
$stations_array =  json_decode($stations_file, true);
//Vehicles
$vehicle_file =file_get_contents("http://web.socem.plymouth.ac.uk/intProj/PRCS252A/api/vehicle");
$vehicle_array =  json_decode($vehicle_file, true);
//Jobs
$job_file =file_get_contents("http://web.socem.plymouth.ac.uk/intProj/PRCS252A/api/job");
$job_array =  json_decode($job_file, true);
?>
