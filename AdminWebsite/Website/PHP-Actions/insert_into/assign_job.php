<?php
$job_api = "http://web.socem.plymouth.ac.uk/intProj/PRCS252A/api/job";
$ch = curl_init($joureny_api);

$job_id = 0;
$staff_details = $_POST['staff'];
$journey = $_POST['journey'];
$description = $_POST['job_desc'];
$date = $_POST['job_date'];

$staff_id = (int) filter_var($staff_details, FILTER_SANITIZE_NUMBER_INT);

$new_job = array(
  'JOB_ID' => $job_id;
  'USER_ID' => $staff_id;
  'JOURENY_ID' => $journey;
  'JOB_DESCRIPTION' => $description;
  'JOB_DATE' => $date;
)

$post_job = json_encode($new_job);

curl_setopt($ch, CURLOPT_POST, 1);

curl_setopt($ch, CURLOPT_POSTFIELDS, $post_job);

curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

$result = curl_exec($ch);

header("Location: http://web.socem.plymouth.ac.uk/intProj/PRCS252A/Website/job_page.php");
exit;



 ?>
