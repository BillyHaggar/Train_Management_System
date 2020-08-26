<?php
include("view.php");

$booking_code = 0000000000;
$user_id = 1;
$booking_id = 1;
$joureny_id = 1;

$test_booking = array();

echo date("Y-m-d h:i:s"); echo "<br>";



$str = 'In My Cart : 11 items';
$int = (int) filter_var($str, FILTER_SANITIZE_NUMBER_INT);

echo $str; echo "<br>";
echo $int;

echo "<br>";
print_r($admin);

function samePageTest() {
  $test_value = $_POST['test_form'];

  echo $test_value . ("<-");
}
 ?>

 <html>
<head>


<script>

</script>
</head>
<body>

  <form method="post">
  <<input type="text" name="test" id="text" value="text" /><br/>
      <input type="submit" name="test" id="test" value="RUN" /><br/>
  </form>

  <?php

  function testfun()
  {

     echo "Your test function on button click is working";
     echo "<br>" . $_POST['text'];
  }

  if(array_key_exists('text',$_POST)){
     testfun();
  }

  ?>
</body>

 </html>
