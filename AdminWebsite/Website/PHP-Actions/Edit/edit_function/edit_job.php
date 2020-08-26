<?php
session_start();
if(isset($_POST['submit'])) {


$edit_job = array();
$edit_job['job_ID'] = $_SESSION['edit_job_id'];

$staff_id = $_POST['staff'];
$journey_id = $_POST['journey'];
$job_description = $_POST['job_desc'];
$date = $_POST['job_date'];

$og_staff_id = $_POST['og_staff'];
$og_journey_id = $_POST['og_journey'];
$og_job_description = $_POST['og_job_desc'];
$og_date = $_POST['og_job_date'];

if($staff_id != $og_staff_id) {
  $edit_job['USER_ID'] = $staff_id;
}
if($journey_id != $og_journey_id) {
  $edit_job['JOURNEY_ID'] = $journey_id;
}
if($job_description != $og_job_description) {
  $edit_job['JOB_DESCRIPTION'] = $job_description;
}
if($date != $og_date) {
  $edit_job['JOB_DATE'] = $date;
}

$url = "http://web.socem.plymouth.ac.uk/intProj/PRCS252A/api/job/" . $_SESSION['edit_job_id'];
$encoded_edit = json_encode($edit_job);
$string_edit = http_build_query($edit_job);

echo $encoded_edit . "<br>";

$curl_options = array(
  CURLOPT_URL => "http://web.socem.plymouth.ac.uk/intProj/PRCS252A/api/job/" . $_SESSION['edit_job_id'],
  CURLOPT_RETURNTRANSFER => 1,
  CURLOPT_CUSTOMREQUEST => 'PUT',
  CURLOPT_HTTPHEADER => array('Content-Type: application/json', 'Accept: application/json'),
  CURLOPT_POSTFIELDS => $encoded_edit
);

//Initalises cURL
$ch = curl_init();
curl_setopt_array($ch, $curl_options);


$response = curl_exec($ch);
echo 'Status-Code: ' . curl_getinfo($ch, CURLINFO_HTTP_CODE);
echo '<pre>';print_r(json_decode($response, true));echo'</pre>';
curl_close($ch);

if(curl_getinfo($ch, CURLINFO_HTTP_CODE) != 204) {
  $_SESSION['edit_error'] = "Error with REQUEST, status code: " . curl_getinfo($ch, CURLINFO_HTTP_CODE);
  header("Location: http://web.socem.plymouth.ac.uk/intProj/PRCS252A/Website/job_page.php");
  exit;
} else {
  header("Location: http://web.socem.plymouth.ac.uk/intProj/PRCS252A/Website/job_page.php");
  exit;
}

//Close cURL session


} else {
  echo "issue on submit";
}

 ?>
