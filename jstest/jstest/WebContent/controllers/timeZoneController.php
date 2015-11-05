<?php
// This controller just writes the current time as a text string to the response
   echo "Default time zone: ". date_default_timezone_get()."<br>";
   echo date("Y-m-d h:i:s a")."<br>";
   date_default_timezone_set('America/Chicago');
   echo "Default time zone: ". date_default_timezone_get()."<br>";
   echo date("Y-m-d h:i:s a")."<br>";
?>

