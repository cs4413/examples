<?php
// This creates a JSON string for an array
   $user = array();
   $user['name'] = 'Alice';
   $user['email'] = 'alice@gmail.com';
   
   $myNumbers = range(0, mt_rand(1, 10));
   $outArray = array();
   $outArray['user'] = $user;
   $outArray['numbers'] = $myNumbers;
   $outArray['date'] = date("Y-m-d h:i:s a");
   
   echo json_encode($outArray);
   
   //print_r($outArray);
?>

