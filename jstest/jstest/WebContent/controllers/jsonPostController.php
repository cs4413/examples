<?php
// This controller processes a POST for the userName and then randomly returns a yes or no
   $reply = array();
   if (!isset($_POST['userName']) || empty($_POST['userName'])) 
       $reply['error'] = 'No user name';
   else {
      $reply['userName'] = $_POST['userName'];
      $pick = mt_rand(0, 1); //Randomly say exists or not for test
      if ($pick > 0.5)
      	   $reply['exists'] = true;
      else 
      	   $reply['exists'] = false;
      if ($reply['exists'])
      	 $reply['error'] = $reply['userName']." already exists, pick another";
   }
     
   echo json_encode($reply);
?>

