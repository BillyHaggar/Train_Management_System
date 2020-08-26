<?php
session_start();

session_destroy();
header("Location: http://web.socem.plymouth.ac.uk/intProj/PRCS252A/Website/login.php");
?>
